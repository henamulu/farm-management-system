<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Weather Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <!-- Current Weather -->
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Current Weather</h3>
                            <div class="weather-data">
                                <p class="text-3xl mb-2">{{ $currentWeather['temperature'] }}°C</p>
                                <p>{{ $currentWeather['condition'] }}</p>
                                <p>Humidity: {{ $currentWeather['humidity'] }}%</p>
                                <p>Wind: {{ $currentWeather['wind_speed'] }} km/h</p>
                            </div>
                        </div>

                        <!-- Weather Alerts -->
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">Weather Alerts</h3>
                            @forelse($weatherAlerts as $alert)
                                <div class="alert-item mb-2 p-2 rounded {{ $alert->severity === 'high' ? 'bg-red-100' : 'bg-yellow-100' }}">
                                    <p class="font-medium">{{ $alert->message }}</p>
                                    <p class="text-sm text-gray-600">{{ $alert->created_at->diffForHumans() }}</p>
                                </div>
                            @empty
                                <p>No active weather alerts</p>
                            @endforelse
                        </div>

                        <!-- Forecast -->
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold mb-2">5-Day Forecast</h3>
                            @foreach($forecast as $day)
                                <div class="forecast-item mb-2">
                                    <p class="font-medium">{{ $day['date'] }}</p>
                                    <p>{{ $day['temperature'] }}°C - {{ $day['condition'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 