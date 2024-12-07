<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'category',
        'quantity',
        'unit',
        'minimum_threshold',
        'farm_id'
    ];

    protected $casts = [
        'quantity' => 'float',
        'minimum_threshold' => 'float'
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function isLowStock(): bool
    {
        return $this->quantity <= $this->minimum_threshold;
    }
}