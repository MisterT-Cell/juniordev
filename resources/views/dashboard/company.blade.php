<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Bedrijfsdashboard</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif

            @if(!auth()->user()->companyProfile?->company_name)
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <p class="text-yellow-800">Vul eerst je <a href="{{ route('company.profile.edit') }}" class="underline font-medium">bedrijfsprofiel</a> in.</p>
                </div>
            @endif

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 text-center">
                    <div class="text-3xl font-bold text-indigo-600">{{ $assignments->count() }}</div>
                    <div class="text-gray-600 text-sm mt-1">Opdrachten</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 text-center">
                    <div class="text-3xl font-bold text-yellow-500">{{ $pendingApplications }}</div>
                    <div class="text-gray-600 text-sm mt-1">Openstaande reacties</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 text-center">
                    <div class="text-3xl font-bold text-red-500">{{ $unreadMessages }}</div>
                    <div class="text-gray-600 text-sm mt-1">Ongelezen berichten</div>
                </div>
            </div>

            <!-- Opdrachten -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-semibold text-gray-900">Mijn opdrachten</h3>
                    <a href="{{ route('company.assignments.create') }}" class="bg-indigo-600 text-white text-sm px-4 py-2 rounded hover:bg-indigo-700">
                        + Nieuwe opdracht
                    </a>
                </div>
                @forelse($assignments as $assignment)
                <div class="border-b border-gray-100 py-3 last:border-0">
                    <div class="flex justify-between items-center">
                        <div>
                            <a href="{{ route('assignments.show', $assignment) }}" class="font-medium text-gray-800 hover:text-indigo-600">{{ $assignment->title }}</a>
                            <p class="text-xs text-gray-500 mt-1">{{ $assignment->region }} &bull; {{ $assignment->type }} &bull; {{ $assignment->applications->count() }} reacties</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-xs px-2 py-1 rounded {{ $assignment->status === 'open' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $assignment->status === 'open' ? 'Open' : 'Gesloten' }}
                            </span>
                            <a href="{{ route('company.assignments.edit', $assignment) }}" class="text-xs text-indigo-600 hover:underline">Bewerken</a>
                            <a href="{{ route('company.applications.index', $assignment) }}" class="text-xs text-gray-600 hover:underline">Reacties</a>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-sm">Nog geen opdrachten. <a href="{{ route('company.assignments.create') }}" class="text-indigo-600 underline">Maak je eerste opdracht aan</a></p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
