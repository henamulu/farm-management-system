<?php

namespace Tests\Feature;

use App\Services\WeatherService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WeatherServiceTest extends TestCase
{
    protected $weatherService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->weatherService = app(WeatherService::class);
    }

    public function test_can_get_current_weather()
    {
        Http::fake([
            '*' => Http::response([
                'temperature' => 25,
                'humidity' => 65,
                'wind_speed' => 10,
                'condition' => 'Clear'
            ], 200)
        ]);

        $weather = $this->weatherService->getCurrentWeather(40.7128, -74.0060);

        $this->assertIsArray($weather);
        $this->assertArrayHasKey('temperature', $weather);
    }

    public function test_weather_data_is_cached()
    {
        Http::fake([
            '*' => Http::response([
                'temperature' => 25
            ], 200)
        ]);

        // First call
        $this->weatherService->getCurrentWeather(40.7128, -74.0060);
        
        // Second call should use cached data
        $this->weatherService->getCurrentWeather(40.7128, -74.0060);

        Http::assertSentCount(1);
    }
} 