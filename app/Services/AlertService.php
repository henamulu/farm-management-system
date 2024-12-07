<?php

namespace App\Services;

use App\Models\Alert;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\StockAlert;
use App\Notifications\WeatherAlert;

class AlertService
{
    public function createStockAlert($stock)
    {
        if ($stock->isLowStock()) {
            $alert = Alert::create([
                'type' => 'stock',
                'message' => "Low stock alert for {$stock->item_name}",
                'severity' => 'medium',
                'farm_id' => $stock->farm_id
            ]);

            // Notify farm managers
            $managers = User::whereHas('farms', function($query) use ($stock) {
                $query->where('id', $stock->farm_id);
            })->get();

            Notification::send($managers, new StockAlert($alert));

            return $alert;
        }
    }

    public function createWeatherAlert($condition, $farm_id)
    {
        $alert = Alert::create([
            'type' => 'weather',
            'message' => "Weather alert: {$condition}",
            'severity' => 'high',
            'farm_id' => $farm_id
        ]);

        $managers = User::whereHas('farms', function($query) use ($farm_id) {
            $query->where('id', $farm_id);
        })->get();

        Notification::send($managers, new WeatherAlert($alert));

        return $alert;
    }
} 