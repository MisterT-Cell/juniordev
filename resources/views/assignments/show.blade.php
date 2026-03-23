<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $assignment->title }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">{{ session('error') }}</div>
            @endif

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <!-- Header -->
                <div class="flex flex-wrap justify-between items-start gap-4 mb-6">
                    <div>
                        <div class="flex gap-2 mb-2">
                            <span class="text-xs font-medium bg-indigo-100 text-indigo-700 px-2 py-1 rounded">{{ ucfirst($assignment->type) }}</span>
                            <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">{{ $assignment->region }}</span>
                            <span class="text-xs px-2 py-1 rounded {{ $assignment->status === 'open' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $assignment->status === 'open' ? 'Open' : 'Gesloten' }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-500">Geplaatst door: <strong>{{ $assignment->company->companyProfile->company_name ?? $assignment->company->name }}</strong></p>
                        <p class="text-xs text-gray-400 mt-1">{{ $assignment->created_at->format('d-m-Y') }}</p>
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $assignment->applications->count() }} reacties
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h3 class="font-semibold text-gray-900 mb-2">Beschrijving</h3>
                    <div class="text-gray-700 whitespace-pre-line">{{ $assignment->description }}</div>
                </div>

                @if($assignment->requirements)
                <div class="mb-6">
                    <h3 class="font-semibold text-gray-900 mb-2">Eisen</h3>
                    <div class="text-gray-700 whitespace-pre-line">{{ $assignment->requirements }}</div>
                </div>
                @endif

                <!-- Apply section -->
                @auth
                    @if(auth()->user()->isStudent())
                        @if($hasApplied)
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                <p class="text-green-700 font-medium">Je hebt al gereageerd op deze opdracht.</p>
                                <a href="{{ route('student.applications.index') }}" class="text-green-600 underline text-sm">Bekijk je reacties</a>
                            </div>
                        @elseif($assignment->status === 'open')
                            <div class="border-t border-gray-200 pt-6">
                                <h3 class="font-semibold text-gray-900 mb-4">Reageer op deze opdracht</h3>
                                <form method="POST" action="{{ route('applications.store', $assignment) }}">
                                    @csrf
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Motivatie <span class="text-gray-400">(minimaal 50 tekens)</span>
                                        </label>
                                        <textarea name="motivation" rows="5" required minlength="50"
                                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            placeholder="Vertel waarom jij de juiste kandidaat bent...">{{ old('motivation') }}</textarea>
                                        <x-input-error :messages="$errors->get('motivation')" class="mt-2" />
                                    </div>
                                    <div class="mt-4">
                                        <x-primary-button>Reactie versturen</x-primary-button>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                <p class="text-gray-600">Deze opdracht is gesloten voor nieuwe reacties.</p>
                            </div>
                        @endif
                    @endif
                @else
                    <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4">
                        <p class="text-indigo-700">
                            <a href="{{ route('login') }}" class="underline font-medium">Log in</a> of
                            <a href="{{ route('register') }}" class="underline font-medium">registreer</a> om te reageren op deze opdracht.
                        </p>
                    </div>
                @endauth
            </div>

        </div>
    </div>
</x-app-layout>
