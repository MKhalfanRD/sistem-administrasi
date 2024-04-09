<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KTT extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'namaPerusahaan',
        'namaKtt',
        'statusKTT',
        'noSK',
        'bulan',
        'tahun',
        'fileUpload',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
