<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl tracking-tight">Mijn Opdrachten</h2>
            <a href="{{ route('company.assignments.create') }}"
                class="bg-[#0a0a0a] text-white text-sm font-bold px-4 py-2 rounded-full hover:bg-gray-800 transition">
                + Nieuwe opdracht
            </a>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto px-6 py-10">

        @if(session('success'))
            <div class="bg-[#c8f135]/20 border border-[#c8f135] text-gray-800 px-5 py-3.5 rounded-2xl text-sm font-medium mb-6">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            @forelse($assignments as $assignment)
            <div class="p-6 border-b border-gray-100 last:border-0">
                <div class="flex flex-wrap justify-between items-start gap-3">
                    <div>
                        <h3 class="font-bold text-gray-900">{{ $assignment->title }}</h3>
                        <p class="text-sm text-gray-400 mt-0.5">
                            {{ $assignment->region }} · {{ ucfirst($assignment->type) }} ·
                            <span class="font-medium text-gray-600">{{ $assignment->applications->count() }} reacties</span>
                        </p>
                        <p class="text-xs text-gray-400 mt-1">{{ $assignment->created_at->format('d-m-Y') }}</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-xs font-bold px-2.5 py-1 rounded-full {{ $assignment->status === 'open' ? 'bg-[#c8f135]/30 text-gray-700' : 'bg-gray-100 text-gray-500' }}">
                            {{ $assignment->status === 'open' ? 'Open' : 'Gesloten' }}
                        </span>
                        <a href="{{ route('company.applications.index', $assignment) }}"
                            class="text-xs font-semibold bg-gray-100 text-gray-700 px-3 py-1.5 rounded-full hover:bg-gray-200 transition">
                            Reacties ({{ $assignment->applications->count() }})
                        </a>
                        <a href="{{ route('company.assignments.edit', $assignment) }}"
                            class="text-xs font-semibold bg-gray-900 text-white px-3 py-1.5 rounded-full hover:bg-gray-700 transition">
                            Bewerken
                        </a>
                        <form method="POST" action="{{ route('company.assignments.destroy', $assignment) }}"
                            onsubmit="return confirm('Opdracht verwijderen?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs font-semibold bg-red-50 text-red-600 px-3 py-1.5 rounded-full hover:bg-red-100 transition">
                                Verwijderen
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-16 text-center text-gray-400">
                <p class="font-semibold text-lg mb-2">Nog geen opdrachten.</p>
                <a href="{{ route('company.assignments.create') }}" class="text-sm text-indigo-600 hover:underline">Maak je eerste opdracht &rarr;</a>
            </div>
            @endforelse
        </div>

        <div class="mt-5">{{ $assignments->links() }}</div>
    </div>
</x-app-layout>
