<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.15em] text-gray-400 mb-0.5">Welkom terug</p>
                <h2 class="font-black text-2xl tracking-tight">
                    {{ auth()->user()->companyProfile->company_name ?? auth()->user()->name }}
                </h2>
            </div>
            <a href="{{ route('company.jobs.create') }}"
                class="bg-[#0a0a0a] text-white text-sm font-bold px-5 py-2.5 rounded-full hover:bg-gray-800 transition inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                Nieuwe vacature
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
        @if(!auth()->user()->companyProfile?->company_name)
            <div class="bg-[#0a0a0a] text-white rounded-2xl p-6 flex justify-between items-center gap-4">
                <div>
                    <p class="font-bold mb-1">Bedrijfsprofiel nog niet ingevuld</p>
                    <p class="text-gray-400 text-sm">Vul je profiel in voordat je vacatures plaatst.</p>
                </div>
                <a href="{{ route('company.profile.edit') }}"
                    class="shrink-0 bg-[#c8f135] text-black font-bold text-sm px-5 py-2.5 rounded-full hover:bg-[#d4f54e] transition">
                    Profiel invullen
                </a>
            </div>
        @endif

        {{-- Stats --}}
        <div class="grid grid-cols-3 gap-4">
            @foreach([
                [$jobs->count(),         'Geplaatste vacatures',    '#0a0a0a'],
                [$pendingApplications,    'Openstaande reacties',    '#b45309'],
                [$unreadMessages,         'Ongelezen berichten',     '#0a0a0a'],
            ] as [$val, $label, $color])
            <div class="bg-white rounded-2xl border border-gray-200 p-6 text-center">
                <div class="font-black text-4xl tracking-tight leading-none mb-2"
                    style="color: {{ $color }}">{{ $val }}</div>
                <div class="text-xs text-gray-500 uppercase tracking-widest">{{ $label }}</div>
            </div>
            @endforeach
        </div>

        {{-- Vacatures --}}
        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100">
                <h3 class="font-black text-sm uppercase tracking-widest">Mijn vacatures</h3>
                <a href="{{ route('company.jobs.index') }}"
                    class="text-xs font-semibold text-gray-400 hover:text-gray-700 transition">
                    Alle bekijken &rarr;
                </a>
            </div>

            @forelse($jobs as $job)
            <div class="px-6 py-4 border-b border-gray-50 last:border-0 flex flex-wrap justify-between items-center gap-3">
                <div class="flex items-center gap-3 min-w-0">
                    <span class="w-2 h-2 rounded-full flex-shrink-0 {{ $job->status === 'open' ? 'bg-[#c8f135]' : 'bg-gray-300' }}"></span>
                    <div class="min-w-0">
                        <p class="font-semibold text-sm text-gray-900 truncate">{{ $job->title }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">
                            {{ $job->region }} · {{ ucfirst($job->type) }} ·
                            <span class="font-medium text-gray-600">{{ $job->applications->count() }} reacties</span>
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-2 flex-shrink-0">
                    <a href="{{ route('company.applications.index', $job) }}"
                        class="text-xs font-semibold bg-gray-100 text-gray-600 px-3 py-1.5 rounded-full hover:bg-gray-200 transition">
                        Reacties
                    </a>
                    <a href="{{ route('company.jobs.edit', $job) }}"
                        class="text-xs font-semibold bg-[#0a0a0a] text-white px-3 py-1.5 rounded-full hover:bg-gray-800 transition">
                        Bewerken
                    </a>
                </div>
            </div>
            @empty
            <div class="px-6 py-10 text-center">
                <p class="text-sm text-gray-400 mb-3">Nog geen vacatures geplaatst.</p>
                <a href="{{ route('company.jobs.create') }}"
                    class="inline-block text-xs font-bold bg-[#c8f135] text-black px-5 py-2.5 rounded-full hover:bg-[#d4f54e] transition">
                    Eerste vacature plaatsen
                </a>
            </div>
            @endforelse
        </div>

    </div>
</x-app-layout>
