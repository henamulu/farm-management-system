<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    protected $fillable = [
        'name',
        'variety',
        'planting_date',
        'expected_harvest_date',
        'actual_harvest_date',
        'status',
        'area_size',
        'farm_id',
        'growth_stage',
        'health_status',
        'notes'
    ];

    protected $casts = [
        'planting_date' => 'datetime',
        'expected_harvest_date' => 'datetime',
        'actual_harvest_date' => 'datetime'
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function growthRecords()
    {
        return $this->hasMany(GrowthRecord::class);
    }
} 