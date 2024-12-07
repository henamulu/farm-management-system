<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Create Plan - {{ $farm->name }}</h2>
                    </div>

                    <form action="{{ route('farms.plans.store', $farm) }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                            <!-- Farm Item -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Farm Operation</label>
                                <input type="text" 
                                       name="farm_item" 
                                       value="{{ old('farm_item') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                       placeholder="Farm Item">
                                @error('farm_item')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Quantity -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Quantity</label>
                                <input type="number" 
                                       name="quantity" 
                                       value="{{ old('quantity') }}"
                                       step="0.01"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                       placeholder="Quantity">
                                @error('quantity')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Unit -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Unit</label>
                                <input type="text" 
                                       name="unit" 
                                       value="{{ old('unit') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                       placeholder="Unit">
                                @error('unit')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Start Date -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Start Date</label>
                                <input type="date" 
                                       name="start_date" 
                                       value="{{ old('start_date') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                @error('start_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- End Date -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">End Date</label>
                                <input type="date" 
                                       name="end_date" 
                                       value="{{ old('end_date') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                @error('end_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Operation Price -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Operation Price</label>
                                <input type="number" 
                                       name="operation_price" 
                                       value="{{ old('operation_price') }}"
                                       step="0.01"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                       placeholder="Market Price">
                                @error('operation_price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end space-x-2">
                            <button type="submit" 
                                    class="inline-flex justify-center rounded-md border border-transparent bg-green-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                Add Activity
                            </button>
                            <button type="submit" 
                                    name="submit_and_new" 
                                    value="1"
                                    class="inline-flex justify-center rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Submit
                            </button>
                        </div>
                    </form>

                    <!-- Activity List -->
                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Activities</h3>
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
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($farm->plans()->where('status', 'draft')->get() as $plan)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $plan->farm_item }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $plan->quantity }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $plan->unit }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $plan->start_date->format('Y-m-d') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $plan->end_date->format('Y-m-d') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">${{ number_format($plan->operation_price, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('farms.plans.edit', [$farm, $plan]) }}" 
                                                    class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                                
                                                <form action="{{ route('farms.plans.destroy', [$farm, $plan]) }}" 
                                                    method="POST" 
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 