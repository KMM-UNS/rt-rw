<?php

namespace App\Models;

use App\Traits\FillableInputTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keluarga extends Model
{
    use HasFactory, SoftDeletes, FillableInputTrait;

    protected $table = 'keluargas';
    protected $fillable = [
        'no_kk',
        'warga',
        'rumah_id',
        'telp',
        'status_tinggal',
        'createable_id',
        'createable_type',
        'pos_tagihan',
        'status'
    ];

    public function pos()
    {
        return $this->belongsTo(Pos::class, 'pos_tagihan');
    }
    // public function warga_wajibb()
    // {
    //     return $this->belongsTo(KasIuranWajib::class, 'warga');
    // }
    // public function pemberii()
    // {
    //     return $this->hasMany(KasIuranAgenda::class, 'warga');
    // }
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
}
