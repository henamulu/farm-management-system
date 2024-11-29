<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'type',
        'period_start',
        'period_end',
        'farm_id',
        'data',
        'generated_by'
    ];

    protected $casts = [
        'period_start' => 'datetime',
        'period_end' => 'datetime',
        'data' => 'array'
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function generator()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }
} 