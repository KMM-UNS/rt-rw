<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class  IuranWajib extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'iuran_wajibs';
    protected $fillable = ['nama'];
    public $timestamps = false;

    public function KasIuranWajib()
    {
        return $this->hasMany(KasIuranWajib::class);
    }

    //yang dulu
    // public function rekapiuranwajib()
    // {
    //     return $this->hasMany(RekapIuranWajib::class);
    // }
}
