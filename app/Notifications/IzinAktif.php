<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Services\TwilioService;

class IzinAktif extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    private $namaPerusahaan;
    private $tahapanKegiatan;
    private $statusIzin;
    public function __construct($namaPerusahaan, $tahapanKegiatan, $statusIzin)
    {
        $this->namaPerusahaan = $namaPerusahaan;
        $this->tahapanKegiatan = $tahapanKegiatan;
        $this->statusIzin = $statusIzin;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->greeting('Hallo ' . $this->namaPerusahaan . ',')
                    ->line('Kami ingin menginformasikan bahwa pengajuan izin tambang Anda pada tahapan ' . '**' . $this->tahapanKegiatan . '**' . ' berada dalam status ' . '**' . $this->statusIzin . '**' . '.')
                    ->line('Untuk informasi lebih lanjut,')
                    ->action('Login ke sistem', url('https://minerbalampung.com/'))
                    ->line('Terimakasih')
                    ->line('Tim Administrasi ESDM Bandar Lampung');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'namaPerusahaan' => $this->namaPerusahaan,
            'tahapanKegiatan' => $this->tahapanKegiatan,
            'statusIzin' => $this->statusIzin,
        ];
    }
}
