<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Penting: Import Model User
use Illuminate\Support\Facades\Hash; // Penting: Import Hash untuk password

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Akun Admin / Owner
        User::create([
            'name' => 'Admin Utama',
            'username' => 'admin',
            'password' => Hash::make('password123'), // Password default
            'role' => 'admin',
            'gaji_pokok' => 0,
            'tunjangan_tetap' => 0,
        ]);

        // 2. Buat Akun Karyawan Dummy (Budi)
        User::create([
            'name' => 'Budi Santoso',
            'username' => 'budi',
            'password' => Hash::make('password123'),
            'role' => 'karyawan',
            'gaji_pokok' => 2500000,
            'tunjangan_tetap' => 200000,
        ]);
    }
}
