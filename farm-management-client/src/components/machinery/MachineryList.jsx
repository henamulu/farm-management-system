import { useQuery, useMutation, useQueryClient } from '@tanstack/react-query';
import { useParams } from 'react-router-dom';
import { endpoints } from '../../api/endpoints';
import MachineryForm from './MachineryForm';
import { useState } from 'react';

export default function MachineryList() {
    const { farmId } = useParams();
    const queryClient = useQueryClient();
    const [isFormOpen, setIsFormOpen] = useState(false);
    const [selectedMachine, setSelectedMachine] = useState(null);

    const { data: machinery, isLoading } = useQuery({
        queryKey: ['farms', farmId, 'machinery'],
        queryFn: () => endpoints.getFarmMachinery(farmId)
    });

    const deleteMachineryMutation = useMutation({
        mutationFn: (machineryId) => endpoints.deleteMachinery(farmId, machineryId),
        onSuccess: () => {
            queryClient.invalidateQueries(['farms', farmId, 'machinery']);
        }
    });

    if (isLoading) return <div>Loading...</div>;

    return (
        <div>
            <div className="sm:flex sm:items-center">
                <div className="sm:flex-auto">
                    <h1 className="text-2xl font-semibold text-gray-900">Farm Machinery</h1>
                    <p className="mt-2 text-sm text-gray-700">
                        A list of all machinery and equipment available on this farm.
                    </p>
                </div>
                <div className="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button
                        onClick={() => {
                            setSelectedMachine(null);
                            setIsFormOpen(true);
                        }}
                        className="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700"
                    >
                        Add Machinery
                    </button>
                </div>
            </div>

            <div className="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                {machinery?.map((machine) => (
                    <div
                        key={machine.id}
                        className="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200"
                    >
                        <div className="px-4 py-5 sm:px-6">
                            <div className="flex items-center justify-between">
                                <h3 className="text-lg font-medium text-gray-900">{machine.name}</h3>
                                <div className="flex space-x-3">
                                    <button
                                        onClick={() => {
                                            setSelectedMachine(machine);
                                            setIsFormOpen(true);
                                        }}
                                        className="text-indigo-600 hover:text-indigo-900"
                                    >
                                        Edit
                                    </button>
                                    <button
                                        onClick={() => deleteMachineryMutation.mutate(machine.id)}
                                        className="text-red-600 hover:text-red-900"
                                    >
                                        Delete
                                    </button>
                                </div>
                            </div>
                            <p className="mt-1 text-sm text-gray-500">{machine.type}</p>
                        </div>
                        <div className="px-4 py-4 sm:px-6">
                            <dl className="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                <div>
                                    <dt className="text-sm font-medium text-gray-500">Serial Number</dt>
                                    <dd className="mt-1 text-sm text-gray-900">{machine.serial_number}</dd>
                                </div>
                                <div>
                                    <dt className="text-sm font-medium text-gray-500">Status</dt>
                                    <dd className="mt-1">
                                        <span className={`inline-flex rounded-full px-2 text-xs font-semibold leading-5 ${
                                            machine.status === 'operational' 
                                                ? 'bg-green-100 text-green-800'
                                                : machine.status === 'maintenance'
                                                ? 'bg-yellow-100 text-yellow-800'
                                                : 'bg-red-100 text-red-800'
                                        }`}>
                                            {machine.status}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt className="text-sm font-medium text-gray-500">Purchase Date</dt>
                                    <dd className="mt-1 text-sm text-gray-900">
                                        {new Date(machine.purchase_date).toLocaleDateString()}
                                    </dd>
                                </div>
                                <div>
                                    <dt className="text-sm font-medium text-gray-500">Last Maintenance</dt>
                                    <dd className="mt-1 text-sm text-gray-900">
                                        {machine.last_maintenance 
                                            ? new Date(machine.last_maintenance).toLocaleDateString()
                                            : 'N/A'}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                ))}
            </div>

            {isFormOpen && (
                <MachineryForm
                    farmId={farmId}
                    machine={selectedMachine}
                    onClose={() => {
                        setIsFormOpen(false);
                        setSelectedMachine(null);
                    }}
                    onSuccess={() => {
                        setIsFormOpen(false);
                        setSelectedMachine(null);
                        queryClient.invalidateQueries(['farms', farmId, 'machinery']);
                    }}
                />
            )}
        </div>
    );
} 