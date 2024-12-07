<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Notification Settings
    |--------------------------------------------------------------------------
    */

    'channels' => [
        'mail' => [
            'enabled' => env('NOTIFICATIONS_MAIL_ENABLED', true),
            'queue' => env('NOTIFICATIONS_MAIL_QUEUE', 'notifications'),
        ],
        'slack' => [
            'enabled' => env('NOTIFICATIONS_SLACK_ENABLED', false),
            'webhook_url' => env('NOTIFICATIONS_SLACK_WEBHOOK_URL'),
        ],
        'sms' => [
            'enabled' => env('NOTIFICATIONS_SMS_ENABLED', false),
            'provider' => env('NOTIFICATIONS_SMS_PROVIDER', 'twilio'),
        ],
    ],

    'batch_size' => env('NOTIFICATIONS_BATCH_SIZE', 100),
    'retry_after' => env('NOTIFICATIONS_RETRY_AFTER', 3600), // 1 hour
]; 