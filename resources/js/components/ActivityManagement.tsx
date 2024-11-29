import React, { useState, useEffect } from 'react';
import axios from 'axios';
import DatePicker from 'react-datepicker';
import 'react-datepicker/dist/react-datepicker.css';

interface Activity {
    id?: number;
    name: string;
    description: string;
    start_date: Date;
    end_date: Date;
    farm_id: number;
    assigned_to: number;
    resource_requirements: ResourceRequirement[];
    status: 'pending' | 'in_progress' | 'completed';
}

interface ResourceRequirement {
    item: string;
    quantity: number;
}

const ActivityManagement: React.FC = () => {
    const [activities, setActivities] = useState<Activity[]>([]);
    const [newActivity, setNewActivity] = useState<Activity>({
        name: '',
        description: '',
        start_date: new Date(),
        end_date: new Date(),
        farm_id: 0,
        assigned_to: 0,
        resource_requirements: [],
        status: 'pending'
    });

    useEffect(() => {
        fetchActivities();
    }, []);

    const fetchActivities = async () => {
        try {
            const response = await axios.get('/api/activities');
            setActivities(response.data.data);
        } catch (error) {
            console.error('Error al obtener actividades:', error);
        }
    };

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        try {
            await axios.post('/api/activities', newActivity);
            fetchActivities();
            // Limpiar formulario
            setNewActivity({
                name: '',
                description: '',
                start_date: new Date(),
                end_date: new Date(),
                farm_id: 0,
                assigned_to: 0,
                resource_requirements: [],
                status: 'pending'
            });
        } catch (error) {
            console.error('Error al crear actividad:', error);
        }
    };

    return (
        <div className="p-4">
            <h2 className="text-2xl mb-4">Gestión de Actividades</h2>
            
            {/* Formulario de nueva actividad */}
            <form onSubmit={handleSubmit} className="mb-8">
                <div className="mb-4">
                    <label className="block mb-2">Fecha de inicio:</label>
                    <DatePicker
                        selected={newActivity.start_date}
                        onChange={(date: Date) => setNewActivity({...newActivity, start_date: date})}
                        className="border p-2 rounded"
                    />
                </div>
                <div className="mb-4">
                    <label className="block mb-2">Fecha de fin:</label>
                    <DatePicker
                        selected={newActivity.end_date}
                        onChange={(date: Date) => setNewActivity({...newActivity, end_date: date})}
                        className="border p-2 rounded"
                    />
                </div>
                {/* ... otros campos del formulario ... */}
            </form>

            {/* Lista de actividades */}
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                {activities.map((activity) => (
                    <div key={activity.id} className="border p-4 rounded-lg">
                        <h3 className="font-bold">{activity.name}</h3>
                        <p>{activity.description}</p>
                        <div className="mt-2">
                            <span className={`px-2 py-1 rounded text-sm ${
                                activity.status === 'completed' ? 'bg-green-200' :
                                activity.status === 'in_progress' ? 'bg-yellow-200' :
                                'bg-gray-200'
                            }`}>
                                {activity.status}
                            </span>
                        </div>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default ActivityManagement; 