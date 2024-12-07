<?php

namespace Database\Seeders;

use App\Models\Farm;
use App\Models\Machinery;
use Illuminate\Database\Seeder;

class MachinerySeeder extends Seeder
{
    public function run(): void
    {
        $farms = Farm::all();

        foreach ($farms as $farm) {
            // Tractor operativo
            Machinery::create([
                'farm_id' => $farm->id,
                'name' => 'Tractor John Deere 6110M',
                'type' => 'Tractor',
                'status' => 'operational',
                'last_maintenance' => now()->subMonths(1),
                'next_maintenance' => now()->addMonths(2),
                'purchase_date' => now()->subYears(2),
                'purchase_price' => 85000.00
            ]);

            // Cosechadora en mantenimiento
            Machinery::create([
                'farm_id' => $farm->id,
                'name' => 'Cosechadora New Holland TC5.30',
                'type' => 'Cosechadora',
                'status' => 'maintenance',
                'last_maintenance' => now()->subMonths(6),
                'next_maintenance' => now()->addDays(5),
                'purchase_date' => now()->subYears(3),
                'purchase_price' => 120000.00
            ]);

            // Fumigadora operativa
            Machinery::create([
                'farm_id' => $farm->id,
                'name' => 'Fumigadora Jacto Advance 3000',
                'type' => 'Fumigadora',
                'status' => 'operational',
                'last_maintenance' => now()->subDays(15),
                'next_maintenance' => now()->addMonths(3),
                'purchase_date' => now()->subMonths(8),
                'purchase_price' => 45000.00
            ]);
        }
    }
} 