<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Farm;
use Illuminate\Http\Request;

class FarmController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'size' => 'required|numeric',
            'owner_id' => 'required|exists:users,id'
        ]);

        $farm = Farm::create($validated);

        return response()->json([
            'message' => 'Granja creada exitosamente',
            'data' => $farm
        ], 201);
    }
} 