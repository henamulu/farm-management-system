<div class="notification-item p-4 border rounded-lg {{ $notification->read_at ? 'bg-white' : 'bg-blue-50' }}">
    <div class="flex items-start gap-4">
        <!-- Notification Icon -->
        <div class="notification-icon">
            @switch($notification->data['type'])
                @case('alert')
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    @break
                @case('info')
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    @break
                @default
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
            @endswitch
        </div>

        <!-- Notification Content -->
        <div class="flex-1">
            <h4 class="font-medium text-gray-900">{{ $notification->data['title'] }}</h4>
            <p class="text-gray-600">{{ $notification->data['message'] }}</p>
            <div class="mt-2 flex items-center gap-4">
                <span class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                @if(!$notification->read_at)
                    <form method="POST" action="{{ route('notifications.mark-as-read', $notification->id) }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-blue-600 hover:text-blue-800">
                            Mark as read
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div> 