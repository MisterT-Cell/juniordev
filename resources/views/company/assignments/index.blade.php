<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mijn Opdrachten</h2>
            <a href="{{ route('company.assignments.create') }}" class="bg-indigo-600 text-white text-sm px-4 py-2 rounded hover:bg-indigo-700">
                + Nieuwe opdracht
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                @forelse($assignments as $assignment)
                <div class="p-5 border-b border-gray-100 last:border-0">
                    <div class="flex flex-wrap justify-between items-start gap-3">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">{{ $assignment->title }}</h3>
                            <p class="text-sm text-gray-500 mt-0.5">{{ $assignment->region }} &bull; {{ ucfirst($assignment->type) }}</p>
                            <p class="text-xs text-gray-400 mt-1">
                                {{ $assignment->applications->count() }} reactie(s) &bull;
                                Aangemaakt: {{ $assignment->created_at->format('d-m-Y') }}
                            </p>
                        </div>
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-xs px-2 py-1 rounded {{ $assignment->status === 'open' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $assignment->status === 'open' ? 'Open' : 'Gesloten' }}
                            </span>
                            <a href="{{ route('company.applications.index', $assignment) }}"
                                class="text-xs bg-gray-100 text-gray-700 px-3 py-1.5 rounded hover:bg-gray-200">
                                Reacties ({{ $assignment->applications->count() }})
                            </a>
                            <a href="{{ route('company.assignments.edit', $assignment) }}"
                                class="text-xs bg-indigo-100 text-indigo-700 px-3 py-1.5 rounded hover:bg-indigo-200">
                                Bewerken
                            </a>
                            <form method="POST" action="{{ route('company.assignments.destroy', $assignment) }}"
                                onsubmit="return confirm('Weet je zeker dat je deze opdracht wilt verwijderen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs bg-red-100 text-red-700 px-3 py-1.5 rounded hover:bg-red-200">
                                    Verwijderen
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-12 text-center text-gray-500">
                    <p class="text-lg mb-2">Nog geen opdrachten aangemaakt.</p>
                    <a href="{{ route('company.assignments.create') }}" class="text-indigo-600 hover:underline">Maak je eerste opdracht</a>
                </div>
                @endforelse
            </div>

            <div class="mt-4">{{ $assignments->links() }}</div>
        </div>
    </div>
</x-app-layout>
