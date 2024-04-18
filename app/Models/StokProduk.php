<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokProduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'namaPerusahaan',
        'volumeStokProduk',
        'tonaseStokProduk',
        'bulan',
        'tahun',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
