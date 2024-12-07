<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Execution;
use Illuminate\Database\Seeder;

class ExecutionSeeder extends Seeder
{
    public function run(): void
    {
        $plans = Plan::all();

        foreach ($plans as $plan) {
            // Ejecución en progreso
            Execution::create([
                'plan_id' => $plan->id,
                'farm_id' => $plan->farm_id,
                'activity' => 'Preparación de Terreno',
                'quantity' => 50,
                'unit' => 'hectáreas',
                'start_date' => now(),
                'end_date' => now()->addDays(15),
                'operation_price' => 1500.00,
                'status' => 'in_progress'
            ]);

            // Ejecución completada
            Execution::create([
                'plan_id' => $plan->id,
                'farm_id' => $plan->farm_id,
                'activity' => 'Siembra de Maíz',
                'quantity' => 25,
                'unit' => 'hectáreas',
                'start_date' => now()->subDays(30),
                'end_date' => now()->subDays(15),
                'operation_price' => 2500.00,
                'status' => 'completed'
            ]);

            // Ejecución pendiente
            Execution::create([
                'plan_id' => $plan->id,
                'farm_id' => $plan->farm_id,
                'activity' => 'Fertilización',
                'quantity' => 75,
                'unit' => 'hectáreas',
                'start_date' => now()->addDays(20),
                'end_date' => now()->addDays(25),
                'operation_price' => 3000.00,
                'status' => 'pending'
            ]);
        }
    }
} 