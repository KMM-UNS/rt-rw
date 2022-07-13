<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RekapIuranSukarela extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'rekap_iuran_sukarelas';
    protected $fillable = ['jenis_iuran_id', 'tahun', 'bulan'];
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

    //new
}
