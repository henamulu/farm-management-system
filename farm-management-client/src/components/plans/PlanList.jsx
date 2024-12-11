import { useQuery, useMutation, useQueryClient } from '@tanstack/react-query';
import { useParams } from 'react-router-dom';
import { endpoints } from '../../api/endpoints';
import PlanForm from './PlanForm';
import { useState } from 'react';

export default function PlanList() {
    const { farmId } = useParams();
    const queryClient = useQueryClient();
    const [isFormOpen, setIsFormOpen] = useState(false);

    const { data: plans, isLoading } = useQuery({
        queryKey: ['farms', farmId, 'plans'],
        queryFn: () => endpoints.getFarmPlans(farmId)
    });

    const approvePlanMutation = useMutation({
        mutationFn: endpoints.approvePlan,
        onSuccess: () => {
            queryClient.invalidateQueries(['farms', farmId, 'plans']);
        }
    });

    if (isLoading) return <div>Loading...</div>;

    return (
        <div>
            <div className="sm:flex sm:items-center">
                <div className="sm:flex-auto">
                    <h1 className="text-2xl font-semibold text-gray-900">Farm Plans</h1>
                    <p className="mt-2 text-sm text-gray-700">
                        A list of all plans for this farm including their status and details.
                    </p>
                </div>
                <div className="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button
                        onClick={() => setIsFormOpen(true)}
                        className="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700"
                    >
                        Add Plan
                    </button>
                </div>
            </div>

            <div className="mt-8 flex flex-col">
                <div className="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div className="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div className="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table className="min-w-full divide-y divide-gray-300">
                                <thead className="bg-gray-50">
                                    <tr>
                                        <th scope="col" className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Title
                                        </th>
                                        <th scope="col" className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Status
                                        </th>
                                        <th scope="col" className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Start Date
                                        </th>
                                        <th scope="col" className="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            End Date
                                        </th>
                                        <th scope="col" className="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span className="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody className="divide-y divide-gray-200 bg-white">
                                    {plans.map((plan) => (
                                        <tr key={plan.id}>
                                            <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {plan.title}
                                            </td>
                                            <td className="whitespace-nowrap px-3 py-4 text-sm">
                                                <span className={`inline-flex rounded-full px-2 text-xs font-semibold leading-5 ${
                                                    plan.status === 'approved' 
                                                        ? 'bg-green-100 text-green-800'
                                                        : plan.status === 'pending'
                                                        ? 'bg-yellow-100 text-yellow-800'
                                                        : 'bg-red-100 text-red-800'
                                                }`}>
                                                    {plan.status}
                                                </span>
                                            </td>
                                            <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {new Date(plan.start_date).toLocaleDateString()}
                                            </td>
                                            <td className="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {new Date(plan.end_date).toLocaleDateString()}
                                            </td>
                                            <td className="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                {plan.status === 'pending' && (
                                                    <button
                                                        onClick={() => approvePlanMutation.mutate(plan.id)}
                                                        className="text-indigo-600 hover:text-indigo-900"
                                                    >
                                                        Approve
                                                    </button>
                                                )}
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {isFormOpen && (
                <PlanForm
                    farmId={farmId}
                    onClose={() => setIsFormOpen(false)}
                    onSuccess={() => {
                        setIsFormOpen(false);
                        queryClient.invalidateQueries(['farms', farmId, 'plans']);
                    }}
                />
            )}
        </div>
    );
} 