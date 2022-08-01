<?php

namespace App\Models;

use App\Traits\FillableInputTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warga extends Model
{
    use HasFactory, SoftDeletes, FillableInputTrait;

    protected $table = 'warga';
    protected $fillable = [
        'keluarga_id',
        'nik',
        'nama',
        'jenis_kelamin',
        'agama_id',
        'golongan_darah_id',
        'tempat_lahir',
        'tanggal_lahir',
        'warga_negara_id',
        'pendidikan_id',
        'pekerjaan_id',
        'status_keluarga_id',
        'status_kawin_id',
        'alamat',
        'status_warga_id'
    ];

    protected $dates = [
        'tanggal_lahir'
    ];

    public function agama()
    {
        return $this->belongsTo(Agama::class);
    }

    public function golongan_darah()
    {
        return $this->belongsTo(GolonganDarah::class);
    }

    public function warga_negara()
    {
        return $this->belongsTo(WargaNegara::class);
    }

    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class);
    }

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class);
    }

    public function status_keluarga()
    {
        return $this->belongsTo(StatusKeluarga::class);
    }

    public function status_kawin()
    {
        return $this->belongsTo(StatusKawin::class);
    }

    public function status_warga()
    {
        return $this->belongsTo(StatusWarga::class);
    }

    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class);
    }

    public function dokumen()
    {
        return $this->morphToMany(Dokumen::class, 'dokumenable');
    }

    public function createable()
    {
        return $this->morphTo();
    }

    public function surat()
    {
        return $this->hasMany(Surat::class);
    }

    public function jadwal_ronda()
    {
        return $this->hasMany(JadwalRonda::class);
    }

    public function presensi_ronda()
    {
        return $this->hasMany(PresensiRonda::class);
    }
}
