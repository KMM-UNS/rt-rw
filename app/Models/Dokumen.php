<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = 'dokumen';
    protected $fillable = [
        'nama',
        'public_url'
    ];

    public function permohonanSkck()
    {
        return $this->morphedByMany(PermohonanSKCK::class, 'dokumenable');
    }

    public function pengawalan()
    {
        return $this->morphedByMany(Pengawalan::class, 'dokumenable');
    }
    public function ijinKeramaian()
    {
        return $this->morphedByMany(IjinKeramaian::class, 'dokumenable');
    }
}
