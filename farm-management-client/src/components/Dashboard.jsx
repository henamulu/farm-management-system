import { useQuery } from '@tanstack/react-query';
import { endpoints } from '../api/endpoints';

export default function Dashboard() {
    const { data: dashboardData, isLoading } = useQuery({
        queryKey: ['dashboard'],
        queryFn: endpoints.getDashboard
    });

    if (isLoading) return <div>Loading...</div>;

    return (
        <div>
            <h1 className="text-2xl font-semibold text-gray-900">Dashboard</h1>
            <div className="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                {/* Farm Stats */}
                <div className="bg-white overflow-hidden shadow rounded-lg">
                    <div className="p-5">
                        <div className="flex items-center">
                            <div className="flex-shrink-0">
                                {/* Farm icon */}
                            </div>
                            <div className="ml-5 w-0 flex-1">
                                <dl>
                                    <dt className="text-sm font-medium text-gray-500 truncate">
                                        Total Farms
                                    </dt>
                                    <dd className="text-lg font-medium text-gray-900">
                                        {dashboardData?.totalFarms}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Weather Widget */}
                <div className="bg-white overflow-hidden shadow rounded-lg">
                    <div className="p-5">
                        <h3 className="text-lg font-medium text-gray-900">Weather</h3>
                        {dashboardData?.weather && (
                            <div className="mt-3">
                                <p className="text-3xl font-semibold">
                                    {dashboardData.weather.temperature}°C
                                </p>
                                <p className="text-gray-500">
                                    {dashboardData.weather.condition}
                                </p>
                            </div>
                        )}
                    </div>
                </div>

                {/* Recent Activity */}
                <div className="bg-white overflow-hidden shadow rounded-lg">
                    <div className="p-5">
                        <h3 className="text-lg font-medium text-gray-900">Recent Activity</h3>
                        <div className="mt-3 flow-root">
                            <ul className="-my-4 divide-y divide-gray-200">
                                {dashboardData?.recentActivity?.map((activity) => (
                                    <li key={activity.id} className="py-4">
                                        <div className="flex items-center space-x-4">
                                            <div className="flex-1 min-w-0">
                                                <p className="text-sm font-medium text-gray-900 truncate">
                                                    {activity.description}
                                                </p>
                                                <p className="text-sm text-gray-500">
                                                    {activity.timestamp}
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                ))}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
} 