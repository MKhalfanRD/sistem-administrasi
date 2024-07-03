<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $fillable = [
        'namaUser',
        'namaPerusahaan',
        'email',
        'wa',
        'password',
        'logo'
    ];

    public function iup(){
        return $this->hasMany(IUP::class, 'namaPerusahaan', 'namaPerusahaan');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function cadangan ()
    {
        return $this->hasOne(Cadangan::class, 'user_id');
    }

    public function iups()
    {
      return $this->hasMany(IUP::class, 'user_id');
    }

    public function jampas()
    {
        return $this->hasOne(Jamrek::class, 'user_id');
    }

    public function jamrek()
    {
        return $this->hasOne(Jamrek::class, 'user_id');
    }

    public function ktt()
    {
        return $this->hasOne(KTT::class, 'user_id');
    }

    public function produksi()
    {
        return $this->hasOne(Produksi::class, 'user_id');
    }

    public function rawInventori()
    {
        return $this->hasOne(rawInventori::class, 'user_id');
    }

    public function sumberdaya()
    {
        return $this->hasOne(Sumberdaya::class, 'user_id');
    }
}
