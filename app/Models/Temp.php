<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temp extends Model
{
    use HasFactory;
    protected $table = 'users_temp';
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'isVerified',
        'otp'
    ];
}
