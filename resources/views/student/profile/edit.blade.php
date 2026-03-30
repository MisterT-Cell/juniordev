<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.15em] text-gray-400 mb-0.5">Instellingen</p>
            <h2 class="font-black text-2xl tracking-tight">Mijn profiel</h2>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto px-6 py-10">

        @if(session('success'))
            <div class="bg-[#c8f135]/20 border border-[#c8f135] text-gray-800 px-5 py-3.5 rounded-2xl text-sm font-medium mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">

            {{-- Account header --}}
            <div class="px-8 py-6 border-b border-gray-100 flex items-center gap-4">
                <div class="w-14 h-14 bg-[#0a0a0a] text-white rounded-xl flex items-center justify-center font-black text-xl">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="font-bold text-gray-900">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-400">{{ auth()->user()->email }}</p>
                </div>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('student.profile.update') }}" class="p-8 space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Over mij</label>
                    <textarea name="bio" rows="4"
                        class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 resize-none"
                        placeholder="Vertel iets over jezelf, je passies en ambities...">{{ old('bio', auth()->user()->studentProfile?->bio) }}</textarea>
                    <x-input-error :messages="$errors->get('bio')" class="mt-1.5" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Skills</label>
                        <x-text-input name="skills"
                            class="block w-full !rounded-xl !border-gray-200 focus:!border-gray-900 focus:!ring-0 text-sm"
                            :value="old('skills', auth()->user()->studentProfile?->skills)"
                            placeholder="PHP, Laravel, React..." />
                        <p class="text-xs text-gray-400 mt-1.5">Komma-gescheiden</p>
                        <x-input-error :messages="$errors->get('skills')" class="mt-1" />
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Opleiding</label>
                        <x-text-input name="education"
                            class="block w-full !rounded-xl !border-gray-200 focus:!border-gray-900 focus:!ring-0 text-sm"
                            :value="old('education', auth()->user()->studentProfile?->education)"
                            placeholder="HBO Informatica" />
                        <x-input-error :messages="$errors->get('education')" class="mt-1" />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Regio</label>
                        <select name="region" class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 bg-white">
                            <option value="">-- Kies regio --</option>
                            @foreach(['Amsterdam','Rotterdam','Utrecht','Den Haag','Eindhoven','Groningen','Tilburg','Remote'] as $r)
                                <option value="{{ $r }}"
                                    {{ old('region', auth()->user()->studentProfile?->region) === $r ? 'selected' : '' }}>
                                    {{ $r }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('region')" class="mt-1" />
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Telefoonnummer</label>
                        <x-text-input name="phone"
                            class="block w-full !rounded-xl !border-gray-200 focus:!border-gray-900 focus:!ring-0 text-sm"
                            :value="old('phone', auth()->user()->studentProfile?->phone)"
                            placeholder="+31 6 12 34 56 78" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                    </div>
                </div>

                <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                    <a href="{{ route('dashboard') }}" class="text-sm text-gray-400 hover:text-gray-700 transition">
                        &larr; Terug
                    </a>
                    <button type="submit"
                        class="bg-[#0a0a0a] text-white font-bold px-6 py-2.5 rounded-full hover:bg-gray-800 transition text-sm">
                        Opslaan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
