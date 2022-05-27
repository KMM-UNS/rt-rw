<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusTinggal extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'status_tinggal';
    protected $fillable = ['nama'];
    public $timestamps = false;

    public function keluarga()
    {
        return $this->hasMany(Keluarga::class);
    }
}
