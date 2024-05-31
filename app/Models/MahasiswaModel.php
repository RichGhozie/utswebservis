<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'mahasiswas';
    protected $fillable = [
        'nim',
        'password',
        'nama_mahasiswa',
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->formatLocalized('%d %B %Y');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->formatLocalized('%d %B %Y');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
