<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Messages</h2>
                        <a href="{{ route('messages.create') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            New Message
                        </a>
                    </div>

                    <!-- Search and Filters -->
                    <form method="GET" class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                   placeholder="Search messages...">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                            <select name="priority" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="all">All Priorities</option>
                                @foreach(App\Models\Message::PRIORITIES as $key => $value)
                                    <option value="{{ $key }}" {{ request('priority') === $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="all">All Status</option>
                                <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Unread</option>
                                <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
                            </select>
                        </div>

                        <div class="flex items-end space-x-2">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Apply Filters
                            </button>
                            <a href="{{ route('messages.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Clear
                            </a>
                        </div>
                    </form>

                    <!-- Messages List -->
                    <div class="space-y-4">
                        @forelse($messages as $message)
                            <div class="border rounded-lg p-4 {{ $message->status === 'unread' ? 'bg-blue-50' : 'bg-white' }}">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-lg font-semibold">
                                            <a href="{{ route('messages.show', $message) }}" class="hover:text-blue-600">
                                                {{ $message->subject }}
                                            </a>
                                        </h3>
                                        <p class="text-sm text-gray-600">{{ $message->farm->name }}</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if($message->priority === 'high') bg-red-100 text-red-800
                                            @elseif($message->priority === 'normal') bg-green-100 text-green-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($message->priority) }}
                                        </span>
                                        <p class="text-sm text-gray-500 mt-1">{{ $message->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <p class="mt-2 text-gray-600">{{ Str::limit($message->content, 150) }}</p>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">No messages found</p>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $messages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 