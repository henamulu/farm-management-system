<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Machinery extends Model
{
    protected $fillable = [
        'farm_id',
        'name',
        'type',
        'status',
        'last_maintenance',
        'next_maintenance',
        'purchase_date',
        'purchase_price'
    ];

    protected $casts = [
        'last_maintenance' => 'date',
        'next_maintenance' => 'date',
        'purchase_date' => 'date',
        'purchase_price' => 'decimal:2'
    ];

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }
} 