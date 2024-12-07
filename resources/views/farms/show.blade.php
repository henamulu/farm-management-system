<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Header with actions -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">{{ $farm->name }}</h2>
                        <div class="space-x-2">
                            <a href="{{ route('farms.edit', $farm) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                Edit Farm
                            </a>
                            <form action="{{ route('farms.destroy', $farm) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Delete Farm
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Information Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Farm Details -->
                        <div>
                            <h3 class="text-lg font-semibold mb-4">General Information</h3>
                            <div class="bg-gray-50 p-4 rounded">
                                <p><span class="font-semibold">Location:</span> {{ $farm->location }}</p>
                                <p><span class="font-semibold">Size:</span> {{ $farm->size }} hectares</p>
                                <p><span class="font-semibold">Description:</span></p>
                                <p class="mt-1">{{ $farm->description }}</p>
                            </div>
                        </div>

                        <!-- Employee Summary -->
                        <div>
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold">Employees</h3>
                                <a href="{{ route('farms.employees.index', $farm) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    View All Employees
                                </a>
                            </div>
                            <div class="bg-gray-50 p-4 rounded">
                                @if($farm->employees->isEmpty())
                                    <p class="text-gray-500">No employees registered</p>
                                @else
                                    <div class="space-y-3">
                                        @foreach($farm->employees as $employee)
                                            <div class="flex justify-between items-center">
                                                <div>
                                                    <p class="font-semibold">{{ $employee->name }}</p>
                                                    <p class="text-sm text-gray-600">{{ $employee->position }}</p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="font-semibold">${{ number_format($employee->salary, 2) }}</p>
                                                    <p class="text-sm text-gray-600">{{ $employee->hire_date->format('d/m/Y') }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Inventory -->
                        <div>
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold">Inventory</h3>
                                <a href="{{ route('farms.stocks.index', $farm) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    View All Items
                                </a>
                            </div>
                            <div class="bg-gray-50 p-4 rounded">
                                @if($farm->stocks->isEmpty())
                                    <p class="text-gray-500">No items in inventory</p>
                                @else
                                    <div class="space-y-3">
                                        @foreach($farm->stocks as $stock)
                                            <div class="flex justify-between items-center">
                                                <div>
                                                    <p class="font-semibold">{{ $stock->name }}</p>
                                                    <p class="text-sm text-gray-600">{{ $stock->type }}</p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="font-semibold">{{ $stock->quantity }} {{ $stock->unit }}</p>
                                                    <p class="text-sm text-gray-600">${{ number_format($stock->price, 2) }}/unit</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Machinery -->
                        <div>
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold">Machinery</h3>
                                <a href="{{ route('farms.machinery.index', $farm) }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                                    View All Machinery
                                </a>
                            </div>
                            <div class="bg-gray-50 p-4 rounded">
                                @if($farm->machinery->isEmpty())
                                    <p class="text-gray-500">No machinery registered</p>
                                @else
                                    <div class="space-y-3">
                                        @foreach($farm->machinery as $machine)
                                            <div class="flex justify-between items-center p-3 bg-white rounded shadow-sm">
                                                <div>
                                                    <p class="font-semibold">{{ $machine->name }}</p>
                                                    <p class="text-sm text-gray-600">{{ $machine->type }}</p>
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                        @if($machine->status === 'operational') bg-green-100 text-green-800
                                                        @elseif($machine->status === 'maintenance') bg-yellow-100 text-yellow-800
                                                        @elseif($machine->status === 'repair') bg-red-100 text-red-800
                                                        @else bg-gray-100 text-gray-800
                                                        @endif">
                                                        {{ ucfirst($machine->status) }}
                                                    </span>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-sm text-gray-600">Next Maint: {{ $machine->next_maintenance ? $machine->next_maintenance->format('d/m/Y') : 'Not scheduled' }}</p>
                                                    <div class="flex space-x-2 mt-2">
                                                        <a href="{{ route('farms.machinery.edit', [$farm, $machine]) }}" 
                                                           class="text-yellow-600 hover:text-yellow-900">
                                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                            </svg>
                                                        </a>
                                                        <form action="{{ route('farms.machinery.destroy', [$farm, $machine]) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-900" 
                                                                    onclick="return confirm('Are you sure you want to delete this machine?')">
                                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Back Link -->
                    <div class="mt-6">
                        <a href="{{ route('farms.index') }}" class="text-blue-500 hover:text-blue-700">
                            ← Back to farm list
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 