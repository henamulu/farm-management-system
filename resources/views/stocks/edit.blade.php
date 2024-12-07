<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Edit Inventory Item - {{ $farm->name }}</h2>

                    <form action="{{ route('farms.stocks.update', [$farm, $stock]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                Name
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                id="name" 
                                type="text" 
                                name="name" 
                                value="{{ old('name', $stock->name) }}" 
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="type">
                                Type
                            </label>
                            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="type"
                                name="type"
                                required>
                                <option value="">Select a type</option>
                                <option value="semillas" {{ old('type', $stock->type) == 'semillas' ? 'selected' : '' }}>Seeds</option>
                                <option value="fertilizantes" {{ old('type', $stock->type) == 'fertilizantes' ? 'selected' : '' }}>Fertilizers</option>
                                <option value="herramientas" {{ old('type', $stock->type) == 'herramientas' ? 'selected' : '' }}>Tools</option>
                                <option value="maquinaria" {{ old('type', $stock->type) == 'maquinaria' ? 'selected' : '' }}>Machinery</option>
                                <option value="otros" {{ old('type', $stock->type) == 'otros' ? 'selected' : '' }}>Others</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="quantity">
                                Quantity
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                id="quantity" 
                                type="number" 
                                name="quantity" 
                                value="{{ old('quantity', $stock->quantity) }}"
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="unit">
                                Unit of Measure
                            </label>
                            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="unit"
                                name="unit"
                                required>
                                <option value="">Select a unit</option>
                                <option value="kg" {{ old('unit', $stock->unit) == 'kg' ? 'selected' : '' }}>Kilograms</option>
                                <option value="g" {{ old('unit', $stock->unit) == 'g' ? 'selected' : '' }}>Grams</option>
                                <option value="l" {{ old('unit', $stock->unit) == 'l' ? 'selected' : '' }}>Liters</option>
                                <option value="unidad" {{ old('unit', $stock->unit) == 'unidad' ? 'selected' : '' }}>Units</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                                Unit Price
                            </label>
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                id="price" 
                                type="number" 
                                step="0.01" 
                                name="price" 
                                value="{{ old('price', $stock->price) }}">
                        </div>

                        <div class="flex items-center justify-between">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                                type="submit">
                                Update Item
                            </button>
                            <a href="{{ route('farms.stocks.index', $farm) }}" 
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