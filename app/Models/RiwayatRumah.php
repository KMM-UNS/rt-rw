<?php

namespace App\Models;

use App\Traits\FillableInputTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatRumah extends Model
{
    use FillableInputTrait;
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'riwayat_rumah';
    protected $fillable = [
        'keluarga_id',
        'rumah_id',
        'tanggal_masuk',
        'tanggal_keluar',
    ];

    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class);
    }

    public function rumah()
    {
        return $this->belongsTo(Rumah::class);
    }
}
