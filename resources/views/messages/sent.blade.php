<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl tracking-tight">Berichten</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto px-6 py-10">

        <div class="flex gap-1 mb-6 bg-white border border-gray-200 rounded-full p-1 w-fit">
            <a href="{{ route('messages.index') }}"
                class="text-sm font-semibold px-4 py-1.5 rounded-full text-gray-500 hover:text-gray-900 transition">
                Ontvangen
            </a>
            <a href="{{ route('messages.sent') }}"
                class="text-sm font-semibold px-4 py-1.5 rounded-full bg-[#0a0a0a] text-white transition">
                Verzonden
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            @forelse($messages as $message)
            <a href="{{ route('messages.show', $message) }}"
                class="flex items-start gap-4 p-5 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition">
                <div class="shrink-0 w-9 h-9 rounded-full bg-gray-200 text-gray-600 font-bold flex items-center justify-center text-sm mt-0.5">
                    {{ strtoupper(substr($message->receiver->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex justify-between items-start gap-2">
                        <p class="font-bold text-sm text-gray-900">{{ $message->subject }}</p>
                        <span class="text-xs text-gray-400 shrink-0">{{ $message->created_at->format('d-m-Y') }}</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-0.5">Aan: {{ $message->receiver->name }}</p>
                    <p class="text-sm text-gray-500 mt-1 truncate">{{ Str::limit($message->body, 80) }}</p>
                </div>
            </a>
            @empty
            <div class="p-16 text-center text-gray-400">
                <p class="font-semibold">Geen verzonden berichten.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-5">{{ $messages->links() }}</div>
    </div>
</x-app-layout>
