<section class="max-w-7xl mx-auto px-6 py-32">
    <div class="grid md:grid-cols-2 gap-4">

        {{-- Student CTA --}}
        <div class="group relative overflow-hidden bg-dark hero-bg grain rounded-2xl p-10 flex flex-col justify-between min-h-[320px] hover:-translate-y-1 transition-transform duration-300">
            {{-- Decorative glow --}}
            <div class="absolute top-0 right-0 w-48 h-48 bg-brand/5 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10">
                <p class="text-xs font-bold uppercase tracking-[0.15em] text-gray-600 mb-4">Ben je student?</p>
                <h3 class="font-black text-3xl text-white leading-tight mb-4 text-balance">
                    Zet je eerste<br>stap in tech.
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed max-w-xs">
                    Honderden vacatures voor junior developers. Gratis profiel, direct solliciteren.
                </p>
            </div>
            <a href="{{ route('register') }}"
                class="group/btn mt-8 self-start bg-brand text-black font-bold px-6 py-3 rounded-full hover:bg-brand-hover hover-glow transition text-sm inline-flex items-center gap-2 press relative z-10">
                Start als student
                <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>

        {{-- Company CTA --}}
        <div class="group relative overflow-hidden bg-brand rounded-2xl p-10 flex flex-col justify-between min-h-[320px] hover:-translate-y-1 transition-transform duration-300">
            {{-- Decorative dark circle --}}
            <div class="absolute -bottom-12 -right-12 w-48 h-48 bg-black/5 rounded-full pointer-events-none"></div>

            <div class="relative z-10">
                <p class="text-xs font-bold uppercase tracking-[0.15em] text-black/50 mb-4">Ben je een bedrijf?</p>
                <h3 class="font-black text-3xl text-black leading-tight mb-4 text-balance">
                    Vind jouw<br>volgende talent.
                </h3>
                <p class="text-black/60 text-sm leading-relaxed max-w-xs">
                    Plaats vacatures en bereik honderden gemotiveerde junior developers direct.
                </p>
            </div>
            <a href="{{ route('register') }}"
                class="group/btn mt-8 self-start bg-black text-white font-bold px-6 py-3 rounded-full hover:bg-gray-900 hover:shadow-xl transition text-sm inline-flex items-center gap-2 press relative z-10">
                Registreer bedrijf
                <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>

    </div>
</section>
