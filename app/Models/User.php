<?php

namespace App\Models;

use App\Traits\FillableInputTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Shanmuga\LaravelEntrust\Traits\LaravelEntrustUserTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, LaravelEntrustUserTrait, FillableInputTrait;

    protected $fillableMapPrefix = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'isVerified',
        'otp'
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
        // 'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }
    //tambahan
    public function role()
    {
        return $this->belongsTo(AdminRole::class, 'role_id');
    }

    public function petugas_tagihan()
    {

    }
}
