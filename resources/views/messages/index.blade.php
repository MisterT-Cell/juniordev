<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl tracking-tight">Berichten</h2>
            <a href="{{ route('messages.create') }}" class="bg-[#0a0a0a] text-white text-sm font-bold px-4 py-2 rounded-full hover:bg-gray-800 transition">
                + Nieuw bericht
            </a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto px-6 py-10">

        @if(session('success'))
            <div class="bg-[#c8f135]/20 border border-[#c8f135] text-gray-800 px-5 py-3.5 rounded-2xl text-sm font-medium mb-5">{{ session('success') }}</div>
        @endif

        <div class="flex gap-1 mb-6 bg-white border border-gray-200 rounded-full p-1 w-fit">
            <a href="{{ route('messages.index') }}"
                class="text-sm font-semibold px-4 py-1.5 rounded-full {{ request()->routeIs('messages.index') ? 'bg-[#0a0a0a] text-white' : 'text-gray-500 hover:text-gray-900' }} transition">
                Ontvangen
            </a>
            <a href="{{ route('messages.sent') }}"
                class="text-sm font-semibold px-4 py-1.5 rounded-full {{ request()->routeIs('messages.sent') ? 'bg-[#0a0a0a] text-white' : 'text-gray-500 hover:text-gray-900' }} transition">
                Verzonden
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            @forelse($messages as $message)
            <a href="{{ route('messages.show', $message) }}"
                class="flex items-start gap-4 p-5 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition group {{ !$message->read_at ? 'bg-[#fafff0]' : '' }}">
                <div class="shrink-0 w-9 h-9 rounded-full bg-[#0a0a0a] text-white font-bold flex items-center justify-center text-sm mt-0.5">
                    {{ strtoupper(substr($message->sender->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex justify-between items-start gap-2">
                        <p class="font-bold text-sm text-gray-900 flex items-center gap-2">
                            @if(!$message->read_at)
                                <span class="w-2 h-2 bg-[#c8f135] rounded-full shrink-0"></span>
                            @endif
                            {{ $message->subject }}
                        </p>
                        <span class="text-xs text-gray-400 shrink-0">{{ $message->created_at->format('d-m-Y') }}</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-0.5">Van: {{ $message->sender->name }}</p>
                    <p class="text-sm text-gray-500 mt-1 truncate">{{ Str::limit($message->body, 80) }}</p>
                </div>
            </a>
            @empty
            <div class="p-16 text-center text-gray-400">
                <p class="font-semibold">Geen berichten in je inbox.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-5">{{ $messages->links() }}</div>
    </div>
</x-app-layout>
