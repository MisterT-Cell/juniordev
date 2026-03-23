<x-app-layout>
    <x-slot name="header">
        <div>
            <a href="{{ route('company.assignments.index') }}" class="text-sm text-gray-400 hover:text-gray-700">&larr; Terug naar opdrachten</a>
            <h2 class="font-black text-2xl tracking-tight mt-1">Reacties: {{ $assignment->title }}</h2>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-6 py-10 space-y-4">

        @if(session('success'))
            <div class="bg-[#c8f135]/20 border border-[#c8f135] text-gray-800 px-5 py-3.5 rounded-2xl text-sm font-medium">{{ session('success') }}</div>
        @endif

        @forelse($applications as $app)
        <div class="bg-white rounded-2xl border border-gray-200 p-6">
            <div class="flex flex-wrap justify-between items-start gap-3 mb-4">
                <div>
                    <h3 class="font-bold text-gray-900">{{ $app->student->name }}</h3>
                    <p class="text-sm text-gray-400 mt-0.5">{{ $app->student->email }}</p>
                    @if($app->student->studentProfile)
                        <p class="text-xs text-gray-400 mt-1">
                            {{ $app->student->studentProfile->region }}
                            @if($app->student->studentProfile->education) · {{ $app->student->studentProfile->education }} @endif
                            @if($app->student->studentProfile->skills) · {{ $app->student->studentProfile->skills }} @endif
                        </p>
                    @endif
                </div>
                <div class="flex items-center gap-3">
                    @php $colors = ['pending'=>'bg-yellow-100 text-yellow-700','accepted'=>'bg-[#c8f135]/30 text-gray-700','rejected'=>'bg-red-100 text-red-600']; @endphp
                    <span class="text-xs font-bold px-3 py-1.5 rounded-full {{ $colors[$app->status] }}">
                        {{ ['pending'=>'In behandeling','accepted'=>'Geaccepteerd','rejected'=>'Afgewezen'][$app->status] }}
                    </span>
                    <span class="text-xs text-gray-400">{{ $app->created_at->format('d-m-Y') }}</span>
                </div>
            </div>

            <div class="bg-gray-50 rounded-xl p-4 mb-4 text-sm text-gray-600 leading-relaxed">
                <span class="font-semibold text-gray-700 block mb-1">Motivatie</span>
                {{ $app->motivation }}
            </div>

            <div class="flex flex-wrap gap-2">
                @if($app->status === 'pending')
                    <form method="POST" action="{{ route('company.applications.status', $app) }}">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="accepted">
                        <button type="submit" class="text-xs font-bold bg-[#c8f135] text-black px-4 py-2 rounded-full hover:bg-[#d4f54e] transition">
                            Accepteren
                        </button>
                    </form>
                    <form method="POST" action="{{ route('company.applications.status', $app) }}">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" class="text-xs font-bold bg-red-50 text-red-600 px-4 py-2 rounded-full hover:bg-red-100 transition">
                            Afwijzen
                        </button>
                    </form>
                @endif
                <a href="{{ route('messages.create', ['to' => $app->student->id]) }}"
                    class="text-xs font-bold bg-gray-100 text-gray-700 px-4 py-2 rounded-full hover:bg-gray-200 transition">
                    Stuur bericht
                </a>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-2xl border border-gray-200 p-16 text-center text-gray-400">
            <p class="font-semibold text-lg">Nog geen reacties op deze opdracht.</p>
        </div>
        @endforelse

        <div class="mt-2">{{ $applications->links() }}</div>
    </div>
</x-app-layout>
