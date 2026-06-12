<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    // Tambahkan properti fillable ini agar tidak error MassAssignmentException
    protected $fillable = [
        'user_id',
        'bulan',
        'tahun',
        'gaji_pokok',
        'total_hari_hadir',
        'uang_makan',
        'uang_transport',
        'uang_lembur',
        'potongan',
        'denda_keterlambatan',
        'total_gaji',
        'status_pembayaran',
    ];

    // Relasi ke User (Karyawan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
