<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class IuranSukarela extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'iuran_sukarelas';
    protected $fillable = ['nama'];
    public $timestamps = false;

    public function kasiuransukarela()
    {
        return $this->hasMany(KasIuranSukaRela::class);
    }
}
