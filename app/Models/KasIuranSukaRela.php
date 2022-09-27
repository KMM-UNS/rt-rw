<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FillableInputTrait;

class KasIuranSukaRela extends Model
{
    use HasFactory;
    use SoftDeletes;
    use FillableInputTrait;

    public const ACTIVE = "aktif";

    protected $table = 'kas_iuran_suka_relas';
    protected $fillable = ['jenis_iuran_id', 'tanggal', 'warga', 'pos', 'total_biaya', 'status'];
    protected $dates = [
        'created_at'
    ];

    public function iuransukarela()
    {
        return $this->belongsTo(IuranSukarela::class, 'jenis_iuran_id');
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
    public function jenisiuransukarela()
    {
        return $this->belongsTo(IuranSukarela::class, 'jenis_iuran_id');
    }
    public function dokumen()
    {
        return $this->morphToMany(Dokumen::class, 'dokumenable');
    }
    //tamabahan dropdown pemberi
    public function warga_sukarela()
    {
        return $this->belongsTo(Keluarga::class, 'warga');
    }
    public function postagihansukarela()
    {
        return $this->belongsTo(Pos::class, 'pos');
    }
}
