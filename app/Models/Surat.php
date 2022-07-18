<?php

namespace App\Models;

use App\Models\Warga;
use App\Models\StatusSurat;
use App\Models\KeperluanSurat;
use Illuminate\Support\Carbon;
use App\Traits\FillableInputTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Surat extends Model
{
    use HasFactory;
    use SoftDeletes;
    use FillableInputTrait;

    protected $table = 'surat';
    protected $fillable = [
        'nomor_surat',
        'warga_id',
        'keperluan_surat_id',
        'tanggal_pengajuan',
        'tanggal_disetujui',
        'keterangan',
        'status_surat_id'
    ];

    protected $dates = [
        'tanggal_pengajuan',
        'tanggal_disetujui'
    ];

    public function setTanggalPengajuanAttribute($value)
    {
        $this->attributes['tanggal_pengajuan'] = Carbon::createFromFormat('Y-m-d', $value);
    }




    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

    public function keperluan_surat()
    {
        return $this->belongsTo(KeperluanSurat::class);
    }

    public function status_surat()
    {
        return $this->belongsTo(StatusSurat::class);
    }

    public function createable()
    {
        return $this->morphTo();
    }
}
