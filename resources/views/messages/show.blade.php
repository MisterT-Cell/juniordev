<x-app-layout>
    <x-slot name="header">
        <div>
            <a href="{{ route('messages.index') }}" class="text-sm text-gray-400 hover:text-gray-700">&larr; Terug</a>
            <h2 class="font-black text-2xl tracking-tight mt-1">{{ $message->subject }}</h2>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto px-6 py-10 space-y-5">

        <div class="bg-white rounded-2xl border border-gray-200 p-7">
            <div class="flex items-start gap-4 mb-6 pb-6 border-b border-gray-100">
                <div class="w-10 h-10 rounded-full bg-[#0a0a0a] text-white font-bold flex items-center justify-center shrink-0">
                    {{ strtoupper(substr($message->sender->name, 0, 1)) }}
                </div>
                <div class="flex-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-bold text-gray-900">{{ $message->sender->name }}</p>
                            <p class="text-xs text-gray-400">Aan: {{ $message->receiver->name }}</p>
                        </div>
                        <span class="text-xs text-gray-400">{{ $message->created_at->format('d-m-Y H:i') }}</span>
                    </div>
                </div>
            </div>
            <div class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $message->body }}</div>
        </div>

        @if($message->sender_id !== auth()->id())
        <div class="bg-white rounded-2xl border border-gray-200 p-7">
            <h3 class="font-black text-base mb-5">Beantwoorden</h3>
            <form method="POST" action="{{ route('messages.store') }}">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $message->sender_id }}">
                <input type="hidden" name="subject" value="Re: {{ $message->subject }}">
                <textarea name="body" rows="5" required
                    class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 resize-none mb-4"
                    placeholder="Schrijf je antwoord..."></textarea>
                <div class="flex justify-end">
                    <button type="submit" class="bg-[#0a0a0a] text-white font-bold px-6 py-3 rounded-full hover:bg-gray-800 transition text-sm">
                        Antwoorden
                    </button>
                </div>
            </form>
        </div>
        @endif

    </div>
</x-app-layout>
