import { useQuery, useMutation, useQueryClient } from '@tanstack/react-query';
import { useParams } from 'react-router-dom';
import { endpoints } from '../../api/endpoints';

export default function StockList() {
    const { farmId } = useParams();
    const queryClient = useQueryClient();

    const { data: stocks, isLoading } = useQuery({
        queryKey: ['farms', farmId, 'stocks'],
        queryFn: () => endpoints.getFarmStocks(farmId)
    });

    const createStockMutation = useMutation({
        mutationFn: (data) => endpoints.createStock(farmId, data),
        onSuccess: () => {
            queryClient.invalidateQueries(['farms', farmId, 'stocks']);
        }
    });

    if (isLoading) return <div>Loading...</div>;

    return (
        <div className="px-4 sm:px-6 lg:px-8">
            <div className="sm:flex sm:items-center">
                <div className="sm:flex-auto">
                    <h1 className="text-xl font-semibold text-gray-900">Stock Items</h1>
                </div>
                <div className="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button
                        onClick={() => createStockMutation.mutate({ name: 'New Item', quantity: 0 })}
                        className="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700"
                    >
                        Add Stock Item
                    </button>
                </div>
            </div>
            {/* Tabla de stocks similar a FarmList */}
        </div>
    );
} 