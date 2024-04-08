<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaPerusahaan',
        'komoditas',
        'bulan',
        'tahun',
        'buktiBayar',
        'volumeProduksi',
        'tonaseProduksi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
