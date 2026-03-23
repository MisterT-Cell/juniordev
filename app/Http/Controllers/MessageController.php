<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Notifications\NewMessageReceived;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::where('receiver_id', auth()->id())
            ->with('sender')
            ->latest()
            ->paginate(15);
        return view('messages.index', compact('messages'));
    }

    public function create(Request $request)
    {
        $receiver = null;
        if ($request->to) {
            $receiver = User::findOrFail($request->to);
        }
        return view('messages.create', compact('receiver'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:200',
            'body' => 'required|string|max:5000',
        ]);

        $validated['sender_id'] = auth()->id();
        $message = Message::create($validated);

        $message->receiver->notify(new NewMessageReceived($message));

        return redirect()->route('messages.index')->with('success', 'Bericht verstuurd!');
    }

    public function show(Message $message)
    {
        if ($message->receiver_id !== auth()->id() && $message->sender_id !== auth()->id()) {
            abort(403);
        }
        if ($message->receiver_id === auth()->id() && !$message->read_at) {
            $message->update(['read_at' => now()]);
        }
        return view('messages.show', compact('message'));
    }

    public function sent()
    {
        $messages = Message::where('sender_id', auth()->id())
            ->with('receiver')
            ->latest()
            ->paginate(15);
        return view('messages.sent', compact('messages'));
    }
}
