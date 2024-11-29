<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $fillable = [
        'type',
        'message',
        'severity',
        'farm_id',
        'resource_id',
        'is_read',
        'triggered_by'
    ];

    protected $casts = [
        'is_read' => 'boolean'
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function resource()
    {
        return $this->morphTo();
    }
} 