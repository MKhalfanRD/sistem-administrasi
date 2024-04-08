<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sumberdaya extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaPerusahaan',
        'komoditas',
        'volumeTereka',
        'volumeTertunjuk',
        'volumeTerukur',
        'tonaseTereka',
        'tonaseTertunjuk',
        'tonaseTerukur',
        'luas',
        'cp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
