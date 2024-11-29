<?php

namespace App\Services;

use App\Models\Alert;
use App\Models\Stock;
use App\Events\AlertTriggered;

class AlertService
{
    public function checkStockLevels()
    {
        $lowStockItems = Stock::where('quantity', '<=', 'minimum_threshold')
            ->get();

        foreach ($lowStockItems as $item) {
            $this->createStockAlert($item);
        }
    }

    public function createStockAlert(Stock $stock)
    {
        $alert = Alert::create([
            'type' => 'stock_level',
            'message' => "Nivel bajo de stock para {$stock->item_name}",
            'severity' => 'high',
            'farm_id' => $stock->farm_id,
            'resource_id' => $stock->id,
            'resource_type' => Stock::class,
            'is_read' => false
        ]);

        event(new AlertTriggered($alert));

        return $alert;
    }

    public function checkActivityDeadlines()
    {
        $nearDeadlineActivities = Activity::where('end_date', '<=', now()->addDays(3))
            ->where('status', '!=', 'completed')
            ->get();

        foreach ($nearDeadlineActivities as $activity) {
            $this->createActivityAlert($activity);
        }
    }
} 