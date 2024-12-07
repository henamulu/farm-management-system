<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Editar Maquinaria - {{ $farm->name }}</h2>

                    <form action="{{ route('farms.machinery.update', [$farm, $machinery]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                    Nombre
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                    id="name" 
                                    type="text" 
                                    name="name" 
                                    value="{{ old('name', $machinery->name) }}" 
                                    required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="type">
                                    Tipo
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                    id="type" 
                                    type="text" 
                                    name="type" 
                                    value="{{ old('type', $machinery->type) }}" 
                                    required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                                    Estado
                                </label>
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="status"
                                    name="status"
                                    required>
                                    <option value="operational" {{ $machinery->status == 'operational' ? 'selected' : '' }}>Operativo</option>
                                    <option value="maintenance" {{ $machinery->status == 'maintenance' ? 'selected' : '' }}>En Mantenimiento</option>
                                    <option value="repair" {{ $machinery->status == 'repair' ? 'selected' : '' }}>En Reparación</option>
                                    <option value="retired" {{ $machinery->status == 'retired' ? 'selected' : '' }}>Retirado</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="purchase_date">
                                    Fecha de Compra
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                    id="purchase_date" 
                                    type="date" 
                                    name="purchase_date" 
                                    value="{{ old('purchase_date', $machinery->purchase_date->format('Y-m-d')) }}" 
                                    required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="purchase_price">
                                    Precio de Compra
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                    id="purchase_price" 
                                    type="number" 
                                    step="0.01" 
                                    name="purchase_price" 
                                    value="{{ old('purchase_price', $machinery->purchase_price) }}" 
                                    required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="last_maintenance">
                                    Último Mantenimiento
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                    id="last_maintenance" 
                                    type="date" 
                                    name="last_maintenance" 
                                    value="{{ old('last_maintenance', optional($machinery->last_maintenance)->format('Y-m-d')) }}">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="next_maintenance">
                                    Próximo Mantenimiento
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                    id="next_maintenance" 
                                    type="date" 
                                    name="next_maintenance" 
                                    value="{{ old('next_maintenance', optional($machinery->next_maintenance)->format('Y-m-d')) }}">
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                                type="submit">
                                Actualizar Maquinaria
                            </button>
                            <a href="{{ route('farms.show', $farm) }}" 
                                class="text-gray-500 hover:text-gray-700">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 