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
        'noSK',
        'luasWilayah',
        'tahapanKegiatan',
        'komoditas',
        'masaBerlaku',
        'tanggalSK',
        'tanggalBerakhir',
        'lokasiIzin',
        'statusIzin',
        'scanSK'
    ];
}
