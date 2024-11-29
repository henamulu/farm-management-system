<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'type',          // 'email', 'sms', 'system'
        'title',
        'message',
        'status',        // 'pending', 'sent', 'failed'
        'sent_at',
        'read_at',
        'data',          // datos adicionales en JSON
        'priority'       // 'low', 'medium', 'high'
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'read_at' => 'datetime',
        'data' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 