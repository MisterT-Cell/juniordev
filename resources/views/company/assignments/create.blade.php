<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nieuwe Opdracht</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <form method="POST" action="{{ route('company.assignments.store') }}">
                    @csrf

                    <div class="space-y-5">
                        <div>
                            <x-input-label for="title" value="Titel *" />
                            <x-text-input id="title" name="title" class="mt-1 block w-full"
                                :value="old('title')" required placeholder="Junior PHP Developer gezocht" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Beschrijving *" />
                            <textarea id="description" name="description" rows="6" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Beschrijf de opdracht uitgebreid...">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="type" value="Type *" />
                                <select id="type" name="type" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">-- Kies type --</option>
                                    @foreach(['stage','bijbaan','freelance','parttime','fulltime'] as $t)
                                        <option value="{{ $t }}" {{ old('type') === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="region" value="Regio *" />
                                <select id="region" name="region" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">-- Kies regio --</option>
                                    @foreach(['Amsterdam','Rotterdam','Utrecht','Den Haag','Eindhoven','Groningen','Tilburg','Remote'] as $r)
                                        <option value="{{ $r }}" {{ old('region') === $r ? 'selected' : '' }}>{{ $r }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('region')" class="mt-2" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="requirements" value="Vereisten" />
                            <textarea id="requirements" name="requirements" rows="4"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Welke kennis/skills zijn gewenst?">{{ old('requirements') }}</textarea>
                            <x-input-error :messages="$errors->get('requirements')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-6 flex justify-between">
                        <a href="{{ route('company.assignments.index') }}" class="text-gray-600 hover:underline text-sm self-center">Annuleren</a>
                        <x-primary-button>Opdracht plaatsen</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
