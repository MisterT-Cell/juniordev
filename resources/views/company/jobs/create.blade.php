<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('company.jobs.index') }}"
                class="inline-flex items-center gap-1.5 text-sm text-gray-400 hover:text-gray-700 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Mijn vacatures
            </a>
            <span class="text-gray-300">/</span>
            <h2 class="font-black text-2xl tracking-tight">Nieuwe vacature</h2>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto px-6 py-10">
        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">

            <div class="px-8 py-5 border-b border-gray-100 bg-gray-50">
                <p class="text-xs font-bold uppercase tracking-widest text-gray-500">
                    Vul alle verplichte velden in om de vacature te publiceren
                </p>
            </div>

            <form method="POST" action="{{ route('company.jobs.store') }}" class="p-8 space-y-6">
                @csrf

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">
                        Functietitel <span class="text-red-400 normal-case font-normal">*</span>
                    </label>
                    <x-text-input name="title"
                        class="block w-full !rounded-xl !border-gray-200 focus:!border-gray-900 focus:!ring-0 text-sm"
                        :value="old('title')" required placeholder="Junior PHP Developer" />
                    <x-input-error :messages="$errors->get('title')" class="mt-1.5" />
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">
                        Beschrijving <span class="text-red-400 normal-case font-normal">*</span>
                    </label>
                    <textarea name="description" rows="6" required
                        class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 resize-none"
                        placeholder="Beschrijf de functie, het team en wat we van de kandidaat verwachten...">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-1.5" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">
                            Type <span class="text-red-400 normal-case font-normal">*</span>
                        </label>
                        <select name="type" required class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 bg-white">
                            <option value="">-- Kies type --</option>
                            @foreach(['stage','bijbaan','freelance','parttime','fulltime'] as $t)
                                <option value="{{ $t }}" {{ old('type') === $t ? 'selected' : '' }}>
                                    {{ ucfirst($t) }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-1.5" />
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">
                            Regio <span class="text-red-400 normal-case font-normal">*</span>
                        </label>
                        <select name="region" required class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 bg-white">
                            <option value="">-- Kies regio --</option>
                            @foreach(['Amsterdam','Rotterdam','Utrecht','Den Haag','Eindhoven','Groningen','Tilburg','Remote'] as $r)
                                <option value="{{ $r }}" {{ old('region') === $r ? 'selected' : '' }}>{{ $r }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('region')" class="mt-1.5" />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Vereisten</label>
                    <textarea name="requirements" rows="4"
                        class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 resize-none"
                        placeholder="Lijst de gewenste skills of ervaring op, bijv: PHP, Git, Laravel...">{{ old('requirements') }}</textarea>
                    <x-input-error :messages="$errors->get('requirements')" class="mt-1.5" />
                </div>

                <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                    <a href="{{ route('company.jobs.index') }}" class="text-sm text-gray-400 hover:text-gray-700 transition">
                        Annuleren
                    </a>
                    <button type="submit"
                        class="bg-[#0a0a0a] text-white font-bold px-6 py-2.5 rounded-full hover:bg-gray-800 transition text-sm inline-flex items-center gap-2">
                        Vacature publiceren
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
