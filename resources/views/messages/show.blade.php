<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Message Header -->
                    <div class="border-b pb-4 mb-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h2 class="text-2xl font-bold">{{ $message->subject }}</h2>
                                <p class="text-gray-600">{{ $message->farm->name }}</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    @if($message->priority === 'high') bg-red-100 text-red-800
                                    @elseif($message->priority === 'normal') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($message->priority) }} Priority
                                </span>
                                <p class="text-sm text-gray-500 mt-1">{{ $message->created_at->format('M d, Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Message Content -->
                    <div class="prose max-w-none">
                        {{ $message->content }}
                    </div>

                    <!-- Message Footer -->
                    <div class="mt-6 pt-4 border-t flex justify-between items-center">
                        <div class="text-sm text-gray-500">
                            @if($message->read_at)
                                Read {{ $message->read_at->diffForHumans() }}
                            @endif
                        </div>
                        <a href="{{ route('messages.index') }}" 
                           class="text-blue-600 hover:text-blue-900">
                            ← Back to Messages
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 