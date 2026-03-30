<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl tracking-tight">Vacatures</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-10">

        {{-- Filters --}}
        <form method="GET" class="bg-white rounded-2xl border border-gray-200 p-5 mb-10 flex flex-wrap gap-3 items-end">
            <div class="flex-1 min-w-48">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Zoeken</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Zoek op titel..."
                    class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0">
            </div>
            <div class="min-w-40">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Regio</label>
                <select name="region" class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0">
                    <option value="">Alle regio's</option>
                    @foreach($regions as $region)
                        <option value="{{ $region }}" {{ request('region') === $region ? 'selected' : '' }}>{{ $region }}</option>
                    @endforeach
                </select>
            </div>
            <div class="min-w-40">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Type</label>
                <select name="type" class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0">
                    <option value="">Alle types</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}" {{ request('type') === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-[#0a0a0a] text-white text-sm font-bold px-5 py-2.5 rounded-full hover:bg-gray-800 transition">
                Zoeken
            </button>
            @if(request('search') || request('region') || request('type'))
                <a href="{{ route('jobs.index') }}" class="text-sm text-gray-400 hover:text-gray-700 self-center">Wis filters</a>
            @endif
        </form>

        @if($jobs->isEmpty())
            <div class="text-center py-24 text-gray-400">
                <p class="text-lg font-medium">Geen vacatures gevonden.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($jobs as $job)
                <a href="{{ route('jobs.show', $job) }}"
                    class="card-hover flex flex-col bg-white rounded-2xl border border-gray-200 p-6 group">
                    <div class="flex justify-between items-start mb-5">
                        <span class="text-xs font-bold uppercase tracking-widest bg-gray-100 text-gray-600 px-3 py-1.5 rounded-full">
                            {{ $job->type }}
                        </span>
                        <span class="text-xs text-gray-400">{{ $job->region }}</span>
                    </div>
                    <h3 class="font-bold text-base leading-snug mb-3 group-hover:text-indigo-600 transition flex-1">
                        {{ $job->title }}
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-5">
                        {{ Str::limit($job->description, 100) }}
                    </p>
                    <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                        <div>
                            <p class="text-sm font-semibold text-gray-800">{{ $job->company->companyProfile->company_name ?? $job->company->name }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $job->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="text-indigo-600 font-bold group-hover:translate-x-1 transition-transform inline-block">&rarr;</span>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="mt-8">{{ $jobs->withQueryString()->links() }}</div>
        @endif
    </div>
</x-app-layout>
