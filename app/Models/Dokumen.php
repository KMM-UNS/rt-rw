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

    public function keluarga()
    {
        return $this->morphedByMany(Keluarga::class, 'dokumenable');
    }

    public function tamu()
    {
        return $this->morphedByMany(Tamu::class, 'dokumenable');
    }
    
    public function kasiurankondisional()
    {
        return $this->morphedByMany(KasIuranKondisional::class, 'dokumenable');
    }

    public function kasiuranwajib()
    {
        return $this->morphToMany(KasIuranWajib::class, 'dokumenable');
    }
    public function kasiuransukarela()
    {
        return $this->morphToMany(KasIuranSukaRela::class, 'dokumenable');
    }
    public function petugas_tagihan()
    {
        return $this->morphToMany(PetugasTagihan::class, 'dokumenable');
    }
    public function pengeluaran()
    {
        return $this->morphToMany(ManajemenPengeluaran::class, 'dokumenable');
    }
 
}
