<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class IzinAkhir extends Notification
{
    use Queueable;

    private $namaPerusahaan;
    private $tahapanKegiatan;
    private $statusIzin;

    public function __construct($namaPerusahaan, $tahapanKegiatan, $statusIzin)
    {
        $this->namaPerusahaan = $namaPerusahaan;
        $this->tahapanKegiatan = $tahapanKegiatan;
        $this->statusIzin = $statusIzin;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // Hapus 'whatsapp' dari sini
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Hallo ' . $this->namaPerusahaan . ',')
                    ->line('Kami ingin menginformasikan bahwa pengajuan izin tambang Anda pada tahapan ' . '**' . $this->tahapanKegiatan . '**' . ' berada dalam status ' . '**' . $this->statusIzin . '**' . '.')
                    ->line('Untuk informasi lebih lanjut,')
                    ->action('Login ke sistem', url('https://minerbalampung.com/'))
                    ->line('Terimakasih')
                    ->line('Tim Administrasi ESDM Bandar Lampung');
    }

    public function toArray($notifiable)
    {
        return [
            'namaPerusahaan' => $this->namaPerusahaan,
            'tahapanKegiatan' => $this->tahapanKegiatan,
            'statusIzin' => $this->statusIzin,
        ];
    }
}
