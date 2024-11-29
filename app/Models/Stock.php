<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'item_name',
        'category',
        'quantity',
        'unit',
        'minimum_threshold',
        'farm_id'
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
} 