<nav class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
    <a href="{{ route('home') }}" class="text-white font-black text-xl tracking-tight">
        Junior<span class="text-[#c8f135]">Dev</span>
    </a>

    <div class="hidden md:flex items-center gap-8 text-sm text-gray-500">
        <a href="{{ route('jobs.index') }}" class="hover:text-white transition">Vacatures</a>
        @auth
            <a href="{{ route('dashboard') }}" class="hover:text-white transition">Dashboard</a>
            <a href="{{ route('messages.index') }}" class="hover:text-white transition">Berichten</a>
        @endauth
    </div>

    <div class="flex items-center gap-3">
        @auth
            <a href="{{ route('dashboard') }}" class="text-sm text-gray-400 hover:text-white transition">
                Dashboard &rarr;
            </a>
        @else
            <a href="{{ route('login') }}" class="text-sm text-gray-400 hover:text-white transition">Inloggen</a>
            <a href="{{ route('register') }}" class="bg-[#c8f135] text-black text-sm font-bold px-5 py-2 rounded-full hover:bg-[#d4f54e] transition">
                Aanmelden
            </a>
        @endauth
    </div>
</nav>
