<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

// PERBAIKAN: Nama Class harus sama dengan Nama File (AdminPresensiController)
class AdminPresensiController extends Controller
{
    /**
     * Menampilkan data presensi Harian.
     */
    public function index(Request $request)
    {
        $tanggal = $request->tanggal ?? date('Y-m-d');

        $presensi = Presensi::with('user')
                    ->where('tanggal', $tanggal)
                    ->orderBy('jam_masuk', 'desc')
                    ->get();

        return view('admin.presensi.index', compact('presensi', 'tanggal'));
    }

    /**
     * Menampilkan Rekapitulasi Presensi berdasarkan Rentang Tanggal.
     */
    public function rekap(Request $request)
    {
        // Default: Tanggal 1 bulan ini s/d Hari ini
        $startDate = $request->start_date ?? date('Y-m-01');
        $endDate = $request->end_date ?? date('Y-m-t');

        // Ambil semua karyawan
        $karyawan = User::where('role', 'karyawan')
                    ->orderBy('name', 'asc')
                    ->get();

        $rekap = [];

        foreach($karyawan as $k) {
            $hadir = Presensi::where('user_id', $k->id)
                        ->whereBetween('tanggal', [$startDate, $endDate])
                        ->where('status', 'hadir')
                        ->count();

            $izin = Presensi::where('user_id', $k->id)
                        ->whereBetween('tanggal', [$startDate, $endDate])
                        ->where('status', 'izin')
                        ->count();

            $sakit = Presensi::where('user_id', $k->id)
                        ->whereBetween('tanggal', [$startDate, $endDate])
                        ->where('status', 'sakit')
                        ->count();

            $rekap[] = [
                'nama' => $k->name,
                'hadir' => $hadir,
                'izin' => $izin,
                'sakit' => $sakit
            ];
        }

        return view('admin.presensi.rekap', compact('rekap', 'startDate', 'endDate'));
    }

    /**
     * Menghapus data presensi.
     */
    public function destroy($id)
    {
        $presensi = Presensi::findOrFail($id);

        if ($presensi->foto_masuk) {
            Storage::delete('public/presensi/' . $presensi->foto_masuk);
        }
        if ($presensi->foto_pulang) {
            Storage::delete('public/presensi/' . $presensi->foto_pulang);
        }

        $presensi->delete();

        return back()->with('success', 'Data presensi berhasil dihapus.');
    }
}
