<?php

namespace App\Models;

use App\Traits\FillableInputTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tamu extends Model
{
    use HasFactory, SoftDeletes, FillableInputTrait;

    protected $table = 'tamu';
    protected $fillable = [
        'jumlah',
        'nama',
        'alamat',
        'hubungan',
        'tanggal_tiba',
        'lama_menetap',
        'keluarga_id',
    ];

    protected $dates = [
        'tanggal_tiba'
    ];

    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class);
    }

    public function createable()
    {
        return $this->morphTo();
    }

    public function dokumen()
    {
        return $this->morphToMany(Dokumen::class, 'dokumenable');
    }
}
