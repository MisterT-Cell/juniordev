@php
    $previewJob   = \App\Models\Job::with('company.companyProfile')->where('status','open')->latest()->first();
    $previewName  = $previewJob?->company->companyProfile->company_name ?? $previewJob?->company->name ?? 'JuniorDev';
    $openJobs     = \App\Models\Job::where('status','open')->count();
    $companies    = \App\Models\User::where('role','company')->count();
    $students     = \App\Models\User::where('role','student')->count();

    // Pull unique skill-like words from requirements of recent jobs
    $recentSkills = \App\Models\Job::whereNotNull('requirements')
        ->latest()->take(6)->pluck('requirements')
        ->flatMap(fn($r) => explode(',', $r))
        ->map(fn($s) => trim($s))
        ->filter(fn($s) => strlen($s) > 1 && strlen($s) < 20)
        ->unique()->take(4)->values();
@endphp

<div class="relative overflow-hidden">
    <div class="hero-glow"></div>

    <div class="max-w-7xl mx-auto px-6 pt-24 pb-20 grid md:grid-cols-2 gap-12 items-center">

        {{-- Left: copy --}}
        <div class="relative z-10">
            <div class="inline-flex items-center gap-2 bg-white/5 border border-white/10 rounded-full px-4 py-1.5 text-xs text-gray-500 tracking-[0.12em] uppercase mb-10">
                <span class="w-1.5 h-1.5 bg-[#c8f135] rounded-full animate-pulse"></span>
                Platform voor junior developers
            </div>

            <h1 class="display text-white mb-8">
                Vind je<br>
                <span class="outline-word">eerste</span><br>
                <span class="text-[#c8f135]">vacature.</span>
            </h1>

            <p class="text-gray-500 text-lg leading-relaxed mb-10 max-w-sm">
                Verbindt junior developers met bedrijven die vers talent zoeken.
                Stages, bijbanen en freelance — alles op één plek.
            </p>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('jobs.index') }}"
                    class="bg-[#c8f135] text-black font-bold px-7 py-3.5 rounded-full hover:bg-[#d4f54e] transition text-sm inline-flex items-center gap-2">
                    Bekijk vacatures
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
                <a href="{{ route('register') }}"
                    class="border border-white/15 text-gray-300 font-semibold px-7 py-3.5 rounded-full hover:border-white/40 hover:text-white transition text-sm">
                    Gratis account
                </a>
            </div>
        </div>

        {{-- Right: floating real job card --}}
        @if($previewJob)
        <div class="hidden md:flex items-center justify-center relative z-10 py-8">
            <div class="relative w-full max-w-sm">

                {{-- Shadow card (behind) --}}
                <div class="absolute inset-0 bg-white/5 border border-white/10 rounded-2xl"
                    style="transform: rotate(4deg) translate(8px, 8px);"></div>

                {{-- Main card --}}
                <div class="card-float relative bg-white rounded-2xl p-7 shadow-[0_32px_80px_rgba(0,0,0,0.5)]">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-[#0a0a0a] rounded-xl flex items-center justify-center text-white font-black text-sm flex-shrink-0">
                                {{ strtoupper(substr($previewName, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-sm leading-tight">{{ $previewName }}</p>
                                <p class="text-xs text-gray-400">{{ $previewJob->region }}</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold bg-[#c8f135]/25 text-gray-700 px-3 py-1 rounded-full">
                            {{ ucfirst($previewJob->type) }}
                        </span>
                    </div>

                    <h3 class="font-black text-xl text-gray-900 leading-tight mb-3">
                        {{ Str::limit($previewJob->title, 40) }}
                    </h3>
                    <p class="text-sm text-gray-400 mb-5 leading-relaxed">
                        {{ Str::limit($previewJob->description, 80) }}
                    </p>

                    <div class="flex items-center justify-between">
                        <div class="flex gap-1.5 flex-wrap">
                            @foreach($recentSkills->take(2) as $skill)
                                <span class="text-xs bg-gray-100 text-gray-600 px-2.5 py-1 rounded-full font-medium">{{ $skill }}</span>
                            @endforeach
                        </div>
                        <span class="text-xs text-gray-400">{{ $previewJob->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                {{-- Notification badge --}}
                <div class="absolute -bottom-5 -right-5 bg-[#c8f135] rounded-xl px-4 py-2.5 shadow-xl"
                    style="transform: rotate(2deg);">
                    <p class="text-xs font-black text-black leading-none">
                        ✓ {{ $openJobs }} open {{ $openJobs === 1 ? 'vacature' : 'vacatures' }}
                    </p>
                    <p class="text-xs text-black/50 mt-0.5">Vandaag bijgewerkt</p>
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- Stats strip --}}
    <div class="border-t border-white/[0.07]">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-3 divide-x divide-white/[0.07]">
            @foreach([
                [$openJobs,  'Open vacatures',    '#c8f135'],
                [$companies, 'Bedrijven actief',  'white'],
                [$students,  'Junior developers', 'white'],
            ] as [$n, $label, $color])
            <div class="px-8 py-8 first:pl-0">
                <div class="font-black text-5xl md:text-6xl tracking-tight leading-none mb-1"
                    style="color: {{ $color }}">{{ $n }}</div>
                <div class="text-gray-600 text-sm">{{ $label }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>
