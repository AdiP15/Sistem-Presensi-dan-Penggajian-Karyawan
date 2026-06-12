<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\ManajemenAdminController;
use App\Http\Controllers\Admin\GajiController;
use App\Http\Controllers\Admin\AdminPresensiController;
use App\Http\Controllers\Karyawan\PresensiController;
use App\Http\Controllers\Karyawan\GajiKaryawanController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route(
            Auth::user()->role === 'admin' ? 'admin.dashboard' : 'karyawan.dashboard'
        );
    }

    return view('landing');
})->name('landing');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');
    Route::get('/lupa-password', function () {
        return view('auth.lupa_password');
    })->name('lupa.password');
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// GROUP AUTH (Login Dulu)
Route::middleware(['auth'])->group(function () {

    // --- AREA ADMIN ---
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', function () {
            $totalKaryawan = \App\Models\User::where('role', 'karyawan')->count();
            $hadirHariIni = \App\Models\Presensi::whereDate('tanggal', date('Y-m-d'))->where('status', 'hadir')->count();
            return view('admin.dashboard', compact('totalKaryawan', 'hadirHariIni'));
        })->name('dashboard');

        Route::resource('karyawan', KaryawanController::class);
        Route::resource('users', ManajemenAdminController::class);

        // Gaji Admin
        Route::resource('gaji', GajiController::class)->except(['show', 'edit', 'update']);
        Route::get('/gaji/{id}/cetak', [GajiController::class, 'cetakPdf'])->name('gaji.cetak');
        Route::get('/gaji/{id}/preview', [GajiController::class, 'previewPdf'])->name('gaji.preview');

        // Presensi Admin
        Route::get('/presensi/harian', [AdminPresensiController::class, 'index'])->name('presensi.index');
        Route::get('/presensi/rekap', [AdminPresensiController::class, 'rekap'])->name('presensi.rekap');
        Route::delete('/presensi/{id}', [AdminPresensiController::class, 'destroy'])->name('presensi.destroy');
    });

    // --- AREA KARYAWAN ---
    Route::middleware(['role:karyawan'])->prefix('karyawan')->name('karyawan.')->group(function () {

        Route::get('/dashboard', function () {
            $presensiHariIni = \App\Models\Presensi::where('user_id', Auth::id())->whereDate('tanggal', date('Y-m-d'))->first();
            return view('karyawan.dashboard', compact('presensiHariIni'));
        })->name('dashboard');

        Route::get('/presensi/buat', [PresensiController::class, 'index'])->name('presensi.create');
        Route::post('/presensi/store', [PresensiController::class, 'store'])->name('presensi.store');
        Route::post('/presensi/pulang', [PresensiController::class, 'pulang'])->name('presensi.pulang');
        Route::get('/presensi/riwayat', [PresensiController::class, 'riwayat'])->name('presensi.riwayat');

        // Gaji Karyawan
        Route::get('/gaji', [GajiKaryawanController::class, 'index'])->name('gaji.index');
        Route::get('/gaji/{id}/preview', [GajiKaryawanController::class, 'previewPdf'])->name('gaji.preview');
        Route::get('/gaji/{id}/cetak', [GajiKaryawanController::class, 'cetakPdf'])->name('gaji.cetak');
    });

});
