<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Perpanjangan1 extends Model
{
    use HasFactory;

    protected $table = 'perpanjangan1';
    protected $fillable = [
        'tanggalSK_p1',
        'noSK_p1',
        'masaBerlaku_p1',
        'tanggalBerakhir_p1',
    ];

    public function getStatusIzin($tahapanKegiatan)
    {
        $now = Carbon::now();
        $isActive = ($now->greaterThanOrEqualTo($this->tanggalSK_p1) &&
                 $now->lessThanOrEqualTo($this->tanggalBerakhir_p1)) ||
                ($now->isSameDay($this->tanggalSK_p1) &&
                 $now->isSameDay($this->tanggalBerakhir_p1));


        return $isActive ? 'Aktif' : 'Tidak Aktif';
    }
}
