import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Line } from 'react-chartjs-2';

interface WeatherData {
    temperature: number;
    humidity: number;
    precipitation: number;
    wind_speed: number;
    weather_condition: string;
    forecast_date: string;
    alerts: Array<{
        type: string;
        message: string;
    }>;
}

const WeatherDashboard: React.FC = () => {
    const [weatherData, setWeatherData] = useState<WeatherData | null>(null);
    const [historicalData, setHistoricalData] = useState<WeatherData[]>([]);

    useEffect(() => {
        fetchWeatherData();
        fetchHistoricalData();
    }, []);

    const fetchWeatherData = async () => {
        try {
            const response = await axios.get(`/api/weather/forecast/${farmId}`);
            setWeatherData(response.data.data);
        } catch (error) {
            console.error('Error al obtener datos del clima:', error);
        }
    };

    const fetchHistoricalData = async () => {
        try {
            const response = await axios.get(`/api/weather/historical/${farmId}`, {
                params: {
                    start_date: new Date(Date.now() - 7 * 24 * 60 * 60 * 1000),
                    end_date: new Date()
                }
            });
            setHistoricalData(response.data.data);
        } catch (error) {
            console.error('Error al obtener datos históricos:', error);
        }
    };

    return (
        <div className="p-4">
            <h2 className="text-2xl mb-4">Panel Meteorológico</h2>

            {/* Datos actuales */}
            {weatherData && (
                <div className="grid grid-cols-4 gap-4 mb-8">
                    <div className="bg-blue-100 p-4 rounded">
                        <h3>Temperatura</h3>
                        <p className="text-2xl">{weatherData.temperature}°C</p>
                    </div>
                    <div className="bg-blue-100 p-4 rounded">
                        <h3>Humedad</h3>
                        <p className="text-2xl">{weatherData.humidity}%</p>
                    </div>
                    <div className="bg-blue-100 p-4 rounded">
                        <h3>Precipitación</h3>
                        <p className="text-2xl">{weatherData.precipitation}mm</p>
                    </div>
                    <div className="bg-blue-100 p-4 rounded">
                        <h3>Viento</h3>
                        <p className="text-2xl">{weatherData.wind_speed}km/h</p>
                    </div>
                </div>
            )}

            {/* Alertas */}
            {weatherData?.alerts && weatherData.alerts.length > 0 && (
                <div className="mb-8">
                    <h3 className="text-xl mb-2">Alertas Meteorológicas</h3>
                    <div className="space-y-2">
                        {weatherData.alerts.map((alert, index) => (
                            <div key={index} className="bg-red-100 p-4 rounded">
                                <p className="font-bold">{alert.type}</p>
                                <p>{alert.message}</p>
                            </div>
                        ))}
                    </div>
                </div>
            )}

            {/* Gráfico histórico */}
            {historicalData.length > 0 && (
                <div className="mt-8">
                    <h3 className="text-xl mb-4">Historial de Temperatura</h3>
                    <Line
                        data={{
                            labels: historicalData.map(d => new Date(d.forecast_date).toLocaleDateString()),
                            datasets: [{
                                label: 'Temperatura',
                                data: historicalData.map(d => d.temperature),
                                borderColor: 'rgb(75, 192, 192)',
                                tension: 0.1
                            }]
                        }}
                    />
                </div>
            )}
        </div>
    );
};

export default WeatherDashboard; 