<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KeperluanSurat extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'keperluan_surat';
    protected $fillable = ['nama'];

    public function surat()
    {
        return $this->hasMany(Surat::class);
    }
}
