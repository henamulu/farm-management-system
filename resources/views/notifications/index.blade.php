<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Notification Filters -->
                    <div class="mb-6">
                        <div class="flex gap-4">
                            <button class="px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300" 
                                    @click="filterType = 'all'">
                                All
                            </button>
                            <button class="px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300" 
                                    @click="filterType = 'unread'">
                                Unread
                            </button>
                        </div>
                    </div>

                    <!-- Notifications List -->
                    <div class="space-y-4">
                        @forelse($notifications as $notification)
                            <div class="notification-item p-4 border rounded-lg {{ $notification->read_at ? 'bg-white' : 'bg-blue-50' }}">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-medium">{{ $notification->data['title'] }}</h3>
                                        <p class="text-gray-600">{{ $notification->data['message'] }}</p>
                                        <span class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                                    </div>
                                    @if(!$notification->read_at)
                                        <form method="POST" action="{{ route('notifications.mark-as-read', $notification->id) }}">
                                            @csrf
                                            <button type="submit" class="text-blue-600 hover:text-blue-800">
                                                Mark as read
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500">
                                No notifications found
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $notifications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 