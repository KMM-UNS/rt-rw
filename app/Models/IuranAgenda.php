<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class IuranAgenda extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'iuran_agendas';
    protected $fillable = ['nama'];
    public $timestamps = false;

    public function KasIuranSukarela()
    {
        return $this->hasMany(KasIuranSukarela::class);
    }
}
