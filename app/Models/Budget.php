<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [
        'name',
        'period_start',
        'period_end',
        'farm_id',
        'crop_id',
        'planned_amount',
        'actual_amount',
        'category',
        'status'
    ];

    protected $casts = [
        'period_start' => 'datetime',
        'period_end' => 'datetime',
        'planned_amount' => 'decimal:2',
        'actual_amount' => 'decimal:2'
    ];
} 