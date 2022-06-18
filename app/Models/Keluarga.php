<?php

namespace App\Models;

use App\Traits\FillableInputTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keluarga extends Model
{
    use HasFactory, SoftDeletes, FillableInputTrait;

    protected $table = 'keluarga';
    protected $fillable = [
        'no_kk',
        'kepala_keluarga',
        'rumah_id',
        'telp'
    ];

    public function warga()
    {
        return $this->hasMany(Warga::class);
    }

    public function rumah()
    {
        return $this->belongsTo(Rumah::class);
    }

    public function status_tinggal()
    {
        return $this->belongsTo(StatusTinggal::class, 'status_tinggal');
    }

    public function riwayat_rumah()
    {
        return $this->hasMany(RiwayatRumah::class);
    }

    public function createable()
    {
        return $this->morphTo();
    }

    public function tamu()
    {
        return $this->hasMany(Tamu::class);
    }
}
