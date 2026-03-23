<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nieuw Bericht</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <form method="POST" action="{{ route('messages.store') }}">
                    @csrf

                    <div class="space-y-5">
                        <div>
                            <x-input-label for="receiver_id" value="Aan *" />
                            @if($receiver)
                                <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                                <p class="mt-1 text-gray-700 font-medium">{{ $receiver->name }}</p>
                                <p class="text-sm text-gray-500">{{ $receiver->email }}</p>
                            @else
                                <x-text-input id="receiver_id" name="receiver_id" class="mt-1 block w-full"
                                    :value="old('receiver_id')" placeholder="Gebruiker ID" />
                            @endif
                            <x-input-error :messages="$errors->get('receiver_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="subject" value="Onderwerp *" />
                            <x-text-input id="subject" name="subject" class="mt-1 block w-full"
                                :value="old('subject')" required />
                            <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="body" value="Bericht *" />
                            <textarea id="body" name="body" rows="8" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('body') }}</textarea>
                            <x-input-error :messages="$errors->get('body')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-6 flex justify-between">
                        <a href="{{ route('messages.index') }}" class="text-gray-600 hover:underline text-sm self-center">Annuleren</a>
                        <x-primary-button>Versturen</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
