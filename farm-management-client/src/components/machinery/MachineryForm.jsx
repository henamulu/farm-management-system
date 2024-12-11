import { useMutation } from '@tanstack/react-query';
import { endpoints } from '../../api/endpoints';
import { useState, useEffect } from 'react';

export default function MachineryForm({ farmId, machine, onClose, onSuccess }) {
    const [formData, setFormData] = useState({
        name: '',
        type: '',
        serial_number: '',
        purchase_date: '',
        status: 'operational',
        last_maintenance: '',
        notes: ''
    });

    useEffect(() => {
        if (machine) {
            setFormData({
                name: machine.name,
                type: machine.type,
                serial_number: machine.serial_number,
                purchase_date: machine.purchase_date,
                status: machine.status,
                last_maintenance: machine.last_maintenance || '',
                notes: machine.notes || ''
            });
        }
    }, [machine]);

    const mutation = useMutation({
        mutationFn: (data) => {
            if (machine) {
                return endpoints.updateMachinery(farmId, machine.id, data);
            }
            return endpoints.createMachinery(farmId, data);
        },
        onSuccess: () => {
            onSuccess?.();
        }
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        mutation.mutate(formData);
    };

    return (
        <div className="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
            <div className="bg-white rounded-lg p-6 max-w-md w-full">
                <div className="flex justify-between items-center mb-4">
                    <h2 className="text-lg font-medium">
                        {machine ? 'Edit Machinery' : 'Add New Machinery'}
                    </h2>
                    <button
                        onClick={onClose}
                        className="text-gray-400 hover:text-gray-500"
                    >
                        <span className="sr-only">Close</span>
                        <svg className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form onSubmit={handleSubmit} className="space-y-4">
                    <div>
                        <label htmlFor="name" className="block text-sm font-medium text-gray-700">
                            Name
                        </label>
                        <input
                            type="text"
                            id="name"
                            value={formData.name}
                            onChange={(e) => setFormData(prev => ({ ...prev, name: e.target.value }))}
                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            required
                        />
                    </div>

                    <div>
                        <label htmlFor="type" className="block text-sm font-medium text-gray-700">
                            Type
                        </label>
                        <input
                            type="text"
                            id="type"
                            value={formData.type}
                            onChange={(e) => setFormData(prev => ({ ...prev, type: e.target.value }))}
                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            required
                        />
                    </div>

                    <div>
                        <label htmlFor="serial_number" className="block text-sm font-medium text-gray-700">
                            Serial Number
                        </label>
                        <input
                            type="text"
                            id="serial_number"
                            value={formData.serial_number}
                            onChange={(e) => setFormData(prev => ({ ...prev, serial_number: e.target.value }))}
                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            required
                        />
                    </div>

                    <div className="grid grid-cols-2 gap-4">
                        <div>
                            <label htmlFor="purchase_date" className="block text-sm font-medium text-gray-700">
                                Purchase Date
                            </label>
                            <input
                                type="date"
                                id="purchase_date"
                                value={formData.purchase_date}
                                onChange={(e) => setFormData(prev => ({ ...prev, purchase_date: e.target.value }))}
                                className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                required
                            />
                        </div>

                        <div>
                            <label htmlFor="last_maintenance" className="block text-sm font-medium text-gray-700">
                                Last Maintenance
                            </label>
                            <input
                                type="date"
                                id="last_maintenance"
                                value={formData.last_maintenance}
                                onChange={(e) => setFormData(prev => ({ ...prev, last_maintenance: e.target.value }))}
                                className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            />
                        </div>
                    </div>

                    <div>
                        <label htmlFor="status" className="block text-sm font-medium text-gray-700">
                            Status
                        </label>
                        <select
                            id="status"
                            value={formData.status}
                            onChange={(e) => setFormData(prev => ({ ...prev, status: e.target.value }))}
                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        >
                            <option value="operational">Operational</option>
                            <option value="maintenance">Under Maintenance</option>
                            <option value="repair">Needs Repair</option>
                            <option value="retired">Retired</option>
                        </select>
                    </div>

                    <div>
                        <label htmlFor="notes" className="block text-sm font-medium text-gray-700">
                            Notes
                        </label>
                        <textarea
                            id="notes"
                            value={formData.notes}
                            onChange={(e) => setFormData(prev => ({ ...prev, notes: e.target.value }))}
                            rows={3}
                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        />
                    </div>

                    <div className="flex justify-end gap-3">
                        <button
                            type="button"
                            onClick={onClose}
                            className="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            className="rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700"
                        >
                            {machine ? 'Update' : 'Add'} Machinery
                        </button>
                    </div>
                </form>
            </div>
        </div>
    );
} 