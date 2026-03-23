<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl tracking-tight">Mijn Profiel</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto px-6 py-10">
        <div class="bg-white rounded-2xl border border-gray-200 p-8">

            @if(session('success'))
                <div class="bg-[#c8f135]/20 border border-[#c8f135] text-gray-800 px-5 py-3.5 rounded-2xl text-sm font-medium mb-6">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('student.profile.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Over mij</label>
                    <textarea name="bio" rows="4"
                        class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 resize-none">{{ old('bio', $profile->bio) }}</textarea>
                    <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Skills</label>
                    <x-text-input name="skills" class="block w-full !rounded-xl !border-gray-200 focus:!border-gray-900 focus:!ring-0"
                        :value="old('skills', $profile->skills)" placeholder="PHP, Laravel, MySQL, JavaScript" />
                    <x-input-error :messages="$errors->get('skills')" class="mt-2" />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Opleiding</label>
                    <x-text-input name="education" class="block w-full !rounded-xl !border-gray-200 focus:!border-gray-900 focus:!ring-0"
                        :value="old('education', $profile->education)" placeholder="HBO Informatica" />
                    <x-input-error :messages="$errors->get('education')" class="mt-2" />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Regio</label>
                    <select name="region" class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0">
                        <option value="">-- Kies regio --</option>
                        @foreach(['Amsterdam','Rotterdam','Utrecht','Den Haag','Eindhoven','Groningen','Tilburg','Remote'] as $r)
                            <option value="{{ $r }}" {{ old('region', $profile->region) === $r ? 'selected' : '' }}>{{ $r }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('region')" class="mt-2" />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Telefoonnummer</label>
                    <x-text-input name="phone" class="block w-full !rounded-xl !border-gray-200 focus:!border-gray-900 focus:!ring-0"
                        :value="old('phone', $profile->phone)" placeholder="+31 6 12345678" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit" class="bg-[#0a0a0a] text-white font-bold px-6 py-3 rounded-full hover:bg-gray-800 transition text-sm">
                        Profiel opslaan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
