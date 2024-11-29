import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Line } from 'react-chartjs-2';

interface Crop {
    id: number;
    name: string;
    variety: string;
    planting_date: string;
    expected_harvest_date: string;
    growth_stage: string;
    health_status: string;
    area_size: number;
    notes: string;
}

interface GrowthRecord {
    stage: string;
    health_status: string;
    recorded_at: string;
    notes: string;
}

const CropTracking: React.FC = () => {
    const [crops, setCrops] = useState<Crop[]>([]);
    const [selectedCrop, setSelectedCrop] = useState<Crop | null>(null);
    const [growthHistory, setGrowthHistory] = useState<GrowthRecord[]>([]);

    useEffect(() => {
        fetchCrops();
    }, []);

    const fetchCrops = async () => {
        try {
            const response = await axios.get('/api/crops');
            setCrops(response.data.data);
        } catch (error) {
            console.error('Error al obtener cultivos:', error);
        }
    };

    const updateGrowthStage = async (cropId: number, data: any) => {
        try {
            await axios.patch(`/api/crops/${cropId}/growth-stage`, data);
            fetchCrops();
        } catch (error) {
            console.error('Error al actualizar etapa de crecimiento:', error);
        }
    };

    const getProgressPercentage = (crop: Crop) => {
        const start = new Date(crop.planting_date).getTime();
        const end = new Date(crop.expected_harvest_date).getTime();
        const current = new Date().getTime();
        
        return Math.min(100, Math.max(0, 
            ((current - start) / (end - start)) * 100
        ));
    };

    return (
        <div className="p-4">
            <h2 className="text-2xl mb-4">Seguimiento de Cultivos</h2>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                {crops.map(crop => (
                    <div key={crop.id} className="border rounded-lg p-4">
                        <h3 className="font-bold text-lg">{crop.name} - {crop.variety}</h3>
                        
                        <div className="mt-2">
                            <div className="bg-gray-200 rounded-full h-4 mt-2">
                                <div 
                                    className="bg-green-500 rounded-full h-4"
                                    style={{ width: `${getProgressPercentage(crop)}%` }}
                                />
                            </div>
                            
                            <div className="mt-2">
                                <p>Etapa: {crop.growth_stage}</p>
                                <p>Estado: {crop.health_status}</p>
                                <p>Área: {crop.area_size} m²</p>
                            </div>

                            <button
                                onClick={() => setSelectedCrop(crop)}
                                className="mt-2 bg-blue-500 text-white px-4 py-2 rounded"
                            >
                                Actualizar Estado
                            </button>
                        </div>
                    </div>
                ))}
            </div>

            {/* Modal para actualizar estado */}
            {selectedCrop && (
                <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                    {/* ... contenido del modal ... */}
                </div>
            )}
        </div>
    );
};

export default CropTracking; 