<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Edit Employee - {{ $farm->name }}</h2>

                    <form action="{{ route('farms.employees.update', [$farm, $employee]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name and Position -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                    Name
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" 
                                    id="name" 
                                    type="text" 
                                    name="name" 
                                    value="{{ old('name', $employee->name) }}" 
                                    required>
                                @error('name')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="position">
                                    Position
                                </label>
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('position') border-red-500 @enderror"
                                    id="position"
                                    name="position"
                                    required>
                                    <option value="">Select Position</option>
                                    <option value="Manager" {{ old('position', $employee->position) == 'Manager' ? 'selected' : '' }}>Manager</option>
                                    <option value="Supervisor" {{ old('position', $employee->position) == 'Supervisor' ? 'selected' : '' }}>Supervisor</option>
                                    <option value="Worker" {{ old('position', $employee->position) == 'Worker' ? 'selected' : '' }}>Worker</option>
                                    <option value="Technician" {{ old('position', $employee->position) == 'Technician' ? 'selected' : '' }}>Technician</option>
                                </select>
                                @error('position')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Contact Information -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                                    Phone
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('phone') border-red-500 @enderror" 
                                    id="phone" 
                                    type="tel" 
                                    pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                                    placeholder="123-456-7890"
                                    name="phone" 
                                    value="{{ old('phone', $employee->phone) }}">
                                @error('phone')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                                <p class="text-gray-600 text-xs mt-1">Format: 123-456-7890</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                                    Email
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" 
                                    id="email" 
                                    type="email" 
                                    name="email" 
                                    placeholder="employee@example.com"
                                    value="{{ old('email', $employee->email) }}">
                                @error('email')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Employment Details -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="salary">
                                    Salary
                                </label>
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-600">$</span>
                                    <input class="shadow appearance-none border rounded w-full py-2 pl-7 pr-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('salary') border-red-500 @enderror" 
                                        id="salary" 
                                        type="number" 
                                        step="0.01" 
                                        name="salary" 
                                        value="{{ old('salary', $employee->salary) }}" 
                                        required>
                                </div>
                                @error('salary')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="hire_date">
                                    Hire Date
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('hire_date') border-red-500 @enderror" 
                                    id="hire_date" 
                                    type="date" 
                                    name="hire_date" 
                                    value="{{ old('hire_date', $employee->hire_date->format('Y-m-d')) }}" 
                                    required>
                                @error('hire_date')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                                type="submit"
                                onclick="return confirm('Are you sure you want to update this employee\'s information?')">
                                Update Employee
                            </button>
                            <a href="{{ route('farms.employees.index', $farm) }}" 
                                class="text-gray-500 hover:text-gray-700">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>