<?php

namespace App\Models;

use App\Traits\FillableInputTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keluarga extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'keluargas';
    protected $fillable = [
        'user_id',
        'no_kk',
        'warga',
        'telp',
        'pos_tagihan',
    ];
    public $timestamps = false;

    public function pos()
    {
        return $this->belongsTo(Pos::class, 'pos_tagihan');
    }
    public function warga_wajib()
    {
        return $this->hasMany(KasIuranWajib::class, 'warga');
    }
    public function warga_kondisional()
    {
        return $this->hasMany(KasIuranKondisional::class, 'warga');
    }
    public function warga_sukarela()
    {
        return $this->hasMany(KasIuranSukaRela::class, 'warga');
    }
    public function warga_agenda()
    {
        return $this->hasMany(KasIuranAgenda::class, 'warga');
    }
    public function postagihan()
    {
        return $this->belongsTo(Pos::class, 'pos_tagihan');
    }
}
