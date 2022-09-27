<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IuranBulanan extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'iuran_bulanans';
    protected $fillable = ['bulan', 'tahun'];
    protected $dates = [
        'created_at'
    ];

    // public function namabulanss()
    // {
    //     return $this->belongsTo(Bulan::class, 'bulan');
    // }
    // public function tahuns()
    // {
    //     return $this->belongsTo(Tahun::class, 'tahun');
    // }
}
