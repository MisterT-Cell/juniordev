<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 flex-wrap">
            <a href="{{ route('jobs.index') }}"
                class="inline-flex items-center gap-1.5 text-sm text-gray-400 hover:text-gray-700 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Vacatures
            </a>
            <span class="text-gray-300">/</span>
            <h2 class="font-black text-xl tracking-tight text-gray-900">{{ $job->title }}</h2>
        </div>
    </x-slot>

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

    <div class="max-w-6xl mx-auto px-6 py-10">

        {{-- Flash messages --}}
        @if(session('success'))
            <div class="bg-brand/20 border border-brand text-gray-800 px-5 py-3.5 rounded-2xl text-sm font-medium mb-6 flex items-center gap-2">
                <svg class="w-4 h-4 text-brand flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-3.5 rounded-2xl text-sm font-medium mb-6">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid lg:grid-cols-3 gap-6 items-start">

            {{-- LEFT: main content (2/3) --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Title card --}}
                <div class="bg-white rounded-2xl border border-gray-200 p-8 {{ $job->status === 'open' ? 'border-t-4 border-t-brand' : 'border-t-4 border-t-red-400' }}">
                    <div class="flex flex-wrap gap-2 mb-5">
                        <span class="text-xs font-bold uppercase tracking-wider {{ $typeBadge }} px-3 py-1.5 rounded-full">
                            {{ ucfirst($job->type) }}
                        </span>
                        <span class="text-xs font-bold uppercase tracking-wider bg-gray-100 text-gray-600 px-3 py-1.5 rounded-full">
                            {{ $job->region }}
                        </span>
                        <span class="text-xs font-bold uppercase tracking-wider px-3 py-1.5 rounded-full inline-flex items-center gap-1
                            {{ $job->status === 'open' ? 'bg-brand/20 text-gray-700' : 'bg-red-50 text-red-500' }}">
                            @if($job->status === 'open')
                                <span class="w-1.5 h-1.5 bg-brand rounded-full animate-pulse"></span>
                            @endif
                            {{ $job->status === 'open' ? 'Open' : 'Gesloten' }}
                        </span>
                    </div>

                    <h1 class="font-black text-3xl tracking-tight leading-snug mb-2 text-balance">{{ $job->title }}</h1>
                    <p class="text-sm text-gray-400">
                        Geplaatst door <span class="font-semibold text-gray-600">{{ $companyName }}</span>
                        &middot; {{ $job->created_at->format('d M Y') }}
                        &middot; <span class="font-medium">{{ $job->applications->count() }} {{ $job->applications->count() === 1 ? 'reactie' : 'reacties' }}</span>
                    </p>
                </div>

                {{-- Description --}}
                <div class="bg-white rounded-2xl border border-gray-200 p-8">
                    <h3 class="font-black text-lg mb-5 flex items-center gap-2">
                        <span class="w-1 h-6 bg-brand rounded-full inline-block"></span>
                        Beschrijving
                    </h3>
                    <div class="text-gray-600 leading-relaxed whitespace-pre-line text-sm">{{ $job->description }}</div>
                </div>

                {{-- Requirements --}}
                @if($job->requirements)
                <div class="bg-white rounded-2xl border border-gray-200 p-8">
                    <h3 class="font-black text-lg mb-5 flex items-center gap-2">
                        <span class="w-1 h-6 bg-dark rounded-full inline-block"></span>
                        Vereisten
                    </h3>
                    <div class="flex flex-wrap gap-1.5">
                        @foreach(preg_split('/[,\n]+/', $job->requirements) as $req)
                            @if(trim($req))
                                <span class="inline-block bg-gray-100 text-gray-600 text-xs font-medium px-3 py-1.5 rounded-full">{{ trim($req) }}</span>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Apply form (mobile: show here, desktop: in sidebar) --}}
                @auth
                    @if(auth()->user()->isStudent())
                    <div class="lg:hidden">
                        @include('jobs._apply-section')
                    </div>
                    @endif
                @else
                    <div class="lg:hidden bg-white rounded-2xl border border-gray-200 p-6">
                        <p class="text-sm text-gray-600">
                            <a href="{{ route('login') }}" class="font-bold underline decoration-brand">Log in</a> of
                            <a href="{{ route('register') }}" class="font-bold underline decoration-brand">registreer</a> om te reageren.
                        </p>
                    </div>
                @endauth

            </div>

            {{-- RIGHT: sidebar (1/3) --}}
            <div class="space-y-5 lg:sticky lg:top-24">

                {{-- Company card --}}
                <div class="bg-white rounded-2xl border border-gray-200 p-6">
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">Bedrijf</p>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-dark text-white rounded-xl flex items-center justify-center font-black text-lg flex-shrink-0 shadow-sm">
                            {{ strtoupper(substr($companyName, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">{{ $companyName }}</p>
                            @if($job->company->companyProfile?->website)
                                <a href="{{ $job->company->companyProfile->website }}" target="_blank"
                                    class="text-xs text-gray-400 hover:text-gray-700 underline decoration-brand/50 hover:decoration-brand transition">
                                    Website &rarr;
                                </a>
                            @endif
                        </div>
                    </div>
                    @if($job->company->companyProfile?->description)
                        <p class="text-sm text-gray-500 leading-relaxed">
                            {{ Str::limit($job->company->companyProfile->description, 120) }}
                        </p>
                    @endif
                </div>

                {{-- Apply section (desktop only) --}}
                @auth
                    @if(auth()->user()->isStudent())
                    <div class="hidden lg:block">
                        @include('jobs._apply-section')
                    </div>
                    @endif
                @else
                    <div class="hidden lg:block bg-white rounded-2xl border border-gray-200 p-6">
                        <p class="font-semibold text-gray-800 mb-3 text-sm">Wil je reageren?</p>
                        <div class="flex flex-col gap-2">
                            <a href="{{ route('login') }}"
                                class="text-center bg-dark text-white font-bold px-5 py-2.5 rounded-full hover:bg-gray-800 transition text-sm press">
                                Inloggen
                            </a>
                            <a href="{{ route('register') }}"
                                class="text-center border border-gray-300 text-gray-600 font-semibold px-5 py-2.5 rounded-full hover:border-gray-900 hover:text-gray-900 transition text-sm press">
                                Account aanmaken
                            </a>
                        </div>
                    </div>
                @endauth

                {{-- Quick info --}}
                <div class="bg-white rounded-2xl border border-gray-200 p-6">
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Info</p>
                    <div class="space-y-0">
                        @foreach([
                            ['Type',      ucfirst($job->type)],
                            ['Regio',     $job->region],
                            ['Geplaatst', $job->created_at->format('d-m-Y')],
                            ['Reacties',  $job->applications->count()],
                        ] as $idx => [$label, $value])
                        <div class="flex justify-between items-center text-sm py-2.5 {{ $idx % 2 === 0 ? 'bg-gray-50/50 -mx-2 px-2 rounded-lg' : '' }}">
                            <span class="text-gray-400">{{ $label }}</span>
                            <span class="font-semibold text-gray-700">{{ $value }}</span>
                        </div>
                        @endforeach
                    </div>

                    {{-- Share button --}}
                    <div x-data="{ copied: false }" class="mt-4 pt-4 border-t border-gray-100">
                        <button @click="navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2000)"
                            class="w-full text-center text-xs font-semibold text-gray-400 hover:text-gray-700 transition py-2 flex items-center justify-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                            </svg>
                            <span x-text="copied ? 'Link gekopieerd!' : 'Deel deze vacature'"></span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
