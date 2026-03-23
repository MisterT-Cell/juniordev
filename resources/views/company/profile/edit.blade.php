<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl tracking-tight">Bedrijfsprofiel</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto px-6 py-10">
        <div class="bg-white rounded-2xl border border-gray-200 p-8">

            @if(session('success'))
                <div class="bg-[#c8f135]/20 border border-[#c8f135] text-gray-800 px-5 py-3.5 rounded-2xl text-sm font-medium mb-6">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('company.profile.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Bedrijfsnaam *</label>
                    <x-text-input name="company_name" class="block w-full !rounded-xl !border-gray-200 focus:!border-gray-900 focus:!ring-0"
                        :value="old('company_name', $profile->company_name)" required />
                    <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Beschrijving</label>
                    <textarea name="description" rows="5"
                        class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 resize-none"
                        placeholder="Vertel junior developers over jullie bedrijf...">{{ old('description', $profile->description) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Website</label>
                    <x-text-input name="website" type="url" class="block w-full !rounded-xl !border-gray-200 focus:!border-gray-900 focus:!ring-0"
                        :value="old('website', $profile->website)" placeholder="https://www.bedrijf.nl" />
                    <x-input-error :messages="$errors->get('website')" class="mt-2" />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Regio</label>
                    <select name="region" class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0">
                        <option value="">-- Kies regio --</option>
                        @foreach(['Amsterdam','Rotterdam','Utrecht','Den Haag','Eindhoven','Groningen','Tilburg'] as $r)
                            <option value="{{ $r }}" {{ old('region', $profile->region) === $r ? 'selected' : '' }}>{{ $r }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('region')" class="mt-2" />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Telefoonnummer</label>
                    <x-text-input name="phone" class="block w-full !rounded-xl !border-gray-200 focus:!border-gray-900 focus:!ring-0"
                        :value="old('phone', $profile->phone)" />
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
