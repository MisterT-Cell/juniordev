<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.15em] text-gray-400 mb-0.5">Welkom terug</p>
                <h2 class="font-black text-2xl tracking-tight">{{ auth()->user()->name }}</h2>
            </div>
            <a href="{{ route('jobs.index') }}"
                class="bg-[#0a0a0a] text-white text-sm font-bold px-5 py-2.5 rounded-full hover:bg-gray-800 transition hidden md:inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Zoek vacatures
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-10 space-y-6">

        @if(session('success'))
            <div class="bg-[#c8f135]/20 border border-[#c8f135] text-gray-800 px-5 py-3.5 rounded-2xl text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        {{-- Profile completion banner --}}
        @if(!auth()->user()->studentProfile?->bio)
            <div class="bg-[#0a0a0a] text-white rounded-2xl p-6 flex justify-between items-center gap-4">
                <div>
                    <p class="font-bold mb-1">Profiel nog niet ingevuld</p>
                    <p class="text-gray-400 text-sm">Vul je profiel in zodat bedrijven je kunnen vinden.</p>
                </div>
                <a href="{{ route('student.profile.edit') }}"
                    class="shrink-0 bg-[#c8f135] text-black font-bold text-sm px-5 py-2.5 rounded-full hover:bg-[#d4f54e] transition">
                    Profiel invullen
                </a>
            </div>
        @endif

        {{-- Stats --}}
        <div class="grid grid-cols-3 gap-4">
            @foreach([
                [$applications->count(),                                      'Reacties verstuurd', '#0a0a0a'],
                [$applications->where('status','accepted')->count(),           'Geaccepteerd',       '#5a7a00'],
                [$unreadMessages,                                              'Ongelezen berichten','#0a0a0a'],
            ] as [$val, $label, $color])
            <div class="bg-white rounded-2xl border border-gray-200 p-6 text-center">
                <div class="font-black text-4xl tracking-tight leading-none mb-2"
                    style="color: {{ $color }}">{{ $val }}</div>
                <div class="text-xs text-gray-500 uppercase tracking-widest">{{ $label }}</div>
            </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- Mijn reacties --}}
            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
                <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100">
                    <h3 class="font-black text-sm uppercase tracking-widest">Mijn reacties</h3>
                    <a href="{{ route('student.applications.index') }}"
                        class="text-xs font-semibold text-gray-400 hover:text-gray-700 transition">
                        Alle bekijken &rarr;
                    </a>
                </div>
                @forelse($applications as $app)
                @php
                    $statusMap   = ['pending'=>'In behandeling','accepted'=>'Geaccepteerd','rejected'=>'Afgewezen'];
                    $statusColor = ['pending'=>'bg-yellow-100 text-yellow-700','accepted'=>'bg-[#c8f135]/30 text-gray-700','rejected'=>'bg-red-100 text-red-600'];
                @endphp
                <div class="px-6 py-4 border-b border-gray-50 last:border-0 flex justify-between items-start gap-3">
                    <div class="min-w-0">
                        <p class="font-semibold text-sm text-gray-900 truncate">{{ $app->job->title }}</p>
                        <p class="text-xs text-gray-400 mt-0.5 truncate">
                            {{ $app->job->company->companyProfile->company_name ?? $app->job->company->name }}
                        </p>
                    </div>
                    <span class="text-xs font-bold px-2.5 py-1 rounded-full shrink-0 {{ $statusColor[$app->status] }}">
                        {{ $statusMap[$app->status] }}
                    </span>
                </div>
                @empty
                <div class="px-6 py-8 text-center">
                    <p class="text-sm text-gray-400 mb-3">Nog geen reacties verstuurd.</p>
                    <a href="{{ route('jobs.index') }}"
                        class="inline-block text-xs font-bold bg-[#0a0a0a] text-white px-4 py-2 rounded-full hover:bg-gray-800 transition">
                        Zoek vacatures
                    </a>
                </div>
                @endforelse
            </div>

            {{-- Nieuwe vacatures --}}
            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
                <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100">
                    <h3 class="font-black text-sm uppercase tracking-widest">Nieuwe vacatures</h3>
                    <a href="{{ route('jobs.index') }}"
                        class="text-xs font-semibold text-gray-400 hover:text-gray-700 transition">
                        Alle bekijken &rarr;
                    </a>
                </div>
                @foreach($latestJobs as $job)
                @php $companyName = $job->company->companyProfile->company_name ?? $job->company->name; @endphp
                <a href="{{ route('jobs.show', $job) }}"
                    class="px-6 py-4 border-b border-gray-50 last:border-0 flex justify-between items-start gap-3 group hover:bg-gray-50 transition">
                    <div class="flex items-start gap-3 min-w-0">
                        <div class="w-8 h-8 bg-gray-100 text-gray-600 rounded-lg flex items-center justify-center font-black text-xs flex-shrink-0 group-hover:bg-[#0a0a0a] group-hover:text-white transition">
                            {{ strtoupper(substr($companyName, 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <p class="font-semibold text-sm text-gray-900 truncate">{{ $job->title }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $job->region }} · {{ $job->type }}</p>
                        </div>
                    </div>
                    <span class="text-gray-300 group-hover:text-gray-700 transition shrink-0 text-sm font-bold">&rarr;</span>
                </a>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
