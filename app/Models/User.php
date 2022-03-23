<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function permohonanSkck()
    {
        return $this->morphMany(PermohonanSKCK::class, 'createable');
    }

    public function pemohon()
    {
        return $this->morphMany(Pemohon::class, 'createable');
    }

    public function kehilanganBarang()
    {
        return $this->morphMany(KehilanganBarang::class, 'createable');
    }

    public function spkt()
    {
        return $this->morphMany(SPKT::class, 'createable');
    }
}
