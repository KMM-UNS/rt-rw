<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $fillable = ['name', 'value'];
    public $timestamps = false;

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::slug($value);
    }
}
