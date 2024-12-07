<div class="fixed bottom-4 right-4 z-50">
    @foreach(Auth::user()->unreadNotifications as $notification)
        <div class="bg-white rounded-lg shadow-lg p-4 mb-2 max-w-sm animate-slide-in-right">
            <div class="flex justify-between items-start">
                <div>
                    <h4 class="font-semibold">{{ $notification->data['subject'] }}</h4>
                    <p class="text-sm text-gray-600">{{ $notification->data['farm_name'] }}</p>
                </div>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                    {{ $notification->data['priority'] === 'high' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                    {{ ucfirst($notification->data['priority']) }}
                </span>
            </div>
            <div class="mt-2 flex justify-between items-center">
                <a href="{{ route('messages.show', $notification->data['message_id']) }}" 
                   class="text-sm text-blue-600 hover:text-blue-800">
                    View Message
                </a>
                <button onclick="this.parentElement.parentElement.remove()" 
                        class="text-gray-400 hover:text-gray-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    @endforeach
</div> 