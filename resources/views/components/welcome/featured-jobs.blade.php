<section class="max-w-7xl mx-auto px-6 py-28">
    <div class="flex justify-between items-end mb-14">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.18em] text-gray-400 mb-4">Live op het platform</p>
            <h2 class="font-black text-5xl md:text-6xl tracking-tight leading-none">
                Nieuwste<br><span class="text-gray-400">vacatures</span>
            </h2>
        </div>
        <a href="{{ route('jobs.index') }}"
            class="hidden md:inline-flex items-center gap-2 border border-gray-300 text-gray-600 text-sm font-semibold px-5 py-2.5 rounded-full hover:border-gray-900 hover:text-gray-900 transition">
            Alle vacatures
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
        </a>
    </div>

    @php
        $jobs = \App\Models\Job::with('company.companyProfile')
            ->where('status', 'open')
            ->latest()
            ->take(3)
            ->get();
    @endphp

    <div class="grid md:grid-cols-3 gap-4">
        @foreach($jobs as $i => $job)
            @php $name = $job->company->companyProfile->company_name ?? $job->company->name; @endphp

            @if($i === 0)
            {{-- Featured dark card --}}
            <a href="{{ route('jobs.show', $job) }}"
                class="md:col-span-1 bg-[#0a0a0a] text-white rounded-2xl p-8 flex flex-col justify-between min-h-[280px] group hover:bg-[#111] transition">
                <div>
                    <div class="flex justify-between items-start mb-8">
                        <div class="w-12 h-12 bg-[#c8f135] text-black rounded-xl flex items-center justify-center font-black text-lg flex-shrink-0">
                            {{ strtoupper(substr($name, 0, 1)) }}
                        </div>
                        <span class="text-xs font-bold text-white/40 uppercase tracking-widest">{{ $job->type }}</span>
                    </div>
                    <h3 class="font-black text-2xl leading-snug mb-3 group-hover:text-[#c8f135] transition">
                        {{ $job->title }}
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ Str::limit($job->description, 90) }}</p>
                </div>
                <div class="flex justify-between items-center pt-6 mt-6 border-t border-white/10">
                    <span class="text-xs text-gray-500">{{ $name }} · {{ $job->region }}</span>
                    <span class="w-8 h-8 bg-white/5 group-hover:bg-[#c8f135] group-hover:text-black rounded-full flex items-center justify-center transition text-white text-sm font-bold">&rarr;</span>
                </div>
            </a>

            @else
            {{-- Regular card --}}
            <a href="{{ route('jobs.show', $job) }}"
                class="bg-white border border-gray-200 rounded-2xl p-7 flex flex-col group hover:border-gray-400 hover:shadow-lg transition-all duration-200">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-10 h-10 bg-gray-100 text-gray-700 rounded-xl flex items-center justify-center font-black text-sm flex-shrink-0">
                        {{ strtoupper(substr($name, 0, 1)) }}
                    </div>
                    <span class="text-xs font-bold uppercase tracking-widest bg-gray-100 text-gray-500 px-3 py-1.5 rounded-full">{{ $job->type }}</span>
                </div>
                <h3 class="font-black text-lg leading-snug mb-2 flex-1">{{ $job->title }}</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-5">{{ Str::limit($job->description, 80) }}</p>
                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                    <span class="text-xs text-gray-500">{{ $name }} · {{ $job->region }}</span>
                    <span class="text-gray-300 group-hover:text-gray-900 transition font-bold text-sm">&rarr;</span>
                </div>
            </a>
            @endif
        @endforeach
    </div>

    <div class="text-center mt-8 md:hidden">
        <a href="{{ route('jobs.index') }}" class="text-sm font-semibold text-gray-500">Alle vacatures &rarr;</a>
    </div>
</section>
