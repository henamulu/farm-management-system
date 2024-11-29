<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $activities = Activity::with(['farm', 'assignedUser'])
            ->when($request->farm_id, function($query, $farmId) {
                return $query->where('farm_id', $farmId);
            })
            ->orderBy('start_date')
            ->get();

        return response()->json(['data' => $activities]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'farm_id' => 'required|exists:farms,id',
            'assigned_to' => 'required|exists:users,id',
            'resource_requirements' => 'required|array'
        ]);

        $activity = Activity::create($validated);
        
        // Verificar y reservar recursos
        $this->checkAndReserveResources($activity);

        return response()->json([
            'message' => 'Actividad creada exitosamente',
            'data' => $activity
        ], 201);
    }

    private function checkAndReserveResources(Activity $activity)
    {
        foreach ($activity->resource_requirements as $resource) {
            // Verificar disponibilidad en el stock
            $stock = Stock::where('item_name', $resource['item'])
                         ->where('farm_id', $activity->farm_id)
                         ->first();

            if ($stock && $stock->quantity >= $resource['quantity']) {
                // Reservar recursos
                $stock->quantity -= $resource['quantity'];
                $stock->save();
            }
        }
    }
} 