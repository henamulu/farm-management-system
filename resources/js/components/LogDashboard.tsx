import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Line, Bar } from 'react-chartjs-2';

interface SystemMetrics {
    memory_usage: number;
    cpu_load: number[];
    disk_space: number;
    error_count: number;
}

interface LogEntry {
    id: number;
    user_id: number;
    action: string;
    description: string;
    level: string;
    created_at: string;
}

const LogDashboard: React.FC = () => {
    const [metrics, setMetrics] = useState<SystemMetrics | null>(null);
    const [recentLogs, setRecentLogs] = useState<LogEntry[]>([]);
    const [errorRate, setErrorRate] = useState<number[]>([]);

    useEffect(() => {
        fetchMetrics();
        fetchRecentLogs();
        const interval = setInterval(fetchMetrics, 60000); // Actualizar cada minuto
        return () => clearInterval(interval);
    }, []);

    const fetchMetrics = async () => {
        try {
            const response = await axios.get('/api/system/metrics');
            setMetrics(response.data);
        } catch (error) {
            console.error('Error fetching metrics:', error);
        }
    };

    const fetchRecentLogs = async () => {
        try {
            const response = await axios.get('/api/logs/recent');
            setRecentLogs(response.data);
        } catch (error) {
            console.error('Error fetching logs:', error);
        }
    };

    return (
        <div className="p-4">
            <h2 className="text-2xl mb-4">Dashboard de Monitoreo</h2>

            {/* Métricas del Sistema */}
            {metrics && (
                <div className="grid grid-cols-4 gap-4 mb-8">
                    <div className="bg-white p-4 rounded-lg shadow">
                        <h3>Uso de Memoria</h3>
                        <p className="text-2xl">{(metrics.memory_usage / 1024 / 1024).toFixed(2)} MB</p>
                    </div>
                    <div className="bg-white p-4 rounded-lg shadow">
                        <h3>Carga CPU</h3>
                        <p className="text-2xl">{metrics.cpu_load[0].toFixed(2)}</p>
                    </div>
                    <div className="bg-white p-4 rounded-lg shadow">
                        <h3>Espacio en Disco</h3>
                        <p className="text-2xl">{(metrics.disk_space / 1024 / 1024 / 1024).toFixed(2)} GB</p>
                    </div>
                    <div className="bg-white p-4 rounded-lg shadow">
                        <h3>Errores (24h)</h3>
                        <p className="text-2xl">{metrics.error_count}</p>
                    </div>
                </div>
            )}

            {/* Logs Recientes */}
            <div className="bg-white p-4 rounded-lg shadow mb-8">
                <h3 className="text-xl mb-4">Logs Recientes</h3>
                <div className="overflow-x-auto">
                    <table className="min-w-full">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Usuario</th>
                                <th>Acción</th>
                                <th>Nivel</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            {recentLogs.map(log => (
                                <tr key={log.id} className={
                                    log.level === 'error' ? 'bg-red-50' :
                                    log.level === 'warning' ? 'bg-yellow-50' :
                                    ''
                                }>
                                    <td>{new Date(log.created_at).toLocaleString()}</td>
                                    <td>{log.user_id}</td>
                                    <td>{log.action}</td>
                                    <td>{log.level}</td>
                                    <td>{log.description}</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>

            {/* Gráficos */}
            {errorRate.length > 0 && (
                <div className="bg-white p-4 rounded-lg shadow">
                    <h3 className="text-xl mb-4">Tasa de Errores</h3>
                    <Line
                        data={{
                            labels: errorRate.map((_, i) => `${i}h ago`),
                            datasets: [{
                                label: 'Errores por hora',
                                data: errorRate,
                                borderColor: 'rgb(255, 99, 132)',
                                tension: 0.1
                            }]
                        }}
                    />
                </div>
            )}
        </div>
    );
};

export default LogDashboard; 