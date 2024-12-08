<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherService
{
    protected $apiKey;
    protected $baseUrl = 'http://api.weatherapi.com/v1';

    public function __construct()
    {
        $this->apiKey = config('services.weather.key');
    }

    public function getCurrentWeather($location)
    {
        return Cache::remember("weather_{$location}", 3600, function () use ($location) {
            $response = Http::get("{$this->baseUrl}/current.json", [
                'key' => $this->apiKey,
                'q' => $location
            ]);

            return $response->json();
        });
    }
}