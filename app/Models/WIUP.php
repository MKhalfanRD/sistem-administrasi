<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class WIUP extends Model
{
    use HasFactory;
    protected $table = 'wiup';
    protected $fillable = [
        'tanggalSK_wiup',
        'noSK_wiup',
    ];

    public function getStatusIzin($tahapanKegiatan)
    {
        if($this->tanggalSK_wiup){
            return 'Aktif';
        }else{
            return 'Tidak Aktif';
        }
    }
}
