<nav x-data="{ open: false }" class="sticky top-0 z-50 backdrop-blur-xl bg-dark/90 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="text-white font-black text-lg tracking-tight hover:opacity-80 transition-opacity">
            Junior<span class="text-brand">Dev</span>
        </a>

        {{-- Desktop nav --}}
        <div class="hidden md:flex items-center gap-7 text-sm text-gray-400">
            <a href="{{ route('jobs.index') }}"
                class="nav-link-hover hover:text-white transition {{ request()->routeIs('jobs.*') ? 'text-white nav-link-active' : '' }}">
                Vacatures
            </a>
            <a href="{{ route('leads.index') }}"
                class="nav-link-hover hover:text-white transition {{ request()->routeIs('leads.*') ? 'text-white nav-link-active' : '' }}">
                Bedrijven zonder site
            </a>
            @auth
                <a href="{{ route('dashboard') }}"
                    class="nav-link-hover hover:text-white transition {{ request()->routeIs('dashboard') ? 'text-white nav-link-active' : '' }}">
                    Dashboard
                </a>

                @if(auth()->user()->isStudent())
                    <a href="{{ route('student.applications.index') }}"
                        class="nav-link-hover hover:text-white transition {{ request()->routeIs('student.applications.*') ? 'text-white nav-link-active' : '' }}">
                        Reacties
                    </a>
                @endif

                @if(auth()->user()->isCompany())
                    <a href="{{ route('company.jobs.index') }}"
                        class="nav-link-hover hover:text-white transition {{ request()->routeIs('company.jobs.*') ? 'text-white nav-link-active' : '' }}">
                        Vacatures
                    </a>
                @endif

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.users') }}"
                        class="nav-link-hover hover:text-white transition {{ request()->routeIs('admin.users*') ? 'text-white nav-link-active' : '' }}">
                        Gebruikers
                    </a>
                    <a href="{{ route('admin.leads.index') }}"
                        class="nav-link-hover hover:text-white transition {{ request()->routeIs('admin.leads.*') ? 'text-white nav-link-active' : '' }}">
                        Leads
                    </a>
                @endif

                <a href="{{ route('messages.index') }}"
                    class="nav-link-hover hover:text-white transition flex items-center gap-1.5 {{ request()->routeIs('messages.*') ? 'text-white nav-link-active' : '' }}">
                    Berichten
                    @php $unread = \App\Models\Message::where('receiver_id', auth()->id())->whereNull('read_at')->count(); @endphp
                    @if($unread > 0)
                        <span class="bg-brand text-black text-xs font-bold rounded-full px-1.5 py-0.5 leading-none animate-pulse">{{ $unread }}</span>
                    @endif
                </a>
            @endauth
        </div>

        {{-- Right side --}}
        <div class="hidden md:flex items-center gap-3">
            @auth
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="flex items-center gap-2 text-sm text-gray-300 hover:text-white transition">
                        <div class="w-8 h-8 rounded-full bg-brand text-black font-bold flex items-center justify-center text-xs ring-2 ring-transparent hover:ring-brand/30 transition-all">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <svg class="w-3.5 h-3.5 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" x-cloak @click.away="open = false"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-44 bg-[#111]/95 backdrop-blur-xl border border-white/10 rounded-xl overflow-hidden shadow-[0_16px_48px_rgba(0,0,0,0.4)] z-50">
                        @if(auth()->user()->isStudent())
                            <a href="{{ route('student.profile.edit') }}" class="block px-4 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-white/5 transition">Mijn profiel</a>
                        @elseif(auth()->user()->isCompany())
                            <a href="{{ route('company.profile.edit') }}" class="block px-4 py-2.5 text-sm text-gray-300 hover:text-white hover:bg-white/5 transition">Bedrijfsprofiel</a>
                        @endif
                        <div class="border-t border-white/10">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-gray-400 hover:text-white hover:bg-white/5 transition">
                                    Uitloggen
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-400 hover:text-white transition">Inloggen</a>
                <a href="{{ route('register') }}" class="bg-brand text-black text-sm font-bold px-4 py-2 rounded-full hover:bg-brand-hover hover-glow transition press">
                    Registreren
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
        <a href="{{ route('jobs.index') }}" class="block text-sm text-gray-300 hover:text-white py-2.5 pl-3 border-l-2 {{ request()->routeIs('jobs.*') ? 'border-brand text-white' : 'border-transparent' }} transition-all">Vacatures</a>
        <a href="{{ route('leads.index') }}" class="block text-sm text-gray-300 hover:text-white py-2.5 pl-3 border-l-2 {{ request()->routeIs('leads.*') ? 'border-brand text-white' : 'border-transparent' }} transition-all">Bedrijven zonder site</a>
        @auth
            <a href="{{ route('dashboard') }}" class="block text-sm text-gray-300 hover:text-white py-2.5 pl-3 border-l-2 {{ request()->routeIs('dashboard') ? 'border-brand text-white' : 'border-transparent' }} transition-all">Dashboard</a>
            <a href="{{ route('messages.index') }}" class="block text-sm text-gray-300 hover:text-white py-2.5 pl-3 border-l-2 {{ request()->routeIs('messages.*') ? 'border-brand text-white' : 'border-transparent' }} transition-all">Berichten</a>
            @if(auth()->user()->isStudent())
                <a href="{{ route('student.applications.index') }}" class="block text-sm text-gray-300 hover:text-white py-2.5 pl-3 border-l-2 {{ request()->routeIs('student.applications.*') ? 'border-brand text-white' : 'border-transparent' }} transition-all">Mijn Reacties</a>
            @endif
            @if(auth()->user()->isCompany())
                <a href="{{ route('company.jobs.index') }}" class="block text-sm text-gray-300 hover:text-white py-2.5 pl-3 border-l-2 {{ request()->routeIs('company.jobs.*') ? 'border-brand text-white' : 'border-transparent' }} transition-all">Mijn Vacatures</a>
            @endif
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.users') }}" class="block text-sm text-gray-300 hover:text-white py-2.5 pl-3 border-l-2 {{ request()->routeIs('admin.users*') ? 'border-brand text-white' : 'border-transparent' }} transition-all">Gebruikers</a>
                <a href="{{ route('admin.leads.index') }}" class="block text-sm text-gray-300 hover:text-white py-2.5 pl-3 border-l-2 {{ request()->routeIs('admin.leads.*') ? 'border-brand text-white' : 'border-transparent' }} transition-all">Leads</a>
            @endif
            <div class="pt-2 mt-2 border-t border-white/10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-gray-400 hover:text-white py-2 pl-3">Uitloggen</button>
                </form>
            </div>
        @else
            <div class="pt-3 mt-2 border-t border-white/10 flex flex-col gap-2">
                <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white py-2 pl-3">Inloggen</a>
                <a href="{{ route('register') }}" class="inline-block bg-brand text-black text-sm font-bold px-4 py-2.5 rounded-full text-center mt-1">Registreren</a>
            </div>
        @endauth
    </div>
</nav>
