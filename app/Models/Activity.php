<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status',
        'start_date',
        'end_date',
        'farm_id',
        'assigned_to',
        'resource_requirements'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'resource_requirements' => 'array'
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
} 