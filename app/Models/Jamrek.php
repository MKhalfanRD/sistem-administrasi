<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jamrek extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaPerusahaan',
        'besaranDitetapkan',
        'tanggal',
        'filePenempatan',
        'besaranDitempatkan',
        'tanggalPenempatan',
        'jatuhTempo',
        'namaBank',
        'bentukPenempatan',
        'noSeri',
        'noRekening',
        'fileReklamasi'
    ];
}
