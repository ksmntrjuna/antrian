<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QueueLog extends Model
{
    protected $fillable = ['admin_id', 'queue_id', 'action'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function queue()
    {
        return $this->belongsTo(Queue::class);
    }
}
