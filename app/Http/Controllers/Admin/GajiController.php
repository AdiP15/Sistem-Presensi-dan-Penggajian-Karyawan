<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Gaji;
use App\Models\Presensi;
use Barryvdh\DomPDF\Facade\Pdf;

class GajiController extends Controller
{
    // 1. Daftar Riwayat Gaji
    public function index()
    {
        $gajis = Gaji::with('user')->latest()->get();
        return view('admin.gaji.index', compact('gajis'));
    }

    // 2. Form Hitung Gaji Baru
    public function create()
    {
        $karyawans = User::where('role', 'karyawan')->get();
        return view('admin.gaji.create', compact('karyawans'));
    }

    // 3. Proses Simpan Gaji & Kirim Notifikasi
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'gaji_pokok' => 'required|numeric|min:0',
            'tarif_uang_makan' => 'nullable|numeric|min:0',
            'tarif_uang_transport' => 'nullable|numeric|min:0',
            'uang_lembur' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
            'denda_keterlambatan' => 'nullable|numeric|min:0',
        ]);

        $karyawan = User::findOrFail($request->user_id);

        // Map bulan to number
        $bulanIndo = ['Januari'=>'01','Februari'=>'02','Maret'=>'03','April'=>'04','Mei'=>'05','Juni'=>'06','Juli'=>'07','Agustus'=>'08','September'=>'09','Oktober'=>'10','November'=>'11','Desember'=>'12'];
        $bulanAngka = $bulanIndo[$request->bulan] ?? '01';
        $startDate = $request->tahun . '-' . $bulanAngka . '-01';
        $endDate = date('Y-m-t', strtotime($startDate));

        // Count presence
        $total_hari_hadir = Presensi::where('user_id', $request->user_id)
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->where('status', 'hadir')
            ->count();

        $gaji_pokok = $request->gaji_pokok;
        $uang_makan = ($request->tarif_uang_makan ?? 0) * $total_hari_hadir;
        $uang_transport = ($request->tarif_uang_transport ?? 0) * $total_hari_hadir;
        $uang_lembur = $request->uang_lembur ?? 0;
        $potongan = $request->potongan ?? 0;
        $denda_keterlambatan = $request->denda_keterlambatan ?? 0;

        $total_gaji = ($gaji_pokok + $uang_makan + $uang_transport + $uang_lembur) - ($potongan + $denda_keterlambatan);

        // Simpan ke Database
        $gaji = Gaji::create([
            'user_id' => $request->user_id,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'gaji_pokok' => $gaji_pokok,
            'total_hari_hadir' => $total_hari_hadir,
            'uang_makan' => $uang_makan,
            'uang_transport' => $uang_transport,
            'uang_lembur' => $uang_lembur,
            'potongan' => $potongan,
            'denda_keterlambatan' => $denda_keterlambatan,
            'total_gaji' => $total_gaji,
            'status_pembayaran' => 'lunas'
        ]);

        return redirect()->route('admin.gaji.index')->with('success', 'Gaji berhasil digenerate! Karyawan hadir ' . $total_hari_hadir . ' hari.');
    }

    // 4. Download PDF (Force Download)
    public function cetakPdf($id)
    {
        $gaji = Gaji::with('user')->findOrFail($id);
        $pdf = Pdf::loadView('pdf.slip_gaji', compact('gaji'));
        return $pdf->download('Slip_Gaji_'.$gaji->user->name.'_'.$gaji->bulan.'_'.$gaji->tahun.'.pdf');
    }

    // 5. Preview PDF (Lihat di Browser)
    public function previewPdf($id)
    {
        $gaji = Gaji::with('user')->findOrFail($id);
        $pdf = Pdf::loadView('pdf.slip_gaji', compact('gaji'));
        return $pdf->stream('Preview_Slip_Gaji.pdf');
    }

    // 6. Hapus Data Gaji
    public function destroy($id)
    {
        Gaji::findOrFail($id)->delete();
        return back()->with('success', 'Data gaji dihapus');
    }
}
