<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Employees - {{ $farm->name }}</h2>
                        <a href="{{ route('farms.employees.create', $farm) }}" 
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            New Employee
                        </a>
                    </div>

                    <!-- Search and Filter Section -->
                    <div class="mb-6">
                        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Search -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                                <input type="text" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                       placeholder="Search by name or position...">
                            </div>

                            <!-- Position Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Position</label>
                                <select name="position" 
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">All Positions</option>
                                    <option value="manager" {{ request('position') === 'manager' ? 'selected' : '' }}>Manager</option>
                                    <option value="worker" {{ request('position') === 'worker' ? 'selected' : '' }}>Worker</option>
                                    <option value="technician" {{ request('position') === 'technician' ? 'selected' : '' }}>Technician</option>
                                </select>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-end">
                                <button type="submit" 
                                        class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                    Apply Filters
                                </button>
                                <a href="{{ route('farms.employees.index', $farm) }}" 
                                   class="ml-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    Clear
                                </a>
                            </div>
                        </form>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Salary</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($employees as $employee)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $employee->position }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div>{{ $employee->phone }}</div>
                                            <div class="text-sm text-gray-500">{{ $employee->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">${{ number_format($employee->salary, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('farms.employees.edit', [$farm, $employee]) }}" 
                                               class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                            <form action="{{ route('farms.employees.destroy', [$farm, $employee]) }}" 
                                                  method="POST" 
                                                  class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-red-600 hover:text-red-900"
                                                        onclick="return confirm('Are you sure you want to delete this employee?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            No employees found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $employees->links() }}
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('farms.show', $farm) }}" class="text-indigo-600 hover:text-indigo-900">
                            ← Back to Farm Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>