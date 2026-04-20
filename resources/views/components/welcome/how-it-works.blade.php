<section class="bg-dark grain overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 pt-24 pb-20">

        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-20">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.18em] text-gray-600 mb-4 flex items-center gap-2">
                    <span class="w-2 h-2 bg-brand rounded-full"></span>
                    Simpel en snel
                </p>
                <h2 class="font-black text-5xl md:text-6xl text-white tracking-tight leading-none text-balance">
                    Hoe werkt<br>het?
                </h2>
            </div>
            <p class="text-gray-500 max-w-xs text-sm leading-relaxed md:text-right">
                In drie stappen van account naar eerste kans — voor studenten én bedrijven.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-6">

            {{-- Voor studenten --}}
            <div class="border border-white/10 rounded-2xl overflow-hidden bg-white/[0.02]">
                <div class="px-8 py-5 border-b border-white/10 flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-[0.15em] text-gray-500">Voor studenten</span>
                    <span class="bg-brand text-black text-xs font-bold px-3 py-1 rounded-full shadow-[0_0_12px_rgba(200,241,53,0.3)]">Gratis</span>
                </div>
                @foreach([
                    ['01', 'Account aanmaken',    'Registreer in 30 seconden als student.'],
                    ['02', 'Profiel invullen',    'Voeg je skills, regio en opleiding toe.'],
                    ['03', 'Reageer op vacatures','Stuur een motivatie en word opgemerkt.'],
                ] as [$n, $title, $desc])
                <div class="group relative px-8 py-7 border-b border-white/[0.05] last:border-0 flex items-start gap-6
                            cursor-default transition-all duration-200
                            hover:bg-white/[0.05] hover:pl-10 border-l-2 border-transparent hover:border-brand">
                    <span class="step-num flex-shrink-0 w-14 text-right leading-none pt-1
                                 transition-colors duration-200 group-hover:text-brand/20">{{ $n }}</span>
                    <div class="flex-1">
                        <p class="font-bold text-white mb-1 transition-colors duration-200
                                  group-hover:text-brand">{{ $title }}</p>
                        <p class="text-gray-500 text-sm transition-colors duration-200
                                  group-hover:text-gray-300">{{ $desc }}</p>
                    </div>
                    <svg class="w-4 h-4 text-brand absolute right-6 top-1/2 -translate-y-1/2 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </div>
                @endforeach
            </div>

            {{-- Voor bedrijven --}}
            <div class="border border-white/10 rounded-2xl overflow-hidden bg-white/[0.02]">
                <div class="px-8 py-5 border-b border-white/10 flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-[0.15em] text-gray-500">Voor bedrijven</span>
                    <span class="bg-white/15 text-white text-xs font-bold px-3 py-1 rounded-full">Tijdelijk gratis!</span>
                </div>
                @foreach([
                    ['01', 'Bedrijf registreren',    'Maak een profiel met je bedrijfsinfo.'],
                    ['02', 'Vacature plaatsen',       'Beschrijf de functie, regio en vereisten.'],
                    ['03', 'Kandidaten selecteren',   'Bekijk reacties en kies de beste match.'],
                ] as [$n, $title, $desc])
                <div class="group relative px-8 py-7 border-b border-white/[0.05] last:border-0 flex items-start gap-6
                            cursor-default transition-all duration-200
                            hover:bg-white/[0.05] hover:pl-10 border-l-2 border-transparent hover:border-brand">
                    <span class="step-num flex-shrink-0 w-14 text-right leading-none pt-1
                                 transition-colors duration-200 group-hover:text-brand/20">{{ $n }}</span>
                    <div class="flex-1">
                        <p class="font-bold text-white mb-1 transition-colors duration-200
                                  group-hover:text-brand">{{ $title }}</p>
                        <p class="text-gray-500 text-sm transition-colors duration-200
                                  group-hover:text-gray-300">{{ $desc }}</p>
                    </div>
                    <svg class="w-4 h-4 text-brand absolute right-6 top-1/2 -translate-y-1/2 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</section>
