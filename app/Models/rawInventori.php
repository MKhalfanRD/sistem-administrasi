<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rawInventori extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaPerusahaan',
        'volumeRawInventori',
        'tonaseRawInventori',
        'bulan',
        'tahun',
    ];
}
