<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6">New Message</h2>

                    <form action="{{ route('messages.store') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            <!-- Farm Selection -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Farm</label>
                                <select name="farm_id" 
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('farm_id') border-red-500 @enderror"
                                        required>
                                    <option value="">Select Farm</option>
                                    @foreach($farms as $farm)
                                        <option value="{{ $farm->id }}" {{ old('farm_id') == $farm->id ? 'selected' : '' }}>
                                            {{ $farm->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('farm_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Subject -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                                <input type="text" 
                                       name="subject" 
                                       value="{{ old('subject') }}"
                                       class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('subject') border-red-500 @enderror"
                                       required>
                                @error('subject')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Priority -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                                <select name="priority" 
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('priority') border-red-500 @enderror"
                                        required>
                                    @foreach(App\Models\Message::PRIORITIES as $key => $value)
                                        <option value="{{ $key }}" {{ old('priority', 'normal') === $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('priority')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Content -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                                <textarea name="content" 
                                          rows="6" 
                                          class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('content') border-red-500 @enderror"
                                          required>{{ old('content') }}</textarea>
                                @error('content')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-between">
                                <button type="submit" 
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Send Message
                                </button>
                                <a href="{{ route('messages.index') }}" 
                                   class="text-gray-500 hover:text-gray-700">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 