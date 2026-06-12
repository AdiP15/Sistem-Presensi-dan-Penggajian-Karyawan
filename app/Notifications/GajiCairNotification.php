<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GajiCairNotification extends Notification
{
    use Queueable;

    public $gaji;

    // Terima data gaji saat notifikasi dipanggil
    public function __construct($gaji)
    {
        $this->gaji = $gaji;
    }

    // Tentukan media pengiriman (Database saja cukup)
    public function via($notifiable)
    {
        return ['database'];
    }

    // Format data yang disimpan ke database
    public function toArray($notifiable)
    {
        return [
            'title' => 'Slip Gaji Baru 💰',
            'message' => 'Gaji bulan ' . $this->gaji->bulan . ' telah terbit. Cek sekarang!',
            'url' => route('karyawan.gaji.preview', $this->gaji->id), // Link ke preview gaji
            'icon' => 'money', // Penanda ikon
        ];
    }
}
