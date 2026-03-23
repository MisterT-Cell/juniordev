<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Reacties op: {{ $assignment->title }}</h2>
            <p class="text-sm text-gray-500 mt-1">{{ $applications->total() }} reactie(s)</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif

            @forelse($applications as $app)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex flex-wrap justify-between items-start gap-3 mb-4">
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ $app->student->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $app->student->email }}</p>
                        @if($app->student->studentProfile)
                            <p class="text-xs text-gray-400 mt-1">
                                {{ $app->student->studentProfile->region }} &bull;
                                {{ $app->student->studentProfile->education }} &bull;
                                Skills: {{ $app->student->studentProfile->skills }}
                            </p>
                        @endif
                    </div>
                    <div class="flex items-center gap-3">
                        @php
                            $colors = ['pending' => 'bg-yellow-100 text-yellow-700', 'accepted' => 'bg-green-100 text-green-700', 'rejected' => 'bg-red-100 text-red-700'];
                            $labels = ['pending' => 'In behandeling', 'accepted' => 'Geaccepteerd', 'rejected' => 'Afgewezen'];
                        @endphp
                        <span class="text-xs font-medium px-3 py-1 rounded-full {{ $colors[$app->status] }}">
                            {{ $labels[$app->status] }}
                        </span>
                        <span class="text-xs text-gray-400">{{ $app->created_at->format('d-m-Y') }}</span>
                    </div>
                </div>

                <div class="bg-gray-50 rounded p-4 mb-4">
                    <p class="text-sm font-medium text-gray-700 mb-1">Motivatie:</p>
                    <p class="text-sm text-gray-600 whitespace-pre-line">{{ $app->motivation }}</p>
                </div>

                <div class="flex flex-wrap gap-2">
                    @if($app->status === 'pending')
                        <form method="POST" action="{{ route('company.applications.status', $app) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="accepted">
                            <button type="submit" class="text-sm bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                Accepteren
                            </button>
                        </form>
                        <form method="POST" action="{{ route('company.applications.status', $app) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="text-sm bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                Afwijzen
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('messages.create', ['to' => $app->student->id]) }}"
                        class="text-sm bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">
                        Stuur bericht
                    </a>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center text-gray-500">
                <p>Nog geen reacties op deze opdracht.</p>
            </div>
            @endforelse

            <div class="mt-4">{{ $applications->links() }}</div>
        </div>
    </div>
</x-app-layout>
