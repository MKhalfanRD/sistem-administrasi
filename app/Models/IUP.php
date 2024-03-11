<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'komoditas',
        'lokasiIzin',
        'statusIzin',
        'scanSK'
    ];

}
