<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komoditas extends Model
{
    use HasFactory;

    protected $fillable = ['golongan', 'komoditas'];

    public function sumberdaya(){
        return $this->hasMany(Sumberdaya::class, 'komoditas', 'komoditas');
    }
}
