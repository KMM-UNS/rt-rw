<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Pos extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'pos';
    protected $fillable = ['nama'];
    public $timestamps = false;

    public function petugastagihan()
    {
        return $this->hasOne(PetugasTagihan::class, 'pos');
    }
    public function postagihanagenda()
    {
        return $this->hasMany(KasIuranAgenda::class, 'nama');
    }
    public function postagihankondisional()
    {
        return $this->hasMany(KasIuranKondisional::class, 'nama');
    }
    public function postagihansukarela()
    {
        return $this->hasMany(KasIuranSukaRela::class, 'nama');
    }
    public function postagihanwajib()
    {
        return $this->hasMany(KasIuranWajib::class, 'nama');
    }
    public function keluarga()
    {
        return $this->hasMany(Keluarga::class);
    }
    public function postagihan()
    {
        return $this->hasMany(Keluarga::class, 'nama');
    }
}
