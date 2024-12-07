<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Farm;
use Illuminate\Http\Request;
use App\Notifications\NewMessageNotification;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $query = Message::query()
            ->where('user_id', auth()->id())
            ->with(['farm']);

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('subject', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filter by priority
        if ($request->has('priority') && $request->priority !== 'all') {
            $query->where('priority', $request->priority);
        }

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $messages = $query->latest()->paginate(10);

        return view('messages.index', compact('messages'));
    }

    public function create()
    {
        $farms = auth()->user()->farms;
        return view('messages.create', compact('farms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'priority' => 'required|in:low,normal,high'
        ]);

        $message = Message::create([
            'user_id' => auth()->id(),
            ...$validated
        ]);

        // Send notification to all users associated with the farm
        $farm = Farm::find($validated['farm_id']);
        $farm->user->notify(new NewMessageNotification($message));

        return redirect()->route('messages.index')
            ->with('success', 'Message created successfully.');
    }

    public function show(Message $message)
    {
        $message->markAsRead();
        return view('messages.show', compact('message'));
    }
} 