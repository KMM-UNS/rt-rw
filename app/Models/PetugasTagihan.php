<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FillableInputTrait;

class PetugasTagihan extends Model
{
    use HasFactory;
    use SoftDeletes;
    use FillableInputTrait;

    public const ACTIVE = "aktif";

    protected $table = 'petugas_tagihan';
    protected $fillable = [ 'user_id', 'pos_id'];
    protected $dates = [
        'created_at'
    ];

    public function KasIuranWajib()
    {
        return $this->hasMany(KasIuranWajib::class);
    }

    public function KasIuranAgenda()
    {
        return $this->hasMany(KasIuranAgenda::class);
    }

    public function KasIuranKondisional()
    {
        return $this->hasMany(KasIuranKondisional::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pos()
    {
        return $this->belongsTo(Pos::class);
    }

    // public function poss()
    // {
    //     return $this->belongsTo(Pos::class, 'pos');
    // }

    public function dokumen()
    {
        return $this->morphToMany(Dokumen::class, 'dokumenable');
    }
}
