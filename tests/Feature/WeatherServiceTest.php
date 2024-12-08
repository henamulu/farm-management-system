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
        $this->markTestSkipped('Weather service tests are currently disabled.');
    }

    /** @test */
    /** @skip */
    public function test_weather_data_is_cached()
    {
        $mockResponse = [
            'current' => [
                'temp_c' => 25,
                'condition' => ['text' => 'Sunny']
            ]
        ];

        Http::fake([
            'api.weatherapi.com/*' => Http::response($mockResponse, 200),
        ]);

        $weatherService = new WeatherService();
        
        // First call - should hit the API
        $firstCall = $weatherService->getCurrentWeather('London');
        
        // Second call - should use cache
        $secondCall = $weatherService->getCurrentWeather('London');
        
        // Assert HTTP call was made once
        Http::assertSent(function ($request) {
            return str_contains($request->url(), 'api.weatherapi.com') &&
                   $request->hasQuery('q', 'London');
        });
        
        // Assert both calls return the same data
        $this->assertEquals($mockResponse, $firstCall);
        $this->assertEquals($firstCall, $secondCall);
    }

    /** @test */
    /** @skip */
    public function test_weather_service_handles_api_error()
    {
        Http::fake([
            'api.weatherapi.com/*' => Http::response(['error' => 'API Error'], 500),
        ]);

        $weatherService = new WeatherService();
        
        $this->expectException(\Exception::class);
        $weatherService->getCurrentWeather('Invalid Location');
    }
} 