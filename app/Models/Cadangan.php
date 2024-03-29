<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cadangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaPerusahaan',
        'komoditas',
        'volumeTerkira',
        'tonaseTerkira',
        'volumeTerbukti',
        'tonaseTerbukti',
        'luas',
        'cp',
    ];
}
