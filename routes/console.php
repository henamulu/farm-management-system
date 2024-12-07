<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Add new commands
Artisan::command('weather:check', function () {
    $this->info('Checking weather conditions...');
    app(\App\Services\WeatherService::class)->checkForAlerts();
})->purpose('Check weather conditions and create alerts if necessary')->hourly();

Artisan::command('stock:check-levels', function () {
    $this->info('Checking stock levels...');
    \App\Models\Stock::chunk(100, function ($stocks) {
        foreach ($stocks as $stock) {
            if ($stock->isLowStock()) {
                app(\App\Services\AlertService::class)->createStockAlert($stock);
            }
        }
    });
})->purpose('Check stock levels and create alerts for low stock')->daily();
