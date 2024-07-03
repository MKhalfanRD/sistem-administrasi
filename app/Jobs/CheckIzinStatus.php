<?php

// app/Jobs/CheckIzinStatus.php

namespace App\Jobs;

use App\Models\IUP;
use App\Notifications\IzinAkhir;
use App\Services\TwilioService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CheckIzinStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $twilio;

    /**
     * Create a new job instance.
     */
    public function __construct(TwilioService $twilio)
    {
        $this->twilio = $twilio;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('CheckIzinStatus job started');

        $oneYearFromNow = Carbon::today()->addYear();

        $tahapanKegiatan = [
            'IUP Tahap Eksplorasi' => 'tanggalBerakhir_eksplor',
            'IUP Tahap Operasi Produksi' => 'tanggalBerakhir_op',
            'Perpanjangan 1 Tahap Operasi Produksi' => 'tanggalBerakhir_p1',
            'Perpanjangan 2 Tahap Operasi Produksi' => 'tanggalBerakhir_p2',
        ];

        foreach ($tahapanKegiatan as $tahapan => $tanggalKolom) {
            $cacheKey = 'notification_sent_' . $tahapan;
            Cache::forget($cacheKey);

            $izinEndingSoon = IUP::whereDate($tanggalKolom, '=', $oneYearFromNow)->get();

            if ($izinEndingSoon->isEmpty()) {
                Log::info('No IUPs found expiring within 1 year for ' . $tahapan);
            } else {
                Log::info('Found ' . $izinEndingSoon->count() . ' IUPs expiring within 1 year for ' . $tahapan);
                foreach ($izinEndingSoon as $izin) {
                    $user = $izin->user;
                    $namaPerusahaan = $user->namaPerusahaan;
                    $email = $user->email;
                    $wa = $user->wa;

                    Notification::route('mail', $email)
                        ->notify(new IzinAkhir($namaPerusahaan, $tahapan, $izin->$tanggalKolom, $tanggalKolom));
                    Log::info('Sent notification for IUP: ' . $namaPerusahaan . ' for ' . $tahapan);


                    if ($user->wa) {
                        $message = 'Hallo ' . $namaPerusahaan . ', '
                                 . 'Kami ingin menginformasikan bahwa pengajuan izin tambang Anda pada tahapan **' . $tahapan . '**' . ' akan berakhir pada tanggal **' . $izin->$tanggalKolom . '**' . '. '
                                 . 'Untuk informasi lebih lanjut, silakan login ke sistem https://minerbalampung.com/. '
                                 . 'Terimakasih - Tim Administrasi ESDM Bandar Lampung';

                        $this->twilio->sendWhatsAppMessage($user->wa, $message);
                        Log::info('Sent WhatsApp notification for IUP: ' . $namaPerusahaan . ' for ' . $tahapan);
                    }

                }
            }
        }
        Log::info('CheckIzinStatus job completed');
    }
}

