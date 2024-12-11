import { useQuery, useMutation, useQueryClient } from '@tanstack/react-query';
import { endpoints } from '../../api/endpoints';

export default function NotificationList() {
    const queryClient = useQueryClient();
    const { data: notifications, isLoading } = useQuery({
        queryKey: ['notifications'],
        queryFn: endpoints.getNotifications
    });

    const markAsReadMutation = useMutation({
        mutationFn: endpoints.markNotificationAsRead,
        onSuccess: () => {
            queryClient.invalidateQueries(['notifications']);
        }
    });

    if (isLoading) return <div>Loading...</div>;

    return (
        <div>
            <h1 className="text-2xl font-semibold text-gray-900">Notifications</h1>
            <div className="mt-6">
                <div className="bg-white shadow overflow-hidden sm:rounded-md">
                    <ul className="divide-y divide-gray-200">
                        {notifications?.map((notification) => (
                            <li
                                key={notification.id}
                                className={`p-4 hover:bg-gray-50 ${
                                    !notification.read_at ? 'bg-blue-50' : ''
                                }`}
                            >
                                <div className="flex items-center justify-between">
                                    <div className="flex-1">
                                        <h3 className="text-sm font-medium text-gray-900">
                                            {notification.subject}
                                        </h3>
                                        <p className="mt-1 text-sm text-gray-500">
                                            {notification.message}
                                        </p>
                                        <p className="mt-1 text-xs text-gray-400">
                                            {new Date(notification.created_at).toLocaleDateString()}
                                        </p>
                                    </div>
                                    {!notification.read_at && (
                                        <button
                                            onClick={() => markAsReadMutation.mutate(notification.id)}
                                            className="ml-4 text-sm text-indigo-600 hover:text-indigo-900"
                                        >
                                            Mark as read
                                        </button>
                                    )}
                                </div>
                            </li>
                        ))}
                    </ul>
                </div>
            </div>
        </div>
    );
} 