<?php

namespace Database\Seeders;

use App\Models\Farm;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $farms = Farm::all();

        foreach ($farms as $farm) {
            // Create employees for each farm
            Employee::create([
                'name' => 'Juan Pérez',
                'position' => 'Manager',
                'phone' => '123-456-7890',
                'email' => 'juan@example.com',
                'salary' => 2500.00,
                'hire_date' => now(),
                'farm_id' => $farm->id
            ]);

            Employee::create([
                'name' => 'María García',
                'position' => 'Technician',
                'phone' => '098-765-4321',
                'email' => 'maria@example.com',
                'salary' => 2000.00,
                'hire_date' => now(),
                'farm_id' => $farm->id
            ]);

            Employee::create([
                'name' => 'Carlos López',
                'position' => 'Operator',
                'phone' => '555-123-4567',
                'email' => 'carlos@example.com',
                'salary' => 1800.00,
                'hire_date' => now(),
                'farm_id' => $farm->id
            ]);
        }
    }
} 