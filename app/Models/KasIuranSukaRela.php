<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class KasIuranSukaRela extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'kas_iuran_suka_relas';
    protected $fillable = ['jenis_iuran', 'bulan', 'tahun', 'penerima', 'pemberi', 'total_biaya', 'bukti_pembayaran'];
    protected $dates = [
        'created_at'
    ];
}
