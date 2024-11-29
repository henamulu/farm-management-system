<?php

namespace App\Services;

use App\Models\WeatherData;
use App\Models\Farm;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.weather.api_key');
        $this->baseUrl = config('services.weather.base_url');
    }

    public function getForecast(Farm $farm)
    {
        $cacheKey = "weather_forecast_{$farm->id}";

        return Cache::remember($cacheKey, 3600, function () use ($farm) {
            $response = Http::get("{$this->baseUrl}/forecast", [
                'lat' => $farm->latitude,
                'lon' => $farm->longitude,
                'appid' => $this->apiKey,
                'units' => 'metric'
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $this->processWeatherData($farm, $data);
            }

            throw new \Exception('Error al obtener datos meteorológicos');
        });
    }

    private function processWeatherData(Farm $farm, array $data)
    {
        $weatherData = WeatherData::create([
            'farm_id' => $farm->id,
            'temperature' => $data['main']['temp'],
            'humidity' => $data['main']['humidity'],
            'precipitation' => $data['rain']['1h'] ?? 0,
            'wind_speed' => $data['wind']['speed'],
            'weather_condition' => $data['weather'][0]['main'],
            'forecast_date' => now(),
            'data_source' => 'OpenWeatherMap',
            'alerts' => $this->generateAlerts($data)
        ]);

        return $weatherData;
    }

    private function generateAlerts($data)
    {
        $alerts = [];
        
        // Alertas por temperatura
        if ($data['main']['temp'] > 35) {
            $alerts[] = [
                'type' => 'high_temperature',
                'message' => 'Temperatura extremadamente alta'
            ];
        }

        // Alertas por lluvia
        if (($data['rain']['1h'] ?? 0) > 10) {
            $alerts[] = [
                'type' => 'heavy_rain',
                'message' => 'Lluvia intensa prevista'
            ];
        }

        return $alerts;
    }
} 