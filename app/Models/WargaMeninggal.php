<?php

namespace App\Models;

use App\Traits\FillableInputTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WargaMeninggal extends Model
{
    use HasFactory, FillableInputTrait;
    protected $table = 'warga_meninggal';
    protected $fillable = [
        'warga_id',
        'waktu',
        'penyebab',
        'tempat_pemakaman'
    ];
    protected $dates = [
        'waktu'
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}
