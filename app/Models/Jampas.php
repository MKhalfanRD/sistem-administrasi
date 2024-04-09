<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jampas extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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
        'filePasca'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
