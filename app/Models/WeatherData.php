<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeatherData extends Model
{
    protected $fillable = [
        'farm_id',
        'temperature',
        'humidity',
        'precipitation',
        'wind_speed',
        'weather_condition',
        'forecast_date',
        'data_source',
        'alerts'
    ];

    protected $casts = [
        'forecast_date' => 'datetime',
        'alerts' => 'array',
        'temperature' => 'float',
        'humidity' => 'float',
        'precipitation' => 'float',
        'wind_speed' => 'float'
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
} 