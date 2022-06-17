<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ManajemenPengeluaran extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'manajemen_pengeluarans';
    protected $fillable = ['tanggal', 'keterangan', 'nominal'];
    public $timestamps = false;
}
