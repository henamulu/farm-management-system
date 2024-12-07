<?php

namespace Database\Seeders;

use App\Models\Farm;
use App\Models\Stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    public function run(): void
    {
        $farms = Farm::all();

        foreach ($farms as $farm) {
            // Maquinaria
            Stock::create([
                'name' => 'Tractor John Deere',
                'type' => 'maquinaria',
                'quantity' => 2,
                'unit' => 'unidad',
                'price' => 50000.00,
                'farm_id' => $farm->id
            ]);

            // Herramientas
            Stock::create([
                'name' => 'Palas',
                'type' => 'herramientas',
                'quantity' => 20,
                'unit' => 'unidad',
                'price' => 25.00,
                'farm_id' => $farm->id
            ]);

            // Semillas
            Stock::create([
                'name' => 'Semillas de Maíz',
                'type' => 'semillas',
                'quantity' => 500,
                'unit' => 'kg',
                'price' => 5.00,
                'farm_id' => $farm->id
            ]);

            // Fertilizantes
            Stock::create([
                'name' => 'Fertilizante NPK',
                'type' => 'fertilizantes',
                'quantity' => 1000,
                'unit' => 'kg',
                'price' => 2.50,
                'farm_id' => $farm->id
            ]);
        }
    }
} 