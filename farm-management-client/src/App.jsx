import { BrowserRouter, Routes, Route } from 'react-router-dom';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { AuthProvider } from './contexts/AuthContext';
import Layout from './components/Layout';
import Dashboard from './components/dashboard/Dashboard';
import FarmList from './components/farms/FarmList';
import StockList from './components/stocks/StockList';
import EmployeeList from './components/employees/EmployeeList';
import Profile from './components/profile/Profile';
import MachineryList from './components/machinery/MachineryList';
import WeatherDashboard from './components/weather/WeatherDashboard';
import Notifications from './components/notifications/NotificationList';
import Messages from './components/messages/MessageList';
import Plans from './components/plans/PlanList';

const queryClient = new QueryClient();

function App() {
    return (
        <QueryClientProvider client={queryClient}>
            <AuthProvider>
                <BrowserRouter>
                    <Routes>
                        <Route path="/" element={<Layout />}>
                            <Route index element={<Dashboard />} />
                            <Route path="profile" element={<Profile />} />
                            <Route path="farms">
                                <Route index element={<FarmList />} />
                                <Route path=":farmId">
                                    <Route path="stocks" element={<StockList />} />
                                    <Route path="employees" element={<EmployeeList />} />
                                    <Route path="machinery" element={<MachineryList />} />
                                    <Route path="plans" element={<Plans />} />
                                </Route>
                            </Route>
                            <Route path="weather" element={<WeatherDashboard />} />
                            <Route path="notifications" element={<Notifications />} />
                            <Route path="messages" element={<Messages />} />
                        </Route>
                    </Routes>
                </BrowserRouter>
            </AuthProvider>
        </QueryClientProvider>
    );
}

export default App; 