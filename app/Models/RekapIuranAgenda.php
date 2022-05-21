<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RekapIuranAgenda extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'rekap_iuran_agendas';
    protected $fillable = ['jenis_iuran_id', 'tahun', 'bulan'];
    protected $dates = [
        'created_at'
    ];
}
