import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Bell, Check } from 'react-feather';

interface Notification {
    id: number;
    type: 'email' | 'sms' | 'system';
    title: string;
    message: string;
    status: string;
    sent_at: string;
    read_at: string | null;
    priority: 'low' | 'medium' | 'high';
}

const NotificationCenter: React.FC = () => {
    const [notifications, setNotifications] = useState<Notification[]>([]);
    const [unreadCount, setUnreadCount] = useState(0);
    const [showNotifications, setShowNotifications] = useState(false);

    useEffect(() => {
        fetchNotifications();
        fetchUnreadCount();

        // Configurar actualización en tiempo real
        const echo = window.Echo;
        echo.private(`App.Models.User.${userId}`)
            .notification((notification: Notification) => {
                setNotifications(prev => [notification, ...prev]);
                setUnreadCount(prev => prev + 1);
            });
    }, []);

    const fetchNotifications = async () => {
        try {
            const response = await axios.get('/api/notifications');
            setNotifications(response.data.data);
        } catch (error) {
            console.error('Error fetching notifications:', error);
        }
    };

    const fetchUnreadCount = async () => {
        try {
            const response = await axios.get('/api/notifications/unread-count');
            setUnreadCount(response.data.unread_count);
        } catch (error) {
            console.error('Error fetching unread count:', error);
        }
    };

    const markAsRead = async (notificationId: number) => {
        try {
            await axios.post(`/api/notifications/${notificationId}/read`);
            setNotifications(notifications.map(notification => 
                notification.id === notificationId 
                    ? { ...notification, read_at: new Date().toISOString() }
                    : notification
            ));
            setUnreadCount(prev => prev - 1);
        } catch (error) {
            console.error('Error marking notification as read:', error);
        }
    };

    return (
        <div className="relative">
            {/* Botón de notificaciones */}
            <button 
                onClick={() => setShowNotifications(!showNotifications)}
                className="relative p-2 rounded-full hover:bg-gray-100"
            >
                <Bell size={20} />
                {unreadCount > 0 && (
                    <span className="absolute top-0 right-0 bg-red-500 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center">
                        {unreadCount}
                    </span>
                )}
            </button>

            {/* Panel de notificaciones */}
            {showNotifications && (
                <div className="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg z-50">
                    <div className="p-4">
                        <h3 className="text-lg font-semibold mb-4">Notificaciones</h3>
                        <div className="space-y-4 max-h-96 overflow-y-auto">
                            {notifications.map(notification => (
                                <div 
                                    key={notification.id}
                                    className={`p-3 rounded-lg ${
                                        !notification.read_at ? 'bg-blue-50' : 'bg-gray-50'
                                    }`}
                                >
                                    <div className="flex justify-between items-start">
                                        <div>
                                            <h4 className="font-medium">{notification.title}</h4>
                                            <p className="text-sm text-gray-600">{notification.message}</p>
                                            <span className="text-xs text-gray-500">
                                                {new Date(notification.sent_at).toLocaleString()}
                                            </span>
                                        </div>
                                        {!notification.read_at && (
                                            <button
                                                onClick={() => markAsRead(notification.id)}
                                                className="text-blue-500 hover:text-blue-700"
                                            >
                                                <Check size={16} />
                                            </button>
                                        )}
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
};

export default NotificationCenter; 