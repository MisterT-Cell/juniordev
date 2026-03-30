<section class="max-w-7xl mx-auto px-6 py-28">
    <div class="grid md:grid-cols-2 gap-4">

        {{-- Student CTA --}}
        <div class="bg-[#0a0a0a] rounded-2xl p-10 flex flex-col justify-between min-h-[280px]">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.15em] text-gray-600 mb-4">Ben je student?</p>
                <h3 class="font-black text-3xl text-white leading-tight mb-4">
                    Zet je eerste<br>stap in tech.
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Honderden vacatures voor junior developers. Gratis profiel, direct solliciteren.
                </p>
            </div>
            <a href="{{ route('register') }}"
                class="mt-8 self-start bg-[#c8f135] text-black font-bold px-6 py-3 rounded-full hover:bg-[#d4f54e] transition text-sm inline-flex items-center gap-2">
                Start als student
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>

        {{-- Company CTA --}}
        <div class="bg-[#c8f135] rounded-2xl p-10 flex flex-col justify-between min-h-[280px]">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.15em] text-black/50 mb-4">Ben je een bedrijf?</p>
                <h3 class="font-black text-3xl text-black leading-tight mb-4">
                    Vind jouw<br>volgende talent.
                </h3>
                <p class="text-black/60 text-sm leading-relaxed">
                    Plaats vacatures en bereik honderden gemotiveerde junior developers direct.
                </p>
            </div>
            <a href="{{ route('register') }}"
                class="mt-8 self-start bg-black text-white font-bold px-6 py-3 rounded-full hover:bg-gray-900 transition text-sm inline-flex items-center gap-2">
                Registreer bedrijf
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>

    </div>
</section>
