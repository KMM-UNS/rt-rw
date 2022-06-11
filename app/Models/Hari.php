<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hari extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'hari';
    protected $fillable = ['nama'];
    public $timestamps = false;

    public function jadwal_ronda()
    {
        return $this->hasMany(JadwalRonda::class);
    }

    public function presensi_ronda()
    {
        return $this->hasMany(PresensiRonda::class);
    }

}
