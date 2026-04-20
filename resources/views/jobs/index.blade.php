<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.15em] text-gray-400 mb-1">Alle vacatures</p>
                <h2 class="font-black text-2xl tracking-tight flex items-center gap-2">
                    <span class="w-2 h-2 bg-brand rounded-full animate-pulse"></span>
                    {{ $jobs->total() }} {{ $jobs->total() === 1 ? 'vacature' : 'vacatures' }} gevonden
                </h2>
            </div>
            @auth
                @if(auth()->user()->isCompany())
                    <a href="{{ route('company.jobs.create') }}"
                        class="self-start bg-dark text-white text-sm font-bold px-5 py-2.5 rounded-full hover:bg-gray-800 transition inline-flex items-center gap-2 press">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                        </svg>
                        Nieuwe vacature
                    </a>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-10">

        {{-- FILTERS --}}
        <form method="GET" class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4 mb-6 flex flex-wrap gap-3 items-end">
            <div class="flex-1 min-w-52">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Zoeken</label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Zoek op titel of bedrijf..."
                        class="w-full pl-9 border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-2 focus:ring-brand/20">
                </div>
            </div>
            <div class="min-w-44">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Regio</label>
                <select name="region" class="w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-2 focus:ring-brand/20 bg-white">
                    <option value="">Alle regio's</option>
                    @foreach($regions as $region)
                        <option value="{{ $region }}" {{ request('region') === $region ? 'selected' : '' }}>{{ $region }}</option>
                    @endforeach
                </select>
            </div>
            <div class="min-w-40">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Type</label>
                <select name="type" class="w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-2 focus:ring-brand/20 bg-white">
                    <option value="">Alle types</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}" {{ request('type') === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center gap-2">
                <button type="submit"
                    class="bg-brand text-black text-sm font-bold px-5 py-2.5 rounded-full hover:bg-brand-hover hover-glow transition press">
                    Zoeken
                </button>
                @if(request('search') || request('region') || request('type'))
                    <a href="{{ route('jobs.index') }}"
                        class="text-sm text-gray-400 hover:text-gray-700 transition px-3 py-2.5 inline-flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Wissen
                    </a>
                @endif
            </div>
        </form>

        {{-- Active filter pills --}}
        @if(request('search') || request('region') || request('type'))
            <div class="flex flex-wrap gap-2 mb-6">
                @if(request('search'))
                    <a href="{{ route('jobs.index', array_filter([...request()->query(), 'search' => null])) }}"
                        class="inline-flex items-center gap-1.5 bg-brand/15 text-gray-700 text-xs font-semibold px-3 py-1.5 rounded-full hover:bg-brand/25 transition">
                        "{{ request('search') }}"
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </a>
                @endif
                @if(request('region'))
                    <a href="{{ route('jobs.index', array_filter([...request()->query(), 'region' => null])) }}"
                        class="inline-flex items-center gap-1.5 bg-brand/15 text-gray-700 text-xs font-semibold px-3 py-1.5 rounded-full hover:bg-brand/25 transition">
                        {{ request('region') }}
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </a>
                @endif
                @if(request('type'))
                    <a href="{{ route('jobs.index', array_filter([...request()->query(), 'type' => null])) }}"
                        class="inline-flex items-center gap-1.5 bg-brand/15 text-gray-700 text-xs font-semibold px-3 py-1.5 rounded-full hover:bg-brand/25 transition">
                        {{ ucfirst(request('type')) }}
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </a>
                @endif
            </div>
        @endif

        {{-- RESULTS --}}
        @if($jobs->isEmpty())
            <div class="bg-white rounded-2xl border border-gray-200 p-16 text-center">
                <div class="mb-5 flex justify-center">
                    <svg class="w-16 h-16 text-gray-200" viewBox="0 0 24 24" fill="currentColor"><path d="M21.71 20.29l-3.4-3.39A7.92 7.92 0 0 0 20 12a8 8 0 1 0-8 8 7.92 7.92 0 0 0 4.9-1.69l3.39 3.4a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42ZM6 12a6 6 0 1 1 12 0 6 6 0 0 1-12 0Z"/></svg>
                </div>
                <p class="text-lg font-bold text-gray-700 mb-1">Geen vacatures gevonden</p>
                <p class="text-sm text-gray-400 mb-5">Probeer andere zoektermen of verwijder de filters.</p>
                <a href="{{ route('jobs.index') }}" class="inline-block bg-dark text-white font-bold text-sm px-6 py-2.5 rounded-full hover:bg-gray-800 transition press">
                    Alle vacatures bekijken
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($jobs as $job)
                @php
                    $companyName = $job->company->companyProfile->company_name ?? $job->company->name;
                    $typeBadge = match($job->type) {
                        'stage' => 'bg-blue-50 text-blue-600',
                        'fulltime' => 'bg-green-50 text-green-600',
                        'freelance' => 'bg-purple-50 text-purple-600',
                        'bijbaan' => 'bg-amber-50 text-amber-600',
                        default => 'bg-gray-100 text-gray-500',
                    };
                @endphp
                <a href="{{ route('jobs.show', $job) }}"
                    class="group flex flex-col bg-white rounded-2xl border border-gray-200 p-6 hover:border-gray-300 hover:shadow-[0_16px_40px_rgba(0,0,0,0.06)] hover:-translate-y-0.5 transition-all duration-300 animate-fade-in-up"
                    style="animation-delay: {{ $loop->index * 0.05 }}s">

                    {{-- Top row: avatar + type badge --}}
                    <div class="flex justify-between items-start mb-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gray-100 text-gray-700 rounded-xl flex items-center justify-center font-black text-sm flex-shrink-0 group-hover:bg-dark group-hover:text-white transition-all duration-300">
                                {{ strtoupper(substr($companyName, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-500 leading-tight">{{ $companyName }}</p>
                                <p class="text-xs text-gray-400">{{ $job->region }}</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold uppercase tracking-wider {{ $typeBadge }} px-3 py-1.5 rounded-full flex-shrink-0">
                            {{ $job->type }}
                        </span>
                    </div>

                    {{-- Title + description --}}
                    <h3 class="font-black text-base leading-snug mb-2 flex-1 group-hover:text-dark transition">
                        {{ $job->title }}
                    </h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-5">
                        {{ Str::limit($job->description, 95) }}
                    </p>

                    {{-- Bottom: status + date + arrow --}}
                    <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full {{ $job->status === 'open' ? 'bg-brand' : 'bg-gray-300' }}"></span>
                            <span class="text-xs text-gray-400">{{ $job->created_at->diffForHumans() }}</span>
                        </div>
                        <span class="text-gray-300 group-hover:text-gray-900 group-hover:translate-x-1 transition-all font-bold text-sm">&rarr;</span>
                    </div>
                </a>
                @endforeach
            </div>

            <div class="mt-8 flex justify-center">{{ $jobs->withQueryString()->links() }}</div>
        @endif

    </div>
</x-app-layout>
