<footer class="bg-dark grain">
    <div class="max-w-7xl mx-auto px-6 py-16 flex flex-col md:flex-row justify-between items-start gap-10">
        <div>
            <a href="{{ route('home') }}" class="font-black text-lg tracking-tight text-white hover:opacity-80 transition-opacity">
                Junior<span class="text-brand">Dev</span>
            </a>
            <p class="text-gray-500 text-sm mt-3 max-w-xs leading-relaxed">
                Het platform dat junior developers verbindt met bedrijven die groeien.
            </p>
            {{-- Social placeholders --}}
            <div class="flex gap-2 mt-5">
                <div class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 transition cursor-pointer"></div>
                <div class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 transition cursor-pointer"></div>
                <div class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 transition cursor-pointer"></div>
            </div>
        </div>

        <div class="flex gap-12 md:gap-16 text-sm">
            <div class="space-y-2.5">
                <p class="font-semibold text-gray-400 mb-3 text-xs uppercase tracking-widest">Platform</p>
                <a href="{{ route('jobs.index') }}" class="block text-gray-500 hover:text-white transition">Vacatures</a>
                <a href="{{ route('leads.index') }}" class="block text-gray-500 hover:text-white transition">Bedrijven</a>
                <a href="{{ route('register') }}" class="block text-gray-500 hover:text-white transition">Aanmelden</a>
                <a href="{{ route('login') }}" class="block text-gray-500 hover:text-white transition">Inloggen</a>
            </div>
            <div class="space-y-2.5">
                <p class="font-semibold text-gray-400 mb-3 text-xs uppercase tracking-widest">Account</p>
                <a href="{{ route('register') }}" class="block text-gray-500 hover:text-white transition">Als student</a>
                <a href="{{ route('register') }}" class="block text-gray-500 hover:text-white transition">Als bedrijf</a>
            </div>
            <div class="space-y-2.5">
                <p class="font-semibold text-gray-400 mb-3 text-xs uppercase tracking-widest">Info</p>
                <span class="block text-gray-600 text-xs">Over ons — binnenkort</span>
                <span class="block text-gray-600 text-xs">Contact — binnenkort</span>
            </div>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-5 flex flex-col sm:flex-row justify-between items-center gap-3 text-xs text-gray-600">
            <span>&copy; {{ date('Y') }} JuniorDev. Alle rechten voorbehouden.</span>
            <div class="flex items-center gap-4">
                <span class="flex items-center gap-1">
                    Made with
                    <svg class="w-3 h-3 text-brand" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    Laravel & Tailwind
                </span>
                <button onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
                    class="text-gray-500 hover:text-white transition flex items-center gap-1 group">
                    <svg class="w-3.5 h-3.5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                    </svg>
                    Terug naar boven
                </button>
            </div>
        </div>
    </div>
</footer>
