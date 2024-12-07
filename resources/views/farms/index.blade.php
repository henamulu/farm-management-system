<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">My Farms</h2>
                        <a href="{{ route('farms.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            New Farm
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($farms as $farm)
                            <div class="border rounded-lg p-4">
                                <h3 class="text-xl font-semibold">{{ $farm->name }}</h3>
                                <p class="text-gray-600">{{ $farm->location }}</p>
                                <p class="text-gray-600">Size: {{ $farm->size }} hectares</p>
                                <div class="mt-4">
                                    <a href="{{ route('farms.show', $farm) }}" class="text-blue-500 hover:text-blue-700">View details</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 