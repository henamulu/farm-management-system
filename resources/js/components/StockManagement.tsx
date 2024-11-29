import React, { useState, useEffect } from 'react';
import axios from 'axios';

interface StockItem {
    id?: number;
    item_name: string;
    category: string;
    quantity: number;
    unit: string;
    minimum_threshold: number;
    farm_id: number;
}

const StockManagement: React.FC = () => {
    const [stocks, setStocks] = useState<StockItem[]>([]);
    const [newStock, setNewStock] = useState<StockItem>({
        item_name: '',
        category: '',
        quantity: 0,
        unit: '',
        minimum_threshold: 0,
        farm_id: 0
    });

    useEffect(() => {
        fetchStocks();
    }, []);

    const fetchStocks = async () => {
        try {
            const response = await axios.get('/api/stocks');
            setStocks(response.data.data);
        } catch (error) {
            console.error('Error al obtener stocks:', error);
        }
    };

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        try {
            await axios.post('/api/stocks', newStock);
            fetchStocks();
            // Limpiar el formulario
            setNewStock({
                item_name: '',
                category: '',
                quantity: 0,
                unit: '',
                minimum_threshold: 0,
                farm_id: 0
            });
        } catch (error) {
            console.error('Error al crear stock:', error);
        }
    };

    return (
        <div className="p-4">
            <h2 className="text-2xl mb-4">Gestión de Stock</h2>
            
            {/* Formulario de nuevo stock */}
            <form onSubmit={handleSubmit} className="mb-8">
                {/* ... campos del formulario ... */}
            </form>

            {/* Lista de stocks */}
            <div className="overflow-x-auto">
                <table className="min-w-full">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Cantidad</th>
                            <th>Unidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {stocks.map((stock) => (
                            <tr key={stock.id}>
                                <td>{stock.item_name}</td>
                                <td>{stock.category}</td>
                                <td>{stock.quantity}</td>
                                <td>{stock.unit}</td>
                                <td>
                                    {/* Botones de acción */}
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </div>
    );
};

export default StockManagement; 