<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Weather API Configuration
    |--------------------------------------------------------------------------
    */

    'api_key' => env('WEATHER_API_KEY'),
    'api_url' => env('WEATHER_API_URL', 'https://api.weatherapi.com/v1'),
    
    'cache_duration' => env('WEATHER_CACHE_DURATION', 1800), // 30 minutes

    'alert_thresholds' => [
        'temperature_high' => env('WEATHER_ALERT_TEMP_HIGH', 35),
        'temperature_low' => env('WEATHER_ALERT_TEMP_LOW', 0),
        'wind_speed' => env('WEATHER_ALERT_WIND_SPEED', 50),
        'precipitation' => env('WEATHER_ALERT_PRECIPITATION', 100),
    ],
]; 