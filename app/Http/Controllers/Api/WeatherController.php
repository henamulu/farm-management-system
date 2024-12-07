<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\WeatherService;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function getCurrentWeather(Request $request)
    {
        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ]);

        $weatherData = $this->weatherService->getCurrentWeather(
            $validated['latitude'],
            $validated['longitude']
        );

        return response()->json(['data' => $weatherData]);
    }

    public function getForecast(Request $request)
    {
        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'days' => 'required|integer|min:1|max:7'
        ]);

        $forecast = $this->weatherService->getForecast(
            $validated['latitude'],
            $validated['longitude'],
            $validated['days']
        );

        return response()->json(['data' => $forecast]);
    }
} 