<?php

namespace App\Models;

use App\Traits\FillableInputTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rumah extends Model
{
    use HasFactory, SoftDeletes, FillableInputTrait;

    protected $table = 'rumah';
    protected $fillable = [
        'alamat',
        'nomor_rumah',
        'warga_id',
        'telp',
        'status_penggunaan_id',
        'status_hunian_id',
    ];

    public function status_penggunaan()
    {
        return $this->belongsTo(StatusPenggunaanRumah::class);
    }

    public function status_hunian()
    {
        return $this->belongsTo(StatusHunian::class);
    }

    public function dokumen()
    {
        return $this->morphToMany(Dokumen::class, 'dokumenable');
    }
}
