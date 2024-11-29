<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Crop;
use App\Services\AlertService;
use Illuminate\Http\Request;

class CropController extends Controller
{
    protected $alertService;

    public function __construct(AlertService $alertService)
    {
        $this->alertService = $alertService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'variety' => 'required|string',
            'planting_date' => 'required|date',
            'expected_harvest_date' => 'required|date|after:planting_date',
            'area_size' => 'required|numeric',
            'farm_id' => 'required|exists:farms,id',
            'growth_stage' => 'required|string',
            'health_status' => 'required|string'
        ]);

        $crop = Crop::create($validated);

        // Crear actividades automáticas basadas en el ciclo del cultivo
        $this->createDefaultActivities($crop);

        return response()->json([
            'message' => 'Cultivo registrado exitosamente',
            'data' => $crop
        ], 201);
    }

    private function createDefaultActivities(Crop $crop)
    {
        $defaultActivities = [
            [
                'name' => 'Preparación del suelo',
                'description' => 'Preparar el suelo para la siembra',
                'start_date' => $crop->planting_date->subDays(7),
                'end_date' => $crop->planting_date
            ],
            [
                'name' => 'Siembra',
                'description' => 'Proceso de siembra del cultivo',
                'start_date' => $crop->planting_date,
                'end_date' => $crop->planting_date->addDays(1)
            ],
            [
                'name' => 'Primera fertilización',
                'description' => 'Aplicación inicial de fertilizantes',
                'start_date' => $crop->planting_date->addDays(15),
                'end_date' => $crop->planting_date->addDays(16)
            ]
        ];

        foreach ($defaultActivities as $activity) {
            $crop->activities()->create(array_merge($activity, [
                'farm_id' => $crop->farm_id,
                'status' => 'pending'
            ]));
        }
    }

    public function updateGrowthStage(Request $request, Crop $crop)
    {
        $validated = $request->validate([
            'growth_stage' => 'required|string',
            'health_status' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        $crop->update($validated);
        
        // Registrar el progreso del crecimiento
        $crop->growthRecords()->create([
            'stage' => $validated['growth_stage'],
            'health_status' => $validated['health_status'],
            'notes' => $validated['notes'] ?? null,
            'recorded_at' => now()
        ]);

        return response()->json([
            'message' => 'Etapa de crecimiento actualizada',
            'data' => $crop
        ]);
    }
} 