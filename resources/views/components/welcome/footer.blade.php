<footer class="border-t border-gray-200 bg-white">
    <div class="max-w-7xl mx-auto px-6 py-10 flex flex-col md:flex-row justify-between items-start gap-8">
        <div>
            <a href="{{ route('home') }}" class="font-black text-lg tracking-tight">
                Junior<span class="text-[#8ab010]">Dev</span>
            </a>
            <p class="text-gray-400 text-sm mt-2 max-w-xs leading-relaxed">
                Het platform dat junior developers verbindt met bedrijven die groeien.
            </p>
        </div>

        <div class="flex gap-12 text-sm">
            <div class="space-y-2.5">
                <p class="font-semibold text-gray-900 mb-3 text-xs uppercase tracking-widest">Platform</p>
                <a href="{{ route('jobs.index') }}" class="block text-gray-500 hover:text-gray-900 transition">Vacatures</a>
                <a href="{{ route('register') }}" class="block text-gray-500 hover:text-gray-900 transition">Aanmelden</a>
                <a href="{{ route('login') }}" class="block text-gray-500 hover:text-gray-900 transition">Inloggen</a>
            </div>
            <div class="space-y-2.5">
                <p class="font-semibold text-gray-900 mb-3 text-xs uppercase tracking-widest">Account</p>
                <a href="{{ route('register') }}" class="block text-gray-500 hover:text-gray-900 transition">Als student</a>
                <a href="{{ route('register') }}" class="block text-gray-500 hover:text-gray-900 transition">Als bedrijf</a>
            </div>
        </div>
    </div>

    <div class="border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center text-xs text-gray-400">
            <span>&copy; {{ date('Y') }} JuniorDev. Alle rechten voorbehouden.</span>
            <span class="text-gray-300">Gebouwd met Laravel &amp; Tailwind CSS</span>
        </div>
    </div>
</footer>
