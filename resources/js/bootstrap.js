import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

if (window.userId) {
    window.Echo.private(`App.Models.User.${window.userId}`)
        .notification((notification) => {
            // Add notification to the UI
            const container = document.createElement('div');
            container.innerHTML = `
                <div class="bg-white rounded-lg shadow-lg p-4 mb-2 max-w-sm animate-slide-in-right">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="font-semibold">${notification.subject}</h4>
                            <p class="text-sm text-gray-600">${notification.farm_name}</p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            ${notification.priority === 'high' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800'}">
                            ${notification.priority.charAt(0).toUpperCase() + notification.priority.slice(1)}
                        </span>
                    </div>
                    <div class="mt-2 flex justify-between items-center">
                        <a href="/messages/${notification.message_id}" 
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
            `;
            document.querySelector('.notification-container').appendChild(container.firstElementChild);
        });
} 