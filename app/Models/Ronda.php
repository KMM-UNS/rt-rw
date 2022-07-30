<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ronda extends Model
{
    use HasFactory;
    // use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'ronda';
    protected $fillable = ['nama', 'status'];

    public function jadwal_ronda()
    {
        return $this->hasMany(JadwalRonda::class);
    }
}
