<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Presensi;

class PresensiController extends Controller
{
    public function index()
    {
        $hariIni = date('Y-m-d');
        $user_id = Auth::id();

        $cekPresensi = Presensi::where('tanggal', $hariIni)
                        ->where('user_id', $user_id)
                        ->first();

        return view('karyawan.presensi.create', compact('cekPresensi'));
    }

    // --- PROSES ABSEN MASUK / SAKIT / IZIN ---
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'status' => 'required', // Hadir, Sakit, atau Izin
            // Foto wajib HANYA JIKA status = hadir
            'image' => 'required_if:status,hadir',
            // Keterangan wajib HANYA JIKA status = sakit atau izin
            'keterangan' => 'required_if:status,sakit,izin',
        ]);

        $user_id = Auth::id();
        $tanggal = date('Y-m-d');
        $jam = date('H:i:s');
        $status = strtolower($request->status); // Ambil status dari form dan jadikan huruf kecil
        $fileName = null;

        // 2. Logika Simpan Gambar (Hanya jika hadir)
        if ($status == 'hadir' && $request->has('image')) {
            $image = $request->image;
            $folderPath = storage_path('app/public/presensi/');
            $fileName = $user_id . "_" . date('Ymd') . "_masuk.png";

            // Buat folder jika belum ada
            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true, true);
            }

            // Decode base64 dan simpan
            $image_parts = explode(";base64,", $image);
            if (count($image_parts) >= 2) {
                $image_base64 = base64_decode($image_parts[1]);
                File::put($folderPath . $fileName, $image_base64);
            }
        }

        // 3. Simpan ke Database
        Presensi::create([
            'user_id' => $user_id,
            'tanggal' => $tanggal,
            'jam_masuk' => $jam, // Tetap catat jam input, meskipun sakit
            'foto_masuk' => $fileName, // Akan null jika sakit/izin
            'status' => $status, // Simpan status (hadir/sakit/izin)
            'keterangan' => $request->keterangan, // Simpan alasan
        ]);

        // Pesan notifikasi berbeda tergantung status
        $pesan = ($status == 'hadir') ? 'Berhasil Absen Masuk!' : 'Pengajuan ' . ucfirst($status) . ' Berhasil Terkirim!';

        return redirect()->route('karyawan.dashboard')->with('success', $pesan);
    }

    // --- PROSES ABSEN PULANG (Sama seperti sebelumnya) ---
    public function pulang(Request $request)
    {
        $user_id = Auth::id();
        $tanggal = date('Y-m-d');
        $jam = date('H:i:s');

        $presensi = Presensi::where('user_id', $user_id)
                    ->where('tanggal', $tanggal)
                    ->first();

        if ($presensi) {
            // Cek dulu, kalau statusnya Sakit/Izin, tidak perlu absen pulang
            if(strtolower($presensi->status) != 'hadir'){
                 return redirect()->route('karyawan.dashboard')->with('error', 'Anda sedang Izin/Sakit, tidak perlu absen pulang.');
            }

            $presensi->update([
                'jam_pulang' => $jam,
            ]);
        }

        return redirect()->route('karyawan.dashboard')->with('success', 'Hati-hati di jalan! Presensi Pulang Berhasil.');
    }

    public function riwayat()
    {
        $riwayat = Presensi::where('user_id', Auth::id())->latest()->get();
        return view('karyawan.presensi.riwayat', compact('riwayat'));
    }
}
