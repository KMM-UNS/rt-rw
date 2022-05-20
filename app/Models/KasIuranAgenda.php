<?php

namespace App\Models;

use App\Traits\FillableInputTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KasIuranAgenda extends Model
{
    use HasFactory;
    use SoftDeletes;
    use FillableInputTrait;

    public const ACTIVE = "aktif";

    protected $table = 'kas_iuran_agendas';
    protected $fillable = ['jenis_iuran_id', 'bulan', 'tahun', 'petugas', 'pemberi', 'total_biaya', 'bukti_pembayaran'];
    protected $dates = [
        'created_at'
    ];

    public function iuranagenda()
    {
        return $this->belongsTo(iuranagenda::class, 'jenis_iuran_id');
    }
    public function petugastagihan()
    {
        return $this->belongsTo(PetugasTagihan::class, 'petugas');
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
