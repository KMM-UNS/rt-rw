<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class IuranKondisional extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'iuran_kondisionals';
    protected $fillable = ['nama'];
    public $timestamps = false;

    public function KasIuranKondisional()
    {
        return $this->hasMany(KasIuranKondisional::class);
    }
}
