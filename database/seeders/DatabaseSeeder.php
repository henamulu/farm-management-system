<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
      // Luego ejecutar los demás seeders
        $this->call([
            UserSeeder::class,
            FarmSeeder::class,
            EmployeeSeeder::class,
            StockSeeder::class,
            PlanSeeder::class,
            ExecutionSeeder::class,
            MachinerySeeder::class,
            MessageSeeder::class,
        ]);
    }
} 