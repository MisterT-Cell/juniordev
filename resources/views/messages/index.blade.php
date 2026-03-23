<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Inbox</h2>
            <a href="{{ route('messages.create') }}" class="bg-indigo-600 text-white text-sm px-4 py-2 rounded hover:bg-indigo-700">
                + Nieuw bericht
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <div class="flex gap-4 mb-4">
                <a href="{{ route('messages.index') }}" class="text-sm font-medium text-indigo-600 border-b-2 border-indigo-600 pb-1">Ontvangen</a>
                <a href="{{ route('messages.sent') }}" class="text-sm text-gray-600 hover:text-gray-900 pb-1">Verzonden</a>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                @forelse($messages as $message)
                <a href="{{ route('messages.show', $message) }}"
                    class="block p-4 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition {{ !$message->read_at ? 'bg-indigo-50' : '' }}">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                @if(!$message->read_at)
                                    <span class="w-2 h-2 bg-indigo-500 rounded-full"></span>
                                @endif
                                <p class="font-medium text-gray-900 text-sm">{{ $message->subject }}</p>
                            </div>
                            <p class="text-xs text-gray-500 mt-0.5">Van: {{ $message->sender->name }}</p>
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($message->body, 80) }}</p>
                        </div>
                        <span class="text-xs text-gray-400 ml-4 shrink-0">{{ $message->created_at->format('d-m-Y') }}</span>
                    </div>
                </a>
                @empty
                <div class="p-12 text-center text-gray-500">
                    <p>Geen berichten in je inbox.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-4">{{ $messages->links() }}</div>
        </div>
    </div>
</x-app-layout>
