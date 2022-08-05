<?php

namespace App\Models;

use App\Traits\FillableInputTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WargaPindah extends Model
{
    use HasFactory, FillableInputTrait;
    protected $table = 'warga_pindah';
    protected $fillable = [
        'warga_id',
        'alamat_tujuan',
        'tanggal_pindah',
        'keterangan'
    ];
    protected $dates = [
        'tanggal_pindah'
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

}
