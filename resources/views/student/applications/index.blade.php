<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mijn Reacties</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                @forelse($applications as $app)
                <div class="p-5 border-b border-gray-100 last:border-0">
                    <div class="flex flex-wrap justify-between items-start gap-3">
                        <div class="flex-1">
                            <a href="{{ route('assignments.show', $app->assignment) }}"
                                class="font-semibold text-gray-900 hover:text-indigo-600">
                                {{ $app->assignment->title }}
                            </a>
                            <p class="text-sm text-gray-500 mt-0.5">
                                {{ $app->assignment->company->companyProfile->company_name ?? $app->assignment->company->name }}
                                &bull; {{ $app->assignment->region }} &bull; {{ ucfirst($app->assignment->type) }}
                            </p>
                            <p class="text-xs text-gray-400 mt-1">Verstuurd: {{ $app->created_at->format('d-m-Y') }}</p>
                        </div>
                        @php
                            $colors = ['pending' => 'bg-yellow-100 text-yellow-700', 'accepted' => 'bg-green-100 text-green-700', 'rejected' => 'bg-red-100 text-red-700'];
                            $labels = ['pending' => 'In behandeling', 'accepted' => 'Geaccepteerd', 'rejected' => 'Afgewezen'];
                        @endphp
                        <span class="text-sm font-medium px-3 py-1 rounded-full {{ $colors[$app->status] }}">
                            {{ $labels[$app->status] }}
                        </span>
                    </div>
                    <div class="mt-3 bg-gray-50 rounded p-3 text-sm text-gray-600">
                        <span class="font-medium">Motivatie:</span> {{ Str::limit($app->motivation, 150) }}
                    </div>
                </div>
                @empty
                <div class="p-12 text-center text-gray-500">
                    <p class="text-lg mb-2">Nog geen reacties verstuurd.</p>
                    <a href="{{ route('assignments.index') }}" class="text-indigo-600 hover:underline">Bekijk opdrachten</a>
                </div>
                @endforelse
            </div>

            <div class="mt-4">{{ $applications->links() }}</div>
        </div>
    </div>
</x-app-layout>
