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

    public function iuranbulanan()
    {
        return $this->hasMany(IuranBulanan::class);
    }
    public function KasIuranWajib()
    {
        return $this->hasMany(KasIuranWajib::class);
    }
}
