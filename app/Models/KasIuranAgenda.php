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
    protected $fillable = ['jenis_iuran_id', 'tanggal', 'warga', 'pos', 'total_biaya', 'status'];
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
    //membuat dropdown jenis iuran
    public function jenisiuranagenda()
    {
        return $this->belongsTo(IuranAgenda::class, 'jenis_iuran_id');
    }
    public function dokumen()
    {
        return $this->morphToMany(Dokumen::class, 'dokumenable');
    }
    //tamabahan dropdown pemberi
    // public function pemberii()
    // {
    //     return $this->belongsTo(Keluarga::class, 'warga');
    // }
    public function warga_agenda()
    {
        return $this->belongsTo(Keluarga::class, 'warga');
    }
    public function postagihanagenda()
    {
        return $this->belongsTo(Pos::class, 'pos');
    }
}
