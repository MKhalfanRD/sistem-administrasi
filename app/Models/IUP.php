<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\IUPUpdated;

class IUP extends Model
{
    use HasFactory;
    protected $fillable = [
        'namaPerusahaan',
        'alamat',
        'npwp',
        'nib',
        'kabupaten',
        'luasWilayah',
        'tahapanKegiatan',
        'jenisKegiatan',
        'noSK_wiup',
        'noSK_eksplor',
        'noSK_op',
        'noSK_p1',
        'noSK_p2',
        'masaBerlaku_eksplor',
        'masaBerlaku_op',
        'masaBerlaku_p1',
        'masaBerlaku_p2',
        'tanggalSK_wiup',
        'tanggalSK_eksplor',
        'tanggalSK_op',
        'tanggalSK_p1',
        'tanggalSK_p2',
        'tanggalBerakhir_eksplor',
        'tanggalBerakhir_op',
        'tanggalBerakhir_p1',
        'tanggalBerakhir_p2',
        'komoditas_wiup',
        'komoditas_eksplor',
        'komoditas_op',
        'komoditas_p1',
        'komoditas_p2',
        'golongan_wiup',
        'golongan_eksplor',
        'golongan_op',
        'golongan_p1',
        'golongan_p2',
        'lokasiIzin',
        'statusIzin',
        'scanSK_wiup',
        'scanSK_eksplor',
        'scanSK_op',
        'scanSK_p1',
        'scanSK_p2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
