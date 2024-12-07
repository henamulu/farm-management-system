<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('weather.api_key');
        $this->baseUrl = config('weather.api_url');
    }

    public function getCurrentWeather($latitude, $longitude)
    {
        $cacheKey = "weather_{$latitude}_{$longitude}";

        return Cache::remember($cacheKey, 1800, function () use ($latitude, $longitude) {
            $response = Http::get("{$this->baseUrl}/current", [
                'key' => $this->apiKey,
                'lat' => $latitude,
                'lon' => $longitude,
            ]);

            return $response->json();
        });
    }

    public function getForecast($latitude, $longitude, $days = 5)
    {
        $cacheKey = "forecast_{$latitude}_{$longitude}_{$days}";

        return Cache::remember($cacheKey, 3600, function () use ($latitude, $longitude, $days) {
            $response = Http::get("{$this->baseUrl}/forecast", [
                'key' => $this->apiKey,
                'lat' => $latitude,
                'lon' => $longitude,
                'days' => $days
            ]);

            return $response->json();
        });
    }

    public function checkForAlerts($farmId, $latitude, $longitude)
    {
        $weather = $this->getCurrentWeather($latitude, $longitude);
        
        // Check for severe weather conditions
        if ($this->isSevereWeather($weather)) {
            app(AlertService::class)->createWeatherAlert(
                $this->getSevereWeatherCondition($weather),
                $farmId
            );
        }
    }

    private function isSevereWeather($weather)
    {
        // Implement weather severity checks based on your criteria
        return false;
    }

    private function getSevereWeatherCondition($weather)
    {
        // Return the severe weather condition description
        return '';
    }
} 