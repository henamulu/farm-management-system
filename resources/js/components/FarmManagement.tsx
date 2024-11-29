import React, { useState } from 'react';
import axios from 'axios';

interface FarmData {
    name: string;
    location: string;
    size: number;
}

const FarmManagement: React.FC = () => {
    const [farmData, setFarmData] = useState<FarmData>({
        name: '',
        location: '',
        size: 0
    });

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        try {
            const response = await axios.post('/api/farms', farmData);
            console.log('Granja creada:', response.data);
        } catch (error) {
            console.error('Error al crear la granja:', error);
        }
    };

    return (
        <form onSubmit={handleSubmit}>
            {/* ... campos del formulario ... */}
        </form>
    );
};

export default FarmManagement; 