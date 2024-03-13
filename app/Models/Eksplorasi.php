<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Eksplorasi extends Model
{
    use HasFactory;

    protected $table = 'eksplorasi';

    protected $fillable = [
        'tanggalSK_eksplor',
        'noSK_eksplor',
        'masaBerlaku_eksplor',
        'tanggalBerakhir_eksplor',
    ];

    public function iup()
    {
        return $this->belongsTo(IUP::class, 'i_u_p_id');
    }

    public function getStatusIzin($tahapanKegiatan)
    {
        $now = Carbon::now();
        $isActive = ($now->greaterThanOrEqualTo($this->tanggalSK_eksplor) &&
                 $now->lessThanOrEqualTo($this->tanggalBerakhir_eksplor)) ||
                ($now->isSameDay($this->tanggalSK_eksplor) &&
                 $now->isSameDay($this->tanggalBerakhir_eksplor));

        return $isActive ? 'Aktif' : 'Tidak Aktif';
    }
}
