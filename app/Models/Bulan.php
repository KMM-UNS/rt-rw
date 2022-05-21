<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Bulan extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'bulans';
    protected $fillable = ['nama'];
    public $timestamps = false;

    // public function iuranbulanan()
    // {
    //     return $this->hasMany(IuranBulanan::class);
    // }

    // //membuat iuran bulanan
    // public function rekapiuranwajib()
    // {
    //     return $this->hasMany(rekapiuranwajib::class);
    // }

    //yang dulu
    // public function rekapiuransukarela()
    // {
    //     return $this->hasMany(KasIuranSukarela::class);
    // }
    // public function kasiuranwajib()
    // {
    //     return $this->hasMany(KasIuranWajib::class);
    // }

    //membuat crud kas
    public function kasiurankonsisional()
    {
        return $this->hasMany(KasIuranKondisional::class);
    }
    public function kasiuransukarela()
    {
        return $this->hasMany(KasIuranSukaRela::class);
    }
    public function kasiuranagenda()
    {
        return $this->hasMany(KasIuranAgenda::class);
    }
    public function kasiuranwajib()
    {
        return $this->hasMany(KasIuranWajib::class);
    }



    //new
    // public function rekapbulanansukarela()
    // {
    //     return $this->hasMany(KasIuranSukarela::class);
    // }
}
