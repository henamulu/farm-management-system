<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\WeatherService;
use App\Models\Farm;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function getForecast(Farm $farm)
    {
        try {
            $forecast = $this->weatherService->getForecast($farm);
            return response()->json(['data' => $forecast]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getHistoricalData(Farm $farm, Request $request)
    {
        $data = WeatherData::where('farm_id', $farm->id)
            ->whereBetween('forecast_date', [
                $request->input('start_date'),
                $request->input('end_date')
            ])
            ->get();

        return response()->json(['data' => $data]);
    }
} 