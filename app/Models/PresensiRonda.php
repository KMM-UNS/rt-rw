<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Traits\FillableInputTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PresensiRonda extends Model
{
    use HasFactory;
    use SoftDeletes;
    use FillableInputTrait;

    protected $table = 'presensi_ronda';
    protected $fillable = [
        'jadwal_ronda_id',
        'hari_id',
        'tanggal',
        'kehadiran'
    ];
    protected $dates = [
        'tanggal'
    ];

    public function hari()
    {
        return $this->belongsTo(Hari::class);
    }

    public function jadwal_ronda()
    {
        return $this->belongsTo(JadwalRonda::class);
    }

    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = Carbon::createFromFormat('d-m-Y', $value);
    }

}
