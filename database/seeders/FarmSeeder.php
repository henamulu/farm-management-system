<?php

namespace Database\Seeders;

use App\Models\Farm;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FarmSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuario primero
        $user = User::first();

        // Crear granja asociada al usuario
        Farm::create([
            'name' => 'Granja Prueba',
            'location' => 'Ubicación Test',
            'size' => 100,
            'user_id' => $user->id,
            'description' => 'Granja de prueba para desarrollo'
        ]);
    }
}