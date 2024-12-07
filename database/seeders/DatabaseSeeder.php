<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuario primero
        User::create([
            'name' => 'Henok',
            'email' => 'henamulu@gmail.com',
            'password' => Hash::make('nueva123')
        ]);

        // Luego ejecutar los demás seeders
        $this->call([
            FarmSeeder::class,
            EmployeeSeeder::class,
            StockSeeder::class,
            PlanSeeder::class,
            ExecutionSeeder::class,
            MachinerySeeder::class
        ]);
    }
} 