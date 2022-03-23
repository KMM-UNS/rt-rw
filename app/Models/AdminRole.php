<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminRole extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    
    protected $table = 'admin_role';
    protected $fillable = [
        'name'
    ];
    public $timestamps = false;
    public function admin()
    {
        return $this->hasOne(Admin::class);
    }
}
