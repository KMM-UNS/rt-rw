<?php

namespace App\Models;

use App\Traits\FillableInputTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalRonda extends Model
{
    use HasFactory;
    use SoftDeletes;
    use FillableInputTrait;

    public const ACTIVE = "aktif";

    protected $table = 'jadwal_ronda';
    protected $fillable = [
        'warga_id',
        'hari_id',
    ];

    public function hari()
    {
        return $this->belongsTo(Hari::class);
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

}
