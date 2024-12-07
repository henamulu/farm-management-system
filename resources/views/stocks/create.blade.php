<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">New Inventory Item - {{ $farm->name }}</h2>

                    <form action="{{ route('farms.stocks.store', $farm) }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                    Name
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" 
                                    id="name" 
                                    type="text" 
                                    name="name" 
                                    value="{{ old('name') }}" 
                                    required>
                                @error('name')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Type -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="type">
                                    Type
                                </label>
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('type') border-red-500 @enderror"
                                    id="type"
                                    name="type"
                                    required>
                                    <option value="">Select Type</option>
                                    <option value="seeds" {{ old('type') == 'seeds' ? 'selected' : '' }}>Seeds</option>
                                    <option value="fertilizer" {{ old('type') == 'fertilizer' ? 'selected' : '' }}>Fertilizer</option>
                                    <option value="tools" {{ old('type') == 'tools' ? 'selected' : '' }}>Tools</option>
                                    <option value="equipment" {{ old('type') == 'equipment' ? 'selected' : '' }}>Equipment</option>
                                </select>
                                @error('type')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Quantity -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="quantity">
                                    Quantity
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('quantity') border-red-500 @enderror" 
                                    id="quantity" 
                                    type="number" 
                                    name="quantity" 
                                    value="{{ old('quantity') }}" 
                                    required>
                                @error('quantity')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Unit -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="unit">
                                    Unit
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('unit') border-red-500 @enderror" 
                                    id="unit" 
                                    type="text" 
                                    name="unit" 
                                    value="{{ old('unit') }}" 
                                    placeholder="kg, units, etc."
                                    required>
                                @error('unit')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                                    Price per Unit
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('price') border-red-500 @enderror" 
                                    id="price" 
                                    type="number" 
                                    step="0.01" 
                                    name="price" 
                                    value="{{ old('price') }}" 
                                    required>
                                @error('price')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                                type="submit">
                                Save Item
                            </button>
                            <a href="{{ route('farms.show', $farm) }}" 
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