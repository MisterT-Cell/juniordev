<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl tracking-tight">Dashboard</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-10 space-y-6">

        @if(session('success'))
            <div class="bg-[#c8f135]/20 border border-[#c8f135] text-gray-800 px-5 py-3.5 rounded-2xl text-sm font-medium">{{ session('success') }}</div>
        @endif

        @if(!auth()->user()->companyProfile?->company_name)
            <div class="bg-[#0a0a0a] text-white rounded-2xl p-6 flex justify-between items-center gap-4">
                <div>
                    <p class="font-bold mb-1">Bedrijfsprofiel nog niet ingevuld</p>
                    <p class="text-gray-400 text-sm">Vul je profiel in voordat je opdrachten plaatst.</p>
                </div>
                <a href="{{ route('company.profile.edit') }}" class="shrink-0 bg-[#c8f135] text-black font-bold text-sm px-4 py-2 rounded-full">
                    Profiel invullen
                </a>
            </div>
        @endif

        {{-- Stats --}}
        <div class="grid grid-cols-3 gap-4">
            <div class="bg-white rounded-2xl border border-gray-200 p-6 text-center">
                <div class="text-4xl font-black tracking-tight">{{ $jobs->count() }}</div>
                <div class="text-sm text-gray-500 mt-1">Opdrachten</div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6 text-center">
                <div class="text-4xl font-black tracking-tight text-yellow-600">{{ $pendingApplications }}</div>
                <div class="text-sm text-gray-500 mt-1">Openstaande reacties</div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6 text-center">
                <div class="text-4xl font-black tracking-tight">{{ $unreadMessages }}</div>
                <div class="text-sm text-gray-500 mt-1">Ongelezen berichten</div>
            </div>
        </div>

        {{-- Opdrachten --}}
        <div class="bg-white rounded-2xl border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-5">
                <h3 class="font-black text-base">Mijn opdrachten</h3>
                <a href="{{ route('company.jobs.create') }}"
                    class="bg-[#0a0a0a] text-white text-xs font-bold px-4 py-2 rounded-full hover:bg-gray-800 transition">
                    + Nieuwe opdracht
                </a>
            </div>
            @forelse($jobs as $job)
            <div class="py-4 border-b border-gray-100 last:border-0 flex flex-wrap justify-between items-center gap-3">
                <div>
                    <p class="font-semibold text-gray-900">{{ $job->title }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $job->region }} · {{ $job->type }} · {{ $job->applications->count() }} reacties</p>
                </div>
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="text-xs font-bold px-2.5 py-1 rounded-full {{ $job->status === 'open' ? 'bg-[#c8f135]/30 text-gray-700' : 'bg-gray-100 text-gray-500' }}">
                        {{ $job->status === 'open' ? 'Open' : 'Gesloten' }}
                    </span>
                    <a href="{{ route('company.jobs.edit', $job) }}" class="text-xs font-semibold text-gray-500 hover:text-gray-900 transition">Bewerken</a>
                    <a href="{{ route('company.applications.index', $job) }}" class="text-xs font-semibold text-gray-500 hover:text-gray-900 transition">Reacties</a>
                </div>
            </div>
            @empty
            <p class="text-sm text-gray-400 py-4">Nog geen opdrachten. <a href="{{ route('company.jobs.create') }}" class="underline text-gray-600">Maak je eerste opdracht</a></p>
            @endforelse
        </div>

    </div>
</x-app-layout>
