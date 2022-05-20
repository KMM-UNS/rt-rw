<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Tahun extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'tahuns';
    protected $fillable = ['nama'];
    public $timestamps = false;

    public function tahun()
    {
        return $this->hasMany(Tahun::class);
    }


    // //new
    // public function rekapiuransukarela()
    // {
    //     return $this->hasMany(KasIuranSukaRela::class);
    // }

    //yang dulu
    // public function kasiuranWajib()
    // {
    //     return $this->hasMany(KasIuranWajib::class);
    // }
    public function kasiurankondisional()
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
    public function kasiuranWajib()
    {
        return $this->hasMany(KasIuranWajib::class);
    }


    // public function kasiuransukarela()
    // {
    //     return $this->hasMany(KasIuranSukaRela::class);
    // }
    // public function rekapiuranwajib()
    // {
    //     return $this->hasMany(RekapIuranWajib::class);
    // }
}
