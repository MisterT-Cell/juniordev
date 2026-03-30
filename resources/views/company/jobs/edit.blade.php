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
            <h2 class="font-black text-xl tracking-tight truncate max-w-xs">{{ $job->title }}</h2>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto px-6 py-10">
        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">

            <div class="px-8 py-5 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                <p class="text-xs font-bold uppercase tracking-widest text-gray-500">Vacature bewerken</p>
                <span class="text-xs font-bold px-2.5 py-1 rounded-full {{ $job->status === 'open' ? 'bg-[#c8f135]/30 text-gray-700' : 'bg-gray-100 text-gray-500' }}">
                    {{ $job->status === 'open' ? '● Open' : '● Gesloten' }}
                </span>
            </div>

            <form method="POST" action="{{ route('company.jobs.update', $job) }}" class="p-8 space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Functietitel *</label>
                    <x-text-input name="title"
                        class="block w-full !rounded-xl !border-gray-200 focus:!border-gray-900 focus:!ring-0 text-sm"
                        :value="old('title', $job->title)" required />
                    <x-input-error :messages="$errors->get('title')" class="mt-1.5" />
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Beschrijving *</label>
                    <textarea name="description" rows="6" required
                        class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 resize-none">{{ old('description', $job->description) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-1.5" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Type *</label>
                        <select name="type" required class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 bg-white">
                            @foreach(['stage','bijbaan','freelance','parttime','fulltime'] as $t)
                                <option value="{{ $t }}" {{ old('type', $job->type) === $t ? 'selected' : '' }}>
                                    {{ ucfirst($t) }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-1.5" />
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Regio *</label>
                        <select name="region" required class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 bg-white">
                            @foreach(['Amsterdam','Rotterdam','Utrecht','Den Haag','Eindhoven','Groningen','Tilburg','Remote'] as $r)
                                <option value="{{ $r }}" {{ old('region', $job->region) === $r ? 'selected' : '' }}>
                                    {{ $r }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('region')" class="mt-1.5" />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Vereisten</label>
                    <textarea name="requirements" rows="4"
                        class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 resize-none">{{ old('requirements', $job->requirements) }}</textarea>
                    <x-input-error :messages="$errors->get('requirements')" class="mt-1.5" />
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">Status</label>
                    <div class="flex gap-3">
                        @foreach(['open' => 'Open voor reacties', 'closed' => 'Gesloten'] as $val => $label)
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="status" value="{{ $val }}"
                                {{ old('status', $job->status) === $val ? 'checked' : '' }}
                                class="border-gray-300 text-gray-900 focus:ring-gray-900">
                            <span class="text-sm font-medium text-gray-700">{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                    <a href="{{ route('company.jobs.index') }}" class="text-sm text-gray-400 hover:text-gray-700 transition">
                        Annuleren
                    </a>
                    <button type="submit"
                        class="bg-[#0a0a0a] text-white font-bold px-6 py-2.5 rounded-full hover:bg-gray-800 transition text-sm">
                        Wijzigingen opslaan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
