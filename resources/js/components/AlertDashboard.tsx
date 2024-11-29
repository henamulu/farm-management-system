import React, { useState, useEffect } from 'react';
import axios from 'axios';
import Echo from 'laravel-echo';

interface Alert {
    id: number;
    type: string;
    message: string;
    severity: 'low' | 'medium' | 'high';
    is_read: boolean;
    created_at: string;
}

const AlertDashboard: React.FC = () => {
    const [alerts, setAlerts] = useState<Alert[]>([]);
    const [unreadCount, setUnreadCount] = useState(0);

    useEffect(() => {
        fetchAlerts();
        initializeWebSockets();
    }, []);

    const initializeWebSockets = () => {
        const echo = new Echo({
            broadcaster: 'pusher',
            key: process.env.PUSHER_APP_KEY,
            cluster: process.env.PUSHER_APP_CLUSTER,
            forceTLS: true
        });

        echo.private('alerts')
            .listen('AlertTriggered', (e: { alert: Alert }) => {
                setAlerts(prev => [e.alert, ...prev]);
                if (!e.alert.is_read) {
                    setUnreadCount(prev => prev + 1);
                }
            });
    };

    const fetchAlerts = async () => {
        try {
            const response = await axios.get('/api/alerts');
            setAlerts(response.data.data);
            setUnreadCount(response.data.data.filter((alert: Alert) => !alert.is_read).length);
        } catch (error) {
            console.error('Error al obtener alertas:', error);
        }
    };

    const markAsRead = async (alertId: number) => {
        try {
            await axios.patch(`/api/alerts/${alertId}/read`);
            setAlerts(prev => 
                prev.map(alert => 
                    alert.id === alertId 
                        ? { ...alert, is_read: true }
                        : alert
                )
            );
            setUnreadCount(prev => prev - 1);
        } catch (error) {
            console.error('Error al marcar alerta como leída:', error);
        }
    };

    return (
        <div className="p-4">
            <div className="flex justify-between items-center mb-4">
                <h2 className="text-2xl">Panel de Alertas</h2>
                <span className="bg-red-500 text-white px-3 py-1 rounded-full">
                    {unreadCount} sin leer
                </span>
            </div>

            <div className="space-y-4">
                {alerts.map(alert => (
                    <div 
                        key={alert.id} 
                        className={`p-4 rounded-lg border ${
                            !alert.is_read ? 'bg-yellow-50' : 'bg-white'
                        } ${
                            alert.severity === 'high' ? 'border-red-500' :
                            alert.severity === 'medium' ? 'border-yellow-500' :
                            'border-blue-500'
                        }`}
                    >
                        <div className="flex justify-between items-start">
                            <div>
                                <h3 className="font-bold">{alert.type}</h3>
                                <p>{alert.message}</p>
                                <span className="text-sm text-gray-500">
                                    {new Date(alert.created_at).toLocaleString()}
                                </span>
                            </div>
                            {!alert.is_read && (
                                <button
                                    onClick={() => markAsRead(alert.id)}
                                    className="text-sm text-blue-500 hover:text-blue-700"
                                >
                                    Marcar como leída
                                </button>
                            )}
                        </div>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default AlertDashboard; 