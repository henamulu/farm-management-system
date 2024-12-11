import api from './axios';

export const endpoints = {
    // Dashboard
    getDashboard: () => api.get('/dashboard'),

    // Profile
    getProfile: () => api.get('/profile'),
    updateProfile: (data) => api.patch('/profile', data),
    updatePassword: (data) => api.put('/profile/password', data),

    // Farms
    getFarms: () => api.get('/farms'),
    getFarm: (id) => api.get(`/farms/${id}`),
    createFarm: (data) => api.post('/farms', data),
    updateFarm: (id, data) => api.put(`/farms/${id}`, data),
    deleteFarm: (id) => api.delete(`/farms/${id}`),

    // Stocks
    getFarmStocks: (farmId) => api.get(`/farms/${farmId}/stocks`),
    createStock: (farmId, data) => api.post(`/farms/${farmId}/stocks`, data),
    updateStock: (farmId, stockId, data) => api.put(`/farms/${farmId}/stocks/${stockId}`, data),
    deleteStock: (farmId, stockId) => api.delete(`/farms/${farmId}/stocks/${stockId}`),

    // Employees
    getFarmEmployees: (farmId) => api.get(`/farms/${farmId}/employees`),
    createEmployee: (farmId, data) => api.post(`/farms/${farmId}/employees`, data),
    updateEmployee: (farmId, employeeId, data) => api.put(`/farms/${farmId}/employees/${employeeId}`, data),
    deleteEmployee: (farmId, employeeId) => api.delete(`/farms/${farmId}/employees/${employeeId}`),

    // Machinery
    getFarmMachinery: (farmId) => api.get(`/farms/${farmId}/machinery`),
    createMachinery: (farmId, data) => api.post(`/farms/${farmId}/machinery`, data),
    updateMachinery: (farmId, machineryId, data) => api.put(`/farms/${farmId}/machinery/${machineryId}`, data),
    deleteMachinery: (farmId, machineryId) => api.delete(`/farms/${farmId}/machinery/${machineryId}`),

    // Plans
    getFarmPlans: (farmId) => api.get(`/farms/${farmId}/plans`),
    createPlan: (farmId, data) => api.post(`/farms/${farmId}/plans`, data),
    updatePlan: (farmId, planId, data) => api.put(`/farms/${farmId}/plans/${planId}`, data),
    deletePlan: (farmId, planId) => api.delete(`/farms/${farmId}/plans/${planId}`),
    approvePlan: (planId) => api.post(`/plans/${planId}/approve`),

    // Weather
    getWeather: () => api.get('/weather'),

    // Notifications
    getNotifications: () => api.get('/notifications'),
    markNotificationAsRead: (notificationId) => api.post(`/notifications/${notificationId}/mark-as-read`),

    // Messages
    getMessages: () => api.get('/messages'),
    createMessage: (data) => api.post('/messages', data),
    updateMessage: (id, data) => api.put(`/messages/${id}`, data),
    deleteMessage: (id) => api.delete(`/messages/${id}`)
}; 