import { useQuery } from '@tanstack/react-query';
import { endpoints } from '../../api/endpoints';

export default function WeatherDashboard() {
    const { data: weather, isLoading } = useQuery({
        queryKey: ['weather'],
        queryFn: endpoints.getWeather
    });

    if (isLoading) return <div>Loading...</div>;

    return (
        <div>
            <h1 className="text-2xl font-semibold text-gray-900">Weather Dashboard</h1>
            <div className="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                {/* Current Weather */}
                <div className="bg-white overflow-hidden shadow rounded-lg">
                    <div className="p-6">
                        <h2 className="text-lg font-medium text-gray-900">Current Weather</h2>
                        <div className="mt-4">
                            <div className="flex items-center">
                                <div className="text-4xl font-bold">
                                    {weather?.current?.temperature}°C
                                </div>
                                <div className="ml-4">
                                    <p className="text-gray-500">{weather?.current?.condition}</p>
                                    <p className="text-sm text-gray-400">
                                        Humidity: {weather?.current?.humidity}%
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Forecast */}
                <div className="bg-white overflow-hidden shadow rounded-lg col-span-2">
                    <div className="p-6">
                        <h2 className="text-lg font-medium text-gray-900">5-Day Forecast</h2>
                        <div className="mt-4 grid grid-cols-5 gap-4">
                            {weather?.forecast?.map((day) => (
                                <div key={day.date} className="text-center">
                                    <p className="text-sm text-gray-500">{day.date}</p>
                                    <p className="text-2xl font-semibold">{day.temperature}°C</p>
                                    <p className="text-sm text-gray-500">{day.condition}</p>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
} 