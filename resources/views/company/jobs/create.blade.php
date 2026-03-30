<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl tracking-tight">Nieuwe Vacature</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto px-6 py-10">
        <div class="bg-white rounded-2xl border border-gray-200 p-8">
            <form method="POST" action="{{ route('company.jobs.store') }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Titel *</label>
                    <x-text-input name="title" class="block w-full !rounded-xl !border-gray-200 focus:!border-gray-900 focus:!ring-0"
                        :value="old('title')" required placeholder="Junior PHP Developer gezocht" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Beschrijving *</label>
                    <textarea name="description" rows="6" required
                        class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 resize-none"
                        placeholder="Beschrijf de vacature uitgebreid...">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Type *</label>
                        <select name="type" required class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0">
                            <option value="">-- Kies type --</option>
                            @foreach(['stage','bijbaan','freelance','parttime','fulltime'] as $t)
                                <option value="{{ $t }}" {{ old('type') === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Regio *</label>
                        <select name="region" required class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0">
                            <option value="">-- Kies regio --</option>
                            @foreach(['Amsterdam','Rotterdam','Utrecht','Den Haag','Eindhoven','Groningen','Tilburg','Remote'] as $r)
                                <option value="{{ $r }}" {{ old('region') === $r ? 'selected' : '' }}>{{ $r }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('region')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Vereisten</label>
                    <textarea name="requirements" rows="4"
                        class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 resize-none"
                        placeholder="Welke kennis of skills zijn gewenst?">{{ old('requirements') }}</textarea>
                    <x-input-error :messages="$errors->get('requirements')" class="mt-2" />
                </div>

                <div class="flex justify-between items-center pt-2">
                    <a href="{{ route('company.jobs.index') }}" class="text-sm text-gray-400 hover:text-gray-700 transition">Annuleren</a>
                    <button type="submit" class="bg-[#0a0a0a] text-white font-bold px-6 py-3 rounded-full hover:bg-gray-800 transition text-sm">
                        Vacature plaatsen
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
