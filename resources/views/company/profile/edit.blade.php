<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.15em] text-gray-400 mb-0.5">Instellingen</p>
            <h2 class="font-black text-2xl tracking-tight">Bedrijfsprofiel</h2>
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
                <div class="w-14 h-14 bg-[#c8f135] text-black rounded-xl flex items-center justify-center font-black text-xl">
                    {{ strtoupper(substr(auth()->user()->companyProfile?->company_name ?? auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="font-bold text-gray-900">
                        {{ auth()->user()->companyProfile?->company_name ?? auth()->user()->name }}
                    </p>
                    <p class="text-xs text-gray-400">{{ auth()->user()->email }}</p>
                </div>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('company.profile.update') }}" class="p-8 space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">
                        Bedrijfsnaam <span class="text-red-400 normal-case font-normal">*</span>
                    </label>
                    <x-text-input name="company_name"
                        class="block w-full !rounded-xl !border-gray-200 focus:!border-gray-900 focus:!ring-0 text-sm"
                        :value="old('company_name', auth()->user()->companyProfile?->company_name)"
                        required placeholder="Acme Software B.V." />
                    <x-input-error :messages="$errors->get('company_name')" class="mt-1.5" />
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Over het bedrijf</label>
                    <textarea name="description" rows="4"
                        class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 resize-none"
                        placeholder="Beschrijf het bedrijf, jullie cultuur en waar jullie aan werken...">{{ old('description', auth()->user()->companyProfile?->description) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-1.5" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Website</label>
                        <x-text-input name="website"
                            class="block w-full !rounded-xl !border-gray-200 focus:!border-gray-900 focus:!ring-0 text-sm"
                            :value="old('website', auth()->user()->companyProfile?->website)"
                            placeholder="https://bedrijf.nl" />
                        <x-input-error :messages="$errors->get('website')" class="mt-1" />
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Telefoonnummer</label>
                        <x-text-input name="phone"
                            class="block w-full !rounded-xl !border-gray-200 focus:!border-gray-900 focus:!ring-0 text-sm"
                            :value="old('phone', auth()->user()->companyProfile?->phone)"
                            placeholder="+31 20 123 45 67" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Regio</label>
                    <select name="region" class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 bg-white">
                        <option value="">-- Kies regio --</option>
                        @foreach(['Amsterdam','Rotterdam','Utrecht','Den Haag','Eindhoven','Groningen','Tilburg','Remote'] as $r)
                            <option value="{{ $r }}"
                                {{ old('region', auth()->user()->companyProfile?->region) === $r ? 'selected' : '' }}>
                                {{ $r }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('region')" class="mt-1" />
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
