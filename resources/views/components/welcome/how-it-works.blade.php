<section class="bg-[#0a0a0a] grain overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 pt-24 pb-20">

        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-20">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.18em] text-gray-600 mb-4">Simpel en snel</p>
                <h2 class="font-black text-5xl md:text-6xl text-white tracking-tight leading-none">
                    Hoe werkt<br>het?
                </h2>
            </div>
            <p class="text-gray-500 max-w-xs text-sm leading-relaxed md:text-right">
                In drie stappen van account naar eerste kans — voor studenten én bedrijven.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-6">

            {{-- Voor studenten --}}
            <div class="border border-white/10 rounded-2xl overflow-hidden">
                <div class="px-8 py-5 border-b border-white/10 flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-[0.15em] text-gray-500">Voor studenten</span>
                    <span class="bg-[#c8f135] text-black text-xs font-bold px-3 py-1 rounded-full">Gratis</span>
                </div>
                @foreach([
                    ['01', 'Account aanmaken',    'Registreer in 30 seconden als student.'],
                    ['02', 'Profiel invullen',    'Voeg je skills, regio en opleiding toe.'],
                    ['03', 'Reageer op vacatures','Stuur een motivatie en word opgemerkt.'],
                ] as [$n, $title, $desc])
                <div class="px-8 py-7 border-b border-white/[0.05] last:border-0 flex items-start gap-6">
                    <span class="step-num flex-shrink-0 w-14 text-right leading-none pt-1">{{ $n }}</span>
                    <div>
                        <p class="font-bold text-white mb-1">{{ $title }}</p>
                        <p class="text-gray-500 text-sm">{{ $desc }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Voor bedrijven --}}
            <div class="border border-white/10 rounded-2xl overflow-hidden">
                <div class="px-8 py-5 border-b border-white/10 flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-[0.15em] text-gray-500">Voor bedrijven</span>
                    <span class="bg-white/10 text-white text-xs font-bold px-3 py-1 rounded-full">Onbeperkt</span>
                </div>
                @foreach([
                    ['01', 'Bedrijf registreren',    'Maak een profiel met je bedrijfsinfo.'],
                    ['02', 'Vacature plaatsen',       'Beschrijf de functie, regio en vereisten.'],
                    ['03', 'Kandidaten selecteren',   'Bekijk reacties en kies de beste match.'],
                ] as [$n, $title, $desc])
                <div class="px-8 py-7 border-b border-white/[0.05] last:border-0 flex items-start gap-6">
                    <span class="step-num flex-shrink-0 w-14 text-right leading-none pt-1">{{ $n }}</span>
                    <div>
                        <p class="font-bold text-white mb-1">{{ $title }}</p>
                        <p class="text-gray-500 text-sm">{{ $desc }}</p>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</section>
