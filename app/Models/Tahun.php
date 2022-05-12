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
    public function KasIuranWajib()
    {
        return $this->hasMany(KasIuranWajib::class);
    }
}
