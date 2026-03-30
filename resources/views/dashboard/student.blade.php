<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl tracking-tight">Dashboard</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-10 space-y-6">

        @if(session('success'))
            <div class="bg-[#c8f135]/20 border border-[#c8f135] text-gray-800 px-5 py-3.5 rounded-2xl text-sm font-medium">{{ session('success') }}</div>
        @endif

        {{-- Welkom --}}
        @if(!auth()->user()->studentProfile?->bio)
            <div class="bg-[#0a0a0a] text-white rounded-2xl p-6 flex justify-between items-center gap-4">
                <div>
                    <p class="font-bold mb-1">Profiel nog niet ingevuld</p>
                    <p class="text-gray-400 text-sm">Vul je profiel in zodat bedrijven je kunnen vinden.</p>
                </div>
                <a href="{{ route('student.profile.edit') }}" class="shrink-0 bg-[#c8f135] text-black font-bold text-sm px-4 py-2 rounded-full hover:bg-[#d4f54e] transition">
                    Profiel invullen
                </a>
            </div>
        @endif

        {{-- Stats --}}
        <div class="grid grid-cols-3 gap-4">
            <div class="bg-white rounded-2xl border border-gray-200 p-6 text-center">
                <div class="text-4xl font-black tracking-tight text-gray-900">{{ $applications->count() }}</div>
                <div class="text-sm text-gray-500 mt-1">Reacties verstuurd</div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6 text-center">
                <div class="text-4xl font-black tracking-tight text-[#5a7a00]">{{ $applications->where('status','accepted')->count() }}</div>
                <div class="text-sm text-gray-500 mt-1">Geaccepteerd</div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6 text-center">
                <div class="text-4xl font-black tracking-tight text-gray-900">{{ $unreadMessages }}</div>
                <div class="text-sm text-gray-500 mt-1">Ongelezen berichten</div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            {{-- Reacties --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="font-black text-base">Mijn reacties</h3>
                    <a href="{{ route('student.applications.index') }}" class="text-xs font-semibold text-gray-400 hover:text-gray-700 transition">Alle bekijken &rarr;</a>
                </div>
                @forelse($applications as $app)
                <div class="py-3.5 border-b border-gray-100 last:border-0 flex justify-between items-start gap-3">
                    <div>
                        <p class="font-semibold text-sm text-gray-900">{{ $app->job->title }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $app->job->company->companyProfile->company_name ?? $app->job->company->name }}</p>
                    </div>
                    @php $colors = ['pending'=>'bg-yellow-100 text-yellow-700','accepted'=>'bg-[#c8f135]/30 text-gray-700','rejected'=>'bg-red-100 text-red-600']; @endphp
                    <span class="text-xs font-bold px-2.5 py-1 rounded-full shrink-0 {{ $colors[$app->status] }}">
                        {{ ['pending'=>'In behandeling','accepted'=>'Geaccepteerd','rejected'=>'Afgewezen'][$app->status] }}
                    </span>
                </div>
                @empty
                <p class="text-sm text-gray-400 py-4">Nog geen reacties. <a href="{{ route('jobs.index') }}" class="underline text-gray-600">Bekijk vacatures</a></p>
                @endforelse
            </div>

            {{-- Nieuwe vacatures --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="font-black text-base">Nieuwe vacatures</h3>
                    <a href="{{ route('jobs.index') }}" class="text-xs font-semibold text-gray-400 hover:text-gray-700 transition">Alle bekijken &rarr;</a>
                </div>
                @foreach($latestJobs as $job)
                <a href="{{ route('jobs.show', $job) }}" class="py-3.5 border-b border-gray-100 last:border-0 flex justify-between items-start gap-3 group">
                    <div>
                        <p class="font-semibold text-sm text-gray-900 group-hover:text-indigo-600 transition">{{ $job->title }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $job->region }} · {{ $job->type }}</p>
                    </div>
                    <span class="text-gray-300 group-hover:text-indigo-600 transition shrink-0">&rarr;</span>
                </a>
                @endforeach
            </div>
        </div>

    </div>
</x-app-layout>
