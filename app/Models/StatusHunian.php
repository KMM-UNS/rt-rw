<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusHunian extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const ACTIVE = "aktif";

    protected $table = 'status_hunian';
    protected $fillable = ['nama'];
    public $timestamps = false;
}
