<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plan extends Model
{
    protected $fillable = [
        'farm_id',
        'name',
        'target_amount',
        'actual_amount',
        'start_date',
        'end_date',
        'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'target_amount' => 'decimal:2',
        'actual_amount' => 'decimal:2'
    ];

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }
} 