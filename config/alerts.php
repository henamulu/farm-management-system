<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Alert System Configuration
    |--------------------------------------------------------------------------
    */

    'severities' => [
        'low' => 1,
        'medium' => 2,
        'high' => 3,
        'critical' => 4,
    ],

    'types' => [
        'stock' => [
            'threshold_percentage' => env('ALERT_STOCK_THRESHOLD', 20),
            'check_interval' => env('ALERT_STOCK_CHECK_INTERVAL', 86400), // 24 hours
        ],
        'weather' => [
            'check_interval' => env('ALERT_WEATHER_CHECK_INTERVAL', 3600), // 1 hour
        ],
        'system' => [
            'retention_days' => env('ALERT_SYSTEM_RETENTION_DAYS', 30),
        ],
    ],

    'notifications' => [
        'channels' => ['mail', 'database'],
        'immediate_severity' => ['critical', 'high'],
    ],
]; 