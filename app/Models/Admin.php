<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Model
{
    // Jika kamu ingin menggunakan autentikasi laravel seperti Auth::guard(), ganti ke:
    // use Illuminate\Foundation\Auth\User as Authenticatable;
    // dan extend ke Authenticatable

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
    
    public function queueLogs()
    {
        return $this->hasMany(QueueLog::class);
    }
}
