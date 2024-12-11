import { Outlet, Link } from 'react-router-dom';
import { useAuth } from '../contexts/AuthContext';

export default function Layout() {
    const { user, logout } = useAuth();

    const navigation = [
        { name: 'Dashboard', href: '/' },
        { name: 'Farms', href: '/farms' },
        { name: 'Weather', href: '/weather' },
        { name: 'Messages', href: '/messages' },
    ];

    return (
        <div className="min-h-screen bg-gray-100">
            <nav className="bg-white shadow-sm">
                <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div className="flex h-16 justify-between">
                        <div className="flex">
                            {navigation.map((item) => (
                                <Link
                                    key={item.name}
                                    to={item.href}
                                    className="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-900"
                                >
                                    {item.name}
                                </Link>
                            ))}
                        </div>
                        <div className="flex items-center">
                            <Link to="/notifications" className="relative p-2">
                                <span className="sr-only">Notifications</span>
                                {/* Notification icon */}
                            </Link>
                            <Link to="/profile" className="ml-4">
                                {user?.name}
                            </Link>
                            <button
                                onClick={logout}
                                className="ml-4 text-sm text-gray-500 hover:text-gray-700"
                            >
                                Logout
                            </button>
                        </div>
                    </div>
                </div>
            </nav>

            <main className="py-10">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <Outlet />
                </div>
            </main>
        </div>
    );
} 