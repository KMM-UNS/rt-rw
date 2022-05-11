<?php

namespace App\Models;

use App\Traits\FillableInputTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KasIuranKondisional extends Model
{
    use HasFactory;
    use SoftDeletes;
    use FillableInputTrait;

    public const ACTIVE = "aktif";

    protected $table = 'kas_iuran_kondisionals';
    protected $fillable = ['jenis_iuran_id', 'bulan', 'tahun', 'nama_petugas', 'pemberi', 'total_biaya'];
    protected $dates = [
        'created_at'
    ];

    public function iurankondisional()
    {
        return $this->belongsTo(iurankondisional::class, 'jenis_iuran_id');
    }
    public function petugastagihan()
    {
        return $this->belongsTo(PetugasTagihan::class, 'nama_petugas');
    }
    public function dokumen()
    {
        return $this->morphToMany(Dokumen::class, 'dokumenable');
    }
}
