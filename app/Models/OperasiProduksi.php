<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class OperasiProduksi extends Model
{
    use HasFactory;

    protected $table = 'operasi_produksi';
    protected $fillable = [
        'tanggalSK_op',
        'noSK_op',
        'masaBerlaku_op',
        'tanggalBerakhir_op',
    ];

    public function getStatusIzin($tahapanKegiatan)
    {
        $now = Carbon::now();
        $isActive = ($now->greaterThanOrEqualTo($this->tanggalSK_op) &&
                 $now->lessThanOrEqualTo($this->tanggalBerakhir_op)) ||
                ($now->isSameDay($this->tanggalSK_op) &&
                 $now->isSameDay($this->tanggalBerakhir_op));


        return $isActive ? 'Aktif' : 'Tidak Aktif';
    }
}
