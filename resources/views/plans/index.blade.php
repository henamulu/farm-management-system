<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Plan List - {{ $farm->name }}</h2>
                        <a href="{{ route('farms.plans.create', $farm) }}" 
                           class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Create Plan
                        </a>
                    </div>

                    <!-- Filters -->
                    <div class="mb-6">
                        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="">All Status</option>
                                    @foreach(App\Models\Plan::STATUSES as $key => $value)
                                        <option value="{{ $key }}" {{ request('status') === $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Date Range</label>
                                <input type="date" 
                                       name="date_from" 
                                       value="{{ request('date_from') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="flex items-end">
                                <button type="submit" 
                                        class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">
                                    Apply Filters
                                </button>
                                <a href="{{ route('farms.plans.index', $farm) }}" 
                                   class="ml-2 inline-flex justify-center rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                                    Clear
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Plans Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Farm Operation</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Operation Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($plans as $plan)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $plan->farm_item }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $plan->quantity }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $plan->unit }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $plan->start_date->format('Y-m-d') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $plan->end_date->format('Y-m-d') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">${{ number_format($plan->operation_price, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($plan->status === 'approved') bg-green-100 text-green-800
                                                @elseif($plan->status === 'in_progress') bg-yellow-100 text-yellow-800
                                                @elseif($plan->status === 'completed') bg-blue-100 text-blue-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                {{ App\Models\Plan::STATUSES[$plan->status] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if($plan->status === 'draft')
                                                <form action="{{ route('plans.approve', $plan) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="text-green-600 hover:text-green-900 mr-2">
                                                        Approve
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('farms.plans.edit', [$farm, $plan]) }}" 
                                               class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                            <form action="{{ route('farms.plans.destroy', [$farm, $plan]) }}" 
                                                  method="POST" 
                                                  class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-red-600 hover:text-red-900"
                                                        onclick="return confirm('Are you sure you want to delete this plan?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            No plans found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $plans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 