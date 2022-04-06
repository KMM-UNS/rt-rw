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

    public function rumah()
    {
        return $this->morphedByMany(Rumah::class, 'dokumenable');
    }

    public function warga()
    {
        return $this->morphedByMany(Warga::class, 'dokumenable');
    }
}
