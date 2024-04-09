<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cadangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'namaPerusahaan',
        'komoditas',
        'volumeTerkira',
        'tonaseTerkira',
        'volumeTerbukti',
        'tonaseTerbukti',
        'luas',
        'cp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
