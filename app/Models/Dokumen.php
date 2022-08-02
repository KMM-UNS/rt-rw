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
    // public function pengawalan()
    // {
    //     return $this->morphedByMany(Pengawalan::class, 'dokumenable');
    // }
    // public function ijinKeramaian()
    // {
    //     return $this->morphedByMany(IjinKeramaian::class, 'dokumenable');
    // }
}
