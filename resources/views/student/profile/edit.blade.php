<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mijn Profiel</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('student.profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="space-y-5">
                        <div>
                            <x-input-label for="bio" value="Over mij" />
                            <textarea id="bio" name="bio" rows="4"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('bio', $profile->bio) }}</textarea>
                            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="skills" value="Skills (bijv. PHP, Laravel, JavaScript)" />
                            <x-text-input id="skills" name="skills" class="mt-1 block w-full"
                                :value="old('skills', $profile->skills)" placeholder="PHP, Laravel, MySQL, JavaScript" />
                            <x-input-error :messages="$errors->get('skills')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="education" value="Opleiding" />
                            <x-text-input id="education" name="education" class="mt-1 block w-full"
                                :value="old('education', $profile->education)" placeholder="HBO Informatica" />
                            <x-input-error :messages="$errors->get('education')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="region" value="Regio" />
                            <select id="region" name="region"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">-- Kies regio --</option>
                                @foreach(['Amsterdam','Rotterdam','Utrecht','Den Haag','Eindhoven','Groningen','Tilburg','Remote'] as $r)
                                    <option value="{{ $r }}" {{ old('region', $profile->region) === $r ? 'selected' : '' }}>{{ $r }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('region')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="phone" value="Telefoonnummer" />
                            <x-text-input id="phone" name="phone" class="mt-1 block w-full"
                                :value="old('phone', $profile->phone)" placeholder="+31 6 12345678" />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-primary-button>Profiel opslaan</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
