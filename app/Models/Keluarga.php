<?php

namespace App\Models;

use App\Traits\FillableInputTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keluarga extends Model
{
    use HasFactory, SoftDeletes, FillableInputTrait;

    protected $table = 'keluargas';
    protected $fillable = [
        'no_kk',
        'kepala_keluarga',
        'pos_tagihan',
        'telp'
    ];

    public function pos()
    {
        return $this->belongsTo(Pos::class, 'pos_tagihan');
    }
}
