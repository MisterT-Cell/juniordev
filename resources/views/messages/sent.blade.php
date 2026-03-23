<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Verzonden berichten</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="flex gap-4 mb-4">
                <a href="{{ route('messages.index') }}" class="text-sm text-gray-600 hover:text-gray-900 pb-1">Ontvangen</a>
                <a href="{{ route('messages.sent') }}" class="text-sm font-medium text-indigo-600 border-b-2 border-indigo-600 pb-1">Verzonden</a>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                @forelse($messages as $message)
                <a href="{{ route('messages.show', $message) }}"
                    class="block p-4 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <p class="font-medium text-gray-900 text-sm">{{ $message->subject }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">Aan: {{ $message->receiver->name }}</p>
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($message->body, 80) }}</p>
                        </div>
                        <span class="text-xs text-gray-400 ml-4 shrink-0">{{ $message->created_at->format('d-m-Y') }}</span>
                    </div>
                </a>
                @empty
                <div class="p-12 text-center text-gray-500">
                    <p>Geen verzonden berichten.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-4">{{ $messages->links() }}</div>
        </div>
    </div>
</x-app-layout>
