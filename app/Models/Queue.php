<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $fillable = ['number', 'status', 'called_at'];

    public function logs()
    {
        return $this->hasMany(QueueLog::class);
    }
}
