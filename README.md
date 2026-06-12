# SISTEM PRESENSI dan PENGGAJIAN KARYAWAN BERBASIS WEB

**Nama Tim: Tim Grutal Grutul**

**Anggota Tim :**
1. Rafayat Reza (202351009)
2. Muhammad Adi Pratama (202351023)
3. Muh Firdaus Izal Aulya (202351027)

Aplikasi berbasis web untuk memanajemen kehadiran karyawan (presensi) dan rekapitulasi gaji secara digital. Sistem ini mempermudah pencatatan waktu masuk/pulang menggunakan verifikasi foto (*webcam*) dan otomatisasi laporan penggajian.

## 🚀 Fitur Utama

### 👨‍💼 Panel Admin
* **Dashboard Monitoring:** Pantau status kehadiran karyawan secara *real-time* (Hadir, Izin, Sakit).
* **Manajemen Karyawan:** Tambah, edit, dan kelola data karyawan serta akun pengguna.
* **Validasi Presensi:** Tinjau bukti foto absen masuk karyawan secara langsung.
* **Manajemen Penggajian:** Kelola dan hitung rincian gaji berdasarkan kehadiran.
* **Cetak & Preview PDF:** Ekspor slip gaji dan laporan presensi ke dalam format PDF.

### 🧑‍💻 Panel Karyawan
* **Presensi Kamera (Webcam):** Lakukan absen masuk dengan jepretan foto langsung dari perangkat (PC/Smartphone).
* **Absen Pulang:** Pencatatan waktu selesai kerja yang presisi.
* **Riwayat Kehadiran:** Karyawan dapat memantau riwayat absen mereka sendiri.
* **Akses Slip Gaji:** Karyawan dapat melihat dan mengunduh slip gaji bulanan mereka dalam format PDF.

## 🛠️ Teknologi yang Digunakan

* **Framework Backend:** [Laravel 12](https://laravel.com/)
* **Framework Frontend:** [Tailwind CSS](https://tailwindcss.com/)
* **Database:** MySQL
* **Fitur Tambahan:**
  * Webcam.js (untuk tangkapan foto presensi)
  * DomPDF (untuk *generate* struk/slip gaji)
