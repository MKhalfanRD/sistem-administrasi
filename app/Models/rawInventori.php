<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rawInventori extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'namaPerusahaan',
        'volumeRawInventori',
        'tonaseRawInventori',
        'bulan',
        'tahun',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
