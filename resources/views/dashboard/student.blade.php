<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif

            <!-- Welkom -->
            <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-indigo-900">Welkom terug, {{ auth()->user()->name }}!</h3>
                @if(!auth()->user()->studentProfile?->bio)
                    <p class="text-indigo-700 mt-1">Vul je <a href="{{ route('student.profile.edit') }}" class="underline font-medium">profiel in</a> zodat bedrijven je kunnen vinden.</p>
                @endif
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 text-center">
                    <div class="text-3xl font-bold text-indigo-600">{{ $applications->count() }}</div>
                    <div class="text-gray-600 text-sm mt-1">Reacties verstuurd</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 text-center">
                    <div class="text-3xl font-bold text-green-600">{{ $applications->where('status','accepted')->count() }}</div>
                    <div class="text-gray-600 text-sm mt-1">Geaccepteerd</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 text-center">
                    <div class="text-3xl font-bold text-red-500">{{ $unreadMessages }}</div>
                    <div class="text-gray-600 text-sm mt-1">Ongelezen berichten</div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Mijn reacties -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold text-gray-900">Mijn reacties</h3>
                        <a href="{{ route('student.applications.index') }}" class="text-sm text-indigo-600 hover:underline">Alle bekijken</a>
                    </div>
                    @forelse($applications as $app)
                    <div class="border-b border-gray-100 py-3 last:border-0">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium text-gray-800 text-sm">{{ $app->assignment->title }}</p>
                                <p class="text-xs text-gray-500">{{ $app->assignment->company->companyProfile->company_name ?? $app->assignment->company->name }}</p>
                            </div>
                            @php
                                $colors = ['pending' => 'bg-yellow-100 text-yellow-700', 'accepted' => 'bg-green-100 text-green-700', 'rejected' => 'bg-red-100 text-red-700'];
                                $labels = ['pending' => 'In behandeling', 'accepted' => 'Geaccepteerd', 'rejected' => 'Afgewezen'];
                            @endphp
                            <span class="text-xs px-2 py-1 rounded {{ $colors[$app->status] }}">{{ $labels[$app->status] }}</span>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 text-sm">Nog geen reacties. <a href="{{ route('assignments.index') }}" class="text-indigo-600 underline">Bekijk opdrachten</a></p>
                    @endforelse
                </div>

                <!-- Nieuwe opdrachten -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold text-gray-900">Nieuwe opdrachten</h3>
                        <a href="{{ route('assignments.index') }}" class="text-sm text-indigo-600 hover:underline">Alle bekijken</a>
                    </div>
                    @foreach($latestAssignments as $assignment)
                    <div class="border-b border-gray-100 py-3 last:border-0">
                        <div class="flex justify-between items-start">
                            <div>
                                <a href="{{ route('assignments.show', $assignment) }}" class="font-medium text-gray-800 text-sm hover:text-indigo-600">{{ $assignment->title }}</a>
                                <p class="text-xs text-gray-500">{{ $assignment->region }} &bull; {{ $assignment->type }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
