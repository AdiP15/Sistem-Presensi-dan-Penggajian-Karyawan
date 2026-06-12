<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gaji;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf; // Jangan lupa import PDF

class GajiKaryawanController extends Controller
{
    public function index()
    {
        // Hanya tampilkan gaji milik user yang login
        $gajis = Gaji::where('user_id', Auth::id())->latest()->get();
        return view('karyawan.gaji.index', compact('gajis'));
    }

    // Fitur Preview untuk Karyawan - BARU
    public function previewPdf($id)
    {
        // Pastikan Karyawan hanya bisa melihat gajinya sendiri
        $gaji = Gaji::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $pdf = Pdf::loadView('pdf.slip_gaji', compact('gaji'));
        return $pdf->stream('Slip_Gaji_Saya.pdf');
    }

    // Fitur Cetak PDF untuk Karyawan
    public function cetakPdf($id)
    {
        // Pastikan Karyawan hanya bisa melihat gajinya sendiri
        $gaji = Gaji::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $pdf = Pdf::loadView('pdf.slip_gaji', compact('gaji'));
        return $pdf->download('Slip_Gaji_Saya_' . $gaji->bulan . '_' . $gaji->tahun . '.pdf');
    }
}
