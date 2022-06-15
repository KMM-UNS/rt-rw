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
        'kelurahan',
        'kecamatan',
        'kabupaten',
        'provinsi',
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
}
