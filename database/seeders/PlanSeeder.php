<?php

namespace Database\Seeders;

use App\Models\Farm;
use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        $farms = Farm::all();

        foreach ($farms as $farm) {
            // Create sample plans for each farm
            Plan::create([
                'farm_id' => $farm->id,
                'farm_item' => 'Land Clearing',
                'quantity' => 100,
                'unit' => 'ha',
                'start_date' => now(),
                'end_date' => now()->addMonths(2),
                'operation_price' => 2500,
                'status' => 'draft'
            ]);

            Plan::create([
                'farm_id' => $farm->id,
                'farm_item' => 'Planting',
                'quantity' => 75,
                'unit' => 'ha',
                'start_date' => now()->addMonths(2),
                'end_date' => now()->addMonths(4),
                'operation_price' => 1800,
                'status' => 'draft'
            ]);
        }
    }
} 