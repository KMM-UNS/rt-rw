<?php

namespace App\Models;

use App\Traits\FillableInputTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class App extends Model
{
    use HasFactory;
    use SoftDeletes;
    use FillableInputTrait;

    protected $table = 'apps';
    protected $fillable = [
        'nama',
        'rt',
        'rw',
        'kelurahan_id',
        'kecamatan_id',
        'kabupaten_id',
        'provinsi_id',
        'kode_pos',
        'telepon',
        'email',
        'ketua_rt',
        'ketua_rw'
    ];

    public function dokumen()
    {
        return $this->morphToMany(Dokumen::class, 'dokumenable');
    }

    public function provinsi()
    {
        return $this->belongsTo(Province::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Regency::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(District::class);
    }

    public function kelurahan()
    {
        return $this->belongsTo(Village::class);
    }
}
