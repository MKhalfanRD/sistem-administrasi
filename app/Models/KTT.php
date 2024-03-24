<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KTT extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaPerusahaan',
        'namaKtt',
        'statusKTT',
        'noSK',
        'bulan',
        'tahun',
        'fileUpload',
    ];
}
