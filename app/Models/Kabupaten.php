<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    protected $fillable = ['kabupaten'];

    public function iup(){
        return $this->hasMany(IUP::class, 'kabupaten', 'kabupaten');
    }
}
