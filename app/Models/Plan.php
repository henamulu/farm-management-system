<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plan extends Model
{
    protected $fillable = [
        'farm_id',
        'farm_item',
        'quantity',
        'unit',
        'start_date',
        'end_date',
        'operation_price',
        'status'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'quantity' => 'decimal:2',
        'operation_price' => 'decimal:2'
    ];

    public const STATUSES = [
        'draft' => 'Draft',
        'approved' => 'Approved',
        'in_progress' => 'In Progress',
        'completed' => 'Completed'
    ];

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }
} 