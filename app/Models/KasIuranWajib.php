<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class KasIuranWajib extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'kas_iuran_wajibs';
    protected $fillable = ['jenis_iuran_id', 'bulan', 'tahun', 'penerima', 'pemberi', 'total_biaya', 'bukti_pembayaran'];
    protected $dates = [
        'created_at'
    ];

    public function iuranwajib()
    {
        return $this->belongsTo(IuranWajib::class, 'jenis_iuran_id');
    }

    // public function setwaktu($value)
    // {
    //     $this->attributes['created_at'] = Carbon::createFromFormat('d-m-Y', $value);
    // }
}
