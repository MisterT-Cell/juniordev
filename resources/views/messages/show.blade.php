<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $message->subject }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-4">

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex justify-between items-start mb-4 pb-4 border-b border-gray-100">
                    <div>
                        <p class="text-sm text-gray-600">
                            <span class="font-medium">Van:</span> {{ $message->sender->name }}
                        </p>
                        <p class="text-sm text-gray-600">
                            <span class="font-medium">Aan:</span> {{ $message->receiver->name }}
                        </p>
                    </div>
                    <span class="text-xs text-gray-400">{{ $message->created_at->format('d-m-Y H:i') }}</span>
                </div>

                <div class="text-gray-700 whitespace-pre-line">{{ $message->body }}</div>
            </div>

            <!-- Reply -->
            @if($message->sender_id !== auth()->id())
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="font-medium text-gray-900 mb-4">Beantwoorden</h3>
                <form method="POST" action="{{ route('messages.store') }}">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $message->sender_id }}">
                    <input type="hidden" name="subject" value="Re: {{ $message->subject }}">
                    <textarea name="body" rows="4" required
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                        placeholder="Schrijf je antwoord..."></textarea>
                    <div class="mt-3 flex justify-end">
                        <x-primary-button>Antwoorden</x-primary-button>
                    </div>
                </form>
            </div>
            @endif

            <a href="{{ route('messages.index') }}" class="inline-block text-sm text-gray-600 hover:underline">&larr; Terug naar inbox</a>
        </div>
    </div>
</x-app-layout>
