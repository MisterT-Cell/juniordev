<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'JuniorDev') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#f8f7f4]">

    <div class="min-h-screen flex">

        {{-- Left: Brand panel (hidden on small screens) --}}
        <div class="hidden lg:flex lg:w-[44%] xl:w-[42%] bg-[#0a0a0a] flex-col justify-between p-12 relative overflow-hidden">

            {{-- Decorative grid --}}
            <div class="absolute inset-0 opacity-[0.04]"
                style="background-image: linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 40px 40px;">
            </div>

            {{-- Decorative blob --}}
            <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-[#c8f135] rounded-full blur-[120px] opacity-20 pointer-events-none"></div>

            {{-- Logo --}}
            <a href="{{ route('welcome') }}" class="flex items-center gap-3 relative z-10">
                <div class="w-10 h-10 bg-[#c8f135] rounded-xl flex items-center justify-center">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 7L3 11L7 15" stroke="#0a0a0a" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M15 7L19 11L15 15" stroke="#0a0a0a" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M13 4L9 18" stroke="#0a0a0a" stroke-width="2.2" stroke-linecap="round"/>
                    </svg>
                </div>
                <span class="text-white font-black text-lg tracking-tight">JuniorDev</span>
            </a>

            {{-- Center content --}}
            <div class="relative z-10 space-y-8">
                <div>
                    <h2 class="text-white font-black text-4xl leading-tight tracking-tight mb-4">
                        Jouw eerste<br>
                        stap in tech<br>
                        begint hier.
                    </h2>
                    <p class="text-gray-400 text-base leading-relaxed max-w-xs">
                        Verbind junior developers met bedrijven die écht investeren in groei.
                    </p>
                </div>

                {{-- Social proof --}}
                @php
                    $openJobs = \App\Models\Job::where('status','open')->count();
                    $companies = \App\Models\User::where('role','company')->count();
                @endphp
                <div class="flex gap-6">
                    <div>
                        <p class="text-[#c8f135] font-black text-2xl">{{ $openJobs }}</p>
                        <p class="text-gray-500 text-xs uppercase tracking-widest mt-0.5">Vacatures</p>
                    </div>
                    <div class="w-px bg-gray-800"></div>
                    <div>
                        <p class="text-[#c8f135] font-black text-2xl">{{ $companies }}</p>
                        <p class="text-gray-500 text-xs uppercase tracking-widest mt-0.5">Bedrijven</p>
                    </div>
                </div>
            </div>

            {{-- Bottom quote --}}
            <div class="relative z-10">
                <p class="text-gray-600 text-xs leading-relaxed">
                    &ldquo;Via JuniorDev vond ik binnen twee weken mijn eerste stageplek.&rdquo;
                </p>
                <p class="text-gray-700 text-xs font-semibold mt-2">— Robin, HBO Informatica</p>
            </div>
        </div>

        {{-- Right: Form panel --}}
        <div class="flex-1 flex flex-col justify-center items-center px-6 py-12 lg:px-16 xl:px-24">

            {{-- Mobile logo --}}
            <a href="{{ route('welcome') }}" class="flex items-center gap-2.5 mb-10 lg:hidden">
                <div class="w-9 h-9 bg-[#0a0a0a] rounded-xl flex items-center justify-center">
                    <svg width="20" height="20" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 7L3 11L7 15" stroke="#c8f135" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M15 7L19 11L15 15" stroke="#c8f135" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M13 4L9 18" stroke="#c8f135" stroke-width="2.2" stroke-linecap="round"/>
                    </svg>
                </div>
                <span class="font-black text-[#0a0a0a] text-lg tracking-tight">JuniorDev</span>
            </a>

            <div class="w-full max-w-md">
                {{ $slot }}
            </div>
        </div>

    </div>
</body>
</html>
