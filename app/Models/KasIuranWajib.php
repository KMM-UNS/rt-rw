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
    protected $fillable = ['jenis_iuran_id', 'tanggal', 'warga', 'pos', 'total_biaya', 'status'];
    // protected $dates = [
    //     'created_at'
    // ];

    public function iuranwajib()
    {
        return $this->belongsTo(IuranWajib::class, 'jenis_iuran_id');
    }
    public function petugastagihan()
    {
        return $this->belongsTo(PetugasTagihan::class, 'petugas');
    }
    // public function namabulanss()
    // {
    //     return $this->belongsTo(Bulan::class, 'bulan');
    // }
    // public function tahuns()
    // {
    //     return $this->belongsTo(Tahun::class, 'tahun');
    // }

    //membuat dropdown jenis iuran
    public function jenisiuranwajib()
    {
        return $this->belongsTo(IuranWajib::class, 'jenis_iuran_id');
    }
    public function dokumen()
    {
        return $this->morphToMany(Dokumen::class, 'dokumenable');
    }
    //tamabahan dropdown warga
    public function warga_wajib()
    {
        return $this->belongsTo(Keluarga::class, 'warga');
    }
    public function postagihanwajib()
    {
        return $this->belongsTo(Pos::class, 'pos');
    }
}
