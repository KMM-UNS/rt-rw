<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FillableInputTrait;

class ManajemenPengeluaran extends Model
{
    use HasFactory;
    use SoftDeletes;
    use FillableInputTrait;

    public const ACTIVE = "aktif";

    protected $table = 'manajemen_pengeluarans';
    protected $fillable = ['tanggal', 'keterangan', 'nominal'];
    public $timestamps = true;

    public function dokumen()
    {
        return $this->morphToMany(Dokumen::class, 'dokumenable');
    }
}
