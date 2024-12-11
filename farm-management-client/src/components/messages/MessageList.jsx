import { useQuery, useMutation, useQueryClient } from '@tanstack/react-query';
import { endpoints } from '../../api/endpoints';
import { useState } from 'react';

export default function MessageList() {
    const [newMessage, setNewMessage] = useState('');
    const queryClient = useQueryClient();

    const { data: messages, isLoading } = useQuery({
        queryKey: ['messages'],
        queryFn: endpoints.getMessages
    });

    const createMessageMutation = useMutation({
        mutationFn: endpoints.createMessage,
        onSuccess: () => {
            queryClient.invalidateQueries(['messages']);
            setNewMessage('');
        }
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        if (newMessage.trim()) {
            createMessageMutation.mutate({ content: newMessage });
        }
    };

    if (isLoading) return <div>Loading...</div>;

    return (
        <div>
            <h1 className="text-2xl font-semibold text-gray-900">Messages</h1>
            
            {/* Message Form */}
            <form onSubmit={handleSubmit} className="mt-6">
                <div className="flex gap-4">
                    <input
                        type="text"
                        value={newMessage}
                        onChange={(e) => setNewMessage(e.target.value)}
                        className="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="Type your message..."
                    />
                    <button
                        type="submit"
                        className="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700"
                    >
                        Send
                    </button>
                </div>
            </form>

            {/* Message List */}
            <div className="mt-6">
                <div className="flow-root">
                    <ul className="-my-5 divide-y divide-gray-200">
                        {messages?.map((message) => (
                            <li key={message.id} className="py-5">
                                <div className="relative focus-within:ring-2 focus-within:ring-indigo-500">
                                    <h3 className="text-sm font-semibold text-gray-800">
                                        {message.sender.name}
                                    </h3>
                                    <p className="mt-1 text-sm text-gray-600 line-clamp-2">
                                        {message.content}
                                    </p>
                                    <time className="text-xs text-gray-400">
                                        {new Date(message.created_at).toLocaleString()}
                                    </time>
                                </div>
                            </li>
                        ))}
                    </ul>
                </div>
            </div>
        </div>
    );
} 