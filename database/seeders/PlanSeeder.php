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
            Plan::create([
                'farm_id' => $farm->id,
                'name' => 'Plan de Cultivo 2024',
                'target_amount' => 100000.00,
                'actual_amount' => 50000.00,
                'start_date' => now(),
                'end_date' => now()->addYear(),
                'status' => 'in_progress'
            ]);

            Plan::create([
                'farm_id' => $farm->id,
                'name' => 'Plan de Expansión',
                'target_amount' => 250000.00,
                'actual_amount' => 0.00,
                'start_date' => now()->addMonths(3),
                'end_date' => now()->addMonths(15),
                'status' => 'pending'
            ]);
        }
    }
} 