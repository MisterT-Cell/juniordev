<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl tracking-tight">Nieuw Bericht</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto px-6 py-10">
        <div class="bg-white rounded-2xl border border-gray-200 p-8">
            <form method="POST" action="{{ route('messages.store') }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Aan *</label>
                    @if($receiver)
                        <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                        <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3">
                            <div class="w-8 h-8 rounded-full bg-[#0a0a0a] text-white font-bold flex items-center justify-center text-xs">
                                {{ strtoupper(substr($receiver->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-semibold text-sm text-gray-900">{{ $receiver->name }}</p>
                                <p class="text-xs text-gray-400">{{ $receiver->email }}</p>
                            </div>
                        </div>
                    @else
                        <x-text-input name="receiver_id" class="block w-full !rounded-xl !border-gray-200"
                            :value="old('receiver_id')" placeholder="Gebruiker ID" />
                    @endif
                    <x-input-error :messages="$errors->get('receiver_id')" class="mt-2" />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Onderwerp *</label>
                    <x-text-input name="subject" class="block w-full !rounded-xl !border-gray-200 focus:!border-gray-900 focus:!ring-0"
                        :value="old('subject')" required />
                    <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Bericht *</label>
                    <textarea name="body" rows="8" required
                        class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 resize-none">{{ old('body') }}</textarea>
                    <x-input-error :messages="$errors->get('body')" class="mt-2" />
                </div>

                <div class="flex justify-between items-center pt-2">
                    <a href="{{ route('messages.index') }}" class="text-sm text-gray-400 hover:text-gray-700 transition">Annuleren</a>
                    <button type="submit" class="bg-[#0a0a0a] text-white font-bold px-6 py-3 rounded-full hover:bg-gray-800 transition text-sm">
                        Versturen
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
