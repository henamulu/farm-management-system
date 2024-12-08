<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Services\WeatherService;

class WeatherServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
    }

    public function test_weather_data_is_cached()
    {
        Http::fake([
            '*' => Http::response([
                'current' => [
                    'temp_c' => 25,
                    'condition' => ['text' => 'Sunny']
                ]
            ], 200)
        ]);

        $weatherService = new WeatherService();
        
        // First call - should hit the API
        $firstCall = $weatherService->getCurrentWeather('London');
        
        // Second call - should use cache
        $secondCall = $weatherService->getCurrentWeather('London');
        
        Http::assertSentCount(1);
        
        $this->assertEquals($firstCall, $secondCall);
    }
}