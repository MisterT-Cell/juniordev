<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JuniorDev — Vind je eerste opdracht</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap');
        body { font-family: 'Inter', sans-serif; }

        .hero-grid {
            background-color: #0a0a0a;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        .tag-pill {
            display: inline-block;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.12);
            color: #a3a3a3;
            font-size: 0.75rem;
            padding: 4px 12px;
            border-radius: 999px;
            letter-spacing: 0.05em;
        }

        .glow-btn {
            position: relative;
            overflow: hidden;
        }
        .glow-btn::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.15), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .glow-btn:hover::after { opacity: 1; }

        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        }

        .marquee-wrapper { overflow: hidden; }
        .marquee-track {
            display: flex;
            gap: 2rem;
            animation: marquee 20s linear infinite;
            white-space: nowrap;
        }
        @keyframes marquee {
            from { transform: translateX(0); }
            to { transform: translateX(-50%); }
        }

        .number-stat {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 900;
            line-height: 1;
            letter-spacing: -0.03em;
        }
    </style>
</head>
<body class="bg-[#f8f7f4] text-gray-900 antialiased">

    {{-- NAV --}}
    <header class="hero-grid">
        <nav class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-white font-black text-xl tracking-tight">
                Junior<span class="text-[#c8f135]">Dev</span>
            </a>
            <div class="hidden md:flex items-center gap-8 text-sm text-gray-400">
                <a href="{{ route('assignments.index') }}" class="hover:text-white transition">Opdrachten</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="hover:text-white transition">Dashboard</a>
                    <a href="{{ route('messages.index') }}" class="hover:text-white transition">Berichten</a>
                @endauth
            </div>
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm text-gray-300 hover:text-white transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white transition">Inloggen</a>
                    <a href="{{ route('register') }}" class="glow-btn bg-[#c8f135] text-black text-sm font-bold px-4 py-2 rounded-full hover:bg-[#d4f54e] transition">
                        Registreren
                    </a>
                @endauth
            </div>
        </nav>

        {{-- HERO --}}
        <div class="max-w-7xl mx-auto px-6 pt-20 pb-32">
            <div class="max-w-4xl">
                <span class="tag-pill mb-6 inline-block">Het platform voor junior developers</span>
                <h1 class="text-white font-black leading-[1.05] tracking-tight mb-8"
                    style="font-size: clamp(3rem, 7vw, 6rem);">
                    Jouw eerste<br>
                    <span class="text-[#c8f135]">opdracht</span><br>
                    begint hier.
                </h1>
                <p class="text-gray-400 text-lg mb-10 max-w-xl leading-relaxed">
                    Verbindt junior developers met bedrijven die op zoek zijn naar vers talent. Stages, bijbanen, freelance — alles op één plek.
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('assignments.index') }}"
                        class="glow-btn bg-[#c8f135] text-black font-bold px-7 py-3.5 rounded-full hover:bg-[#d4f54e] transition text-sm">
                        Bekijk opdrachten &rarr;
                    </a>
                    <a href="{{ route('register') }}"
                        class="glow-btn border border-white/20 text-white font-semibold px-7 py-3.5 rounded-full hover:border-white/50 transition text-sm">
                        Gratis account aanmaken
                    </a>
                </div>
            </div>
        </div>

        {{-- STATS BAR --}}
        <div class="border-t border-white/10 bg-white/[0.02]">
            <div class="max-w-7xl mx-auto px-6 py-8 grid grid-cols-3 divide-x divide-white/10">
                <div class="px-8 first:pl-0">
                    <div class="number-stat text-[#c8f135]">{{ \App\Models\Assignment::where('status','open')->count() }}</div>
                    <div class="text-gray-500 text-sm mt-1">Open opdrachten</div>
                </div>
                <div class="px-8">
                    <div class="number-stat text-white">{{ \App\Models\User::where('role','company')->count() }}</div>
                    <div class="text-gray-500 text-sm mt-1">Bedrijven actief</div>
                </div>
                <div class="px-8">
                    <div class="number-stat text-white">{{ \App\Models\User::where('role','student')->count() }}</div>
                    <div class="text-gray-500 text-sm mt-1">Junior developers</div>
                </div>
            </div>
        </div>
    </header>

    {{-- MARQUEE --}}
    <div class="bg-[#c8f135] py-3 overflow-hidden">
        <div class="marquee-track text-black/50 text-sm font-semibold uppercase tracking-widest">
            @php $items = ['PHP', 'Laravel', 'JavaScript', 'Vue.js', 'React', 'MySQL', 'Tailwind', 'Node.js', 'Python', 'Git', 'Docker', 'REST API']; @endphp
            @foreach(array_merge($items, $items) as $skill)
                <span>{{ $skill }}</span><span class="mx-4">·</span>
            @endforeach
        </div>
    </div>

    {{-- OPDRACHTEN --}}
    <section class="max-w-7xl mx-auto px-6 py-28">
        <div class="flex justify-between items-end mb-14">
            <div>
                <p class="text-sm font-semibold text-gray-400 uppercase tracking-widest mb-3">Vers geplaatst</p>
                <h2 class="font-black text-4xl tracking-tight">Nieuwste opdrachten</h2>
            </div>
            <a href="{{ route('assignments.index') }}" class="text-sm font-semibold text-gray-500 hover:text-gray-900 transition hidden md:block">
                Alle bekijken &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @foreach(\App\Models\Assignment::with('company.companyProfile')->where('status','open')->latest()->take(3)->get() as $i => $assignment)
            <a href="{{ route('assignments.show', $assignment) }}"
                class="card-hover block rounded-2xl p-7 border border-gray-200 bg-white group">
                <div class="flex justify-between items-start mb-6">
                    <span class="text-xs font-bold uppercase tracking-widest bg-gray-100 text-gray-600 px-3 py-1.5 rounded-full">
                        {{ $assignment->type }}
                    </span>
                    <span class="text-xs text-gray-400">{{ $assignment->region }}</span>
                </div>
                <h3 class="font-bold text-lg leading-snug mb-3 group-hover:text-indigo-600 transition">
                    {{ $assignment->title }}
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-6">
                    {{ Str::limit($assignment->description, 110) }}
                </p>
                <div class="flex justify-between items-center pt-5 border-t border-gray-100">
                    <span class="text-sm font-medium text-gray-700">
                        {{ $assignment->company->companyProfile->company_name ?? $assignment->company->name }}
                    </span>
                    <span class="text-sm font-bold text-indigo-600 group-hover:translate-x-1 transition-transform inline-block">&rarr;</span>
                </div>
            </a>
            @endforeach
        </div>

        <div class="text-center mt-10 md:hidden">
            <a href="{{ route('assignments.index') }}" class="text-sm font-semibold text-gray-500 hover:text-gray-900">Alle bekijken &rarr;</a>
        </div>
    </section>

    {{-- HOE WERKT HET --}}
    <section class="bg-[#0a0a0a] text-white py-28">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-16">
                <p class="text-sm font-semibold text-gray-500 uppercase tracking-widest mb-3">Simpel en snel</p>
                <h2 class="font-black text-4xl tracking-tight">Hoe werkt het?</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Student --}}
                <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
                    <div class="inline-block bg-[#c8f135] text-black text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded-full mb-8">
                        Voor studenten
                    </div>
                    <div class="space-y-6">
                        @foreach(['Maak een gratis account aan als student', 'Vul je profiel in met skills en regio', 'Reageer op opdrachten die bij je passen'] as $i => $step)
                        <div class="flex items-start gap-4">
                            <div class="shrink-0 w-8 h-8 rounded-full border border-white/20 flex items-center justify-center text-sm font-bold text-gray-400">
                                {{ $i + 1 }}
                            </div>
                            <p class="text-gray-300 pt-1">{{ $step }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Bedrijf --}}
                <div class="bg-white/5 border border-white/10 rounded-2xl p-8">
                    <div class="inline-block bg-white/10 text-white text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded-full mb-8">
                        Voor bedrijven
                    </div>
                    <div class="space-y-6">
                        @foreach(['Registreer je bedrijf en maak een profiel', 'Plaats je opdracht of vacature', 'Selecteer de beste junior developer'] as $i => $step)
                        <div class="flex items-start gap-4">
                            <div class="shrink-0 w-8 h-8 rounded-full border border-white/20 flex items-center justify-center text-sm font-bold text-gray-400">
                                {{ $i + 1 }}
                            </div>
                            <p class="text-gray-300 pt-1">{{ $step }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="max-w-7xl mx-auto px-6 py-28">
        <div class="bg-[#c8f135] rounded-3xl px-10 py-16 flex flex-col md:flex-row justify-between items-center gap-8">
            <div>
                <h2 class="font-black text-3xl md:text-4xl tracking-tight text-black mb-2">
                    Klaar om te beginnen?
                </h2>
                <p class="text-black/60 text-lg">Maak gratis een account aan en vind je eerste opdracht.</p>
            </div>
            <a href="{{ route('register') }}"
                class="shrink-0 bg-black text-white font-bold px-8 py-4 rounded-full hover:bg-gray-900 transition text-sm whitespace-nowrap">
                Registreer nu &rarr;
            </a>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="border-t border-gray-200 py-8">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center text-sm text-gray-400">
            <span class="font-black text-gray-900">Junior<span class="text-[#8ab010]">Dev</span></span>
            <span>&copy; {{ date('Y') }} JuniorDev</span>
        </div>
    </footer>

</body>
</html>
