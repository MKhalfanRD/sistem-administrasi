<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perpanjangan2 extends Model
{
    use HasFactory;

    protected $table = 'perpanjangan2';
    protected $fillable = [
        'tanggalSK_p2',
        'noSK_p2',
        'masaBerlaku_p2',
        'tanggalBerakhir_p2',
    ];

    public function getStatusIzin($tahapanKegiatan)
    {
        $now = Carbon::now();
        $isActive = ($now->greaterThanOrEqualTo($this->tanggalSK_p2) &&
                 $now->lessThanOrEqualTo($this->tanggalBerakhir_p2)) ||
                ($now->isSameDay($this->tanggalSK_p2) &&
                 $now->isSameDay($this->tanggalBerakhir_p2));


        return $isActive ? 'Aktif' : 'Tidak Aktif';
    }
}
