<nav x-data="{ open: false }" class="sticky top-0 z-50 backdrop-blur-xl bg-dark/80 border-b border-white/[0.06]">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-white font-black text-xl tracking-tight hover:opacity-80 transition-opacity">
            Junior<span class="text-brand">Dev</span>
        </a>

        <div class="hidden md:flex items-center gap-8 text-sm text-gray-500">
            <a href="{{ route('jobs.index') }}" class="nav-link-hover hover:text-white transition">Vacatures</a>
            <a href="{{ route('leads.index') }}" class="nav-link-hover hover:text-white transition">Bedrijven</a>
            @auth
                <a href="{{ route('dashboard') }}" class="nav-link-hover hover:text-white transition">Dashboard</a>
                <a href="{{ route('messages.index') }}" class="nav-link-hover hover:text-white transition">Berichten</a>
            @endauth
        </div>

        <div class="hidden md:flex items-center gap-3">
            @auth
                <a href="{{ route('dashboard') }}" class="text-sm text-gray-400 hover:text-white transition">
                    Dashboard &rarr;
                </a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-400 hover:text-white transition">Inloggen</a>
                <a href="{{ route('register') }}" class="bg-brand text-black text-sm font-bold px-5 py-2 rounded-full hover:bg-brand-hover hover-glow transition press">
                    Aanmelden
                </a>
            @endauth
        </div>

        {{-- Mobile hamburger --}}
        <button @click="open = !open" class="md:hidden text-gray-400 hover:text-white transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Mobile menu --}}
    <div x-show="open" x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden border-t border-white/10 px-6 py-4 space-y-1 bg-dark/95 backdrop-blur-xl">
        <a href="{{ route('jobs.index') }}" class="block text-sm text-gray-300 hover:text-white py-2.5 pl-3 border-l-2 border-transparent hover:border-brand transition-all">Vacatures</a>
        <a href="{{ route('leads.index') }}" class="block text-sm text-gray-300 hover:text-white py-2.5 pl-3 border-l-2 border-transparent hover:border-brand transition-all">Bedrijven</a>
        @auth
            <a href="{{ route('dashboard') }}" class="block text-sm text-gray-300 hover:text-white py-2.5 pl-3 border-l-2 border-transparent hover:border-brand transition-all">Dashboard</a>
            <a href="{{ route('messages.index') }}" class="block text-sm text-gray-300 hover:text-white py-2.5 pl-3 border-l-2 border-transparent hover:border-brand transition-all">Berichten</a>
        @else
            <div class="pt-3 mt-2 border-t border-white/10 flex flex-col gap-2">
                <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white py-2 pl-3">Inloggen</a>
                <a href="{{ route('register') }}" class="inline-block bg-brand text-black text-sm font-bold px-5 py-2.5 rounded-full text-center">Aanmelden</a>
            </div>
        @endauth
    </div>
</nav>
