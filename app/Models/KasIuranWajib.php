<?php

namespace App\Models;

use App\Traits\FillableInputTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class KasIuranWajib extends Model
{
    use HasFactory;
    use SoftDeletes;
    use FillableInputTrait;

    public const ACTIVE = "aktif";

    protected $table = 'kas_iuran_wajibs';
    protected $fillable = ['jenis_iuran_id', 'bulan', 'tahun', 'penerima_id', 'pemberi', 'total_biaya'];
    protected $dates = [
        'created_at'
    ];

    public function iuranwajib()
    {
        return $this->belongsTo(IuranWajib::class, 'jenis_iuran_id');
    }
    public function petugastagihan()
    {
        return $this->belongsTo(PetugasTagihan::class, 'penerima_id');
    }
    public function namabulanss()
    {
        return $this->belongsTo(Bulan::class, 'bulan');
    }
    public function tahuns()
    {
        return $this->belongsTo(Tahun::class, 'tahun');
    }
    public function dokumen()
    {
        return $this->morphToMany(Dokumen::class, 'dokumenable');
    }
}
