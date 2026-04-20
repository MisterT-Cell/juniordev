<nav x-data="{ open: false }" class="bg-[#0a0a0a] border-b border-white/10">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="text-white font-black text-lg tracking-tight">
            Junior<span class="text-[#c8f135]">Dev</span>
        </a>

        {{-- Desktop nav --}}
        <div class="hidden md:flex items-center gap-7 text-sm text-gray-400">
            <a href="{{ route('jobs.index') }}"
                class="hover:text-white transition {{ request()->routeIs('jobs.*') ? 'text-white' : '' }}">
                Vacatures
            </a>
            <a href="{{ route('leads.index') }}"
                class="hover:text-white transition {{ request()->routeIs('leads.*') ? 'text-white' : '' }}">
                Bedrijven zonder site
            </a>
            @auth
                <a href="{{ route('dashboard') }}"
                    class="hover:text-white transition {{ request()->routeIs('dashboard') ? 'text-white' : '' }}">
                    Dashboard
                </a>

                @if(auth()->user()->isStudent())
                    <a href="{{ route('student.applications.index') }}"
                        class="hover:text-white transition {{ request()->routeIs('student.applications.*') ? 'text-white' : '' }}">
                        Reacties
                    </a>
                @endif

                @if(auth()->user()->isCompany())
                    <a href="{{ route('company.jobs.index') }}"
                        class="hover:text-white transition {{ request()->routeIs('company.jobs.*') ? 'text-white' : '' }}">
                        Vacatures
                    </a>
                @endif

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.users') }}"
                        class="hover:text-white transition {{ request()->routeIs('admin.*') ? 'text-white' : '' }}">
                        Beheer
                    </a>
                @endif

                <a href="{{ route('messages.index') }}"
                    class="hover:text-white transition flex items-center gap-1.5 {{ request()->routeIs('messages.*') ? 'text-white' : '' }}">
                    Berichten
                    @php $unread = \App\Models\Message::where('receiver_id', auth()->id())->whereNull('read_at')->count(); @endphp
                    @if($unread > 0)
                        <span class="bg-[#c8f135] text-black text-xs font-bold rounded-full px-1.5 py-0.5 leading-none">{{ $unread }}</span>
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
                        <div class="w-8 h-8 rounded-full bg-[#c8f135] text-black font-bold flex items-center justify-center text-xs">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition
                        class="absolute right-0 mt-2 w-44 bg-[#111] border border-white/10 rounded-xl overflow-hidden shadow-xl z-50">
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
                <a href="{{ route('register') }}" class="bg-[#c8f135] text-black text-sm font-bold px-4 py-2 rounded-full hover:bg-[#d4f54e] transition">
                    Registreren
                </a>
            @endauth
        </div>

        {{-- Mobile hamburger --}}
        <button @click="open = !open" class="md:hidden text-gray-400 hover:text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path :class="{'hidden': open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                <path :class="{'hidden': !open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Mobile menu --}}
    <div :class="{'block': open, 'hidden': !open}" class="hidden md:hidden border-t border-white/10 px-6 py-4 space-y-3">
        <a href="{{ route('jobs.index') }}" class="block text-sm text-gray-300 hover:text-white py-1">Vacatures</a>
        <a href="{{ route('leads.index') }}" class="block text-sm text-gray-300 hover:text-white py-1">Bedrijven zonder site</a>
        @auth
            <a href="{{ route('dashboard') }}" class="block text-sm text-gray-300 hover:text-white py-1">Dashboard</a>
            <a href="{{ route('messages.index') }}" class="block text-sm text-gray-300 hover:text-white py-1">Berichten</a>
            @if(auth()->user()->isStudent())
                <a href="{{ route('student.applications.index') }}" class="block text-sm text-gray-300 hover:text-white py-1">Mijn Reacties</a>
            @endif
            @if(auth()->user()->isCompany())
                <a href="{{ route('company.jobs.index') }}" class="block text-sm text-gray-300 hover:text-white py-1">Mijn Vacatures</a>
            @endif
            <div class="pt-2 border-t border-white/10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-gray-400 hover:text-white py-1">Uitloggen</button>
                </form>
            </div>
        @else
            <a href="{{ route('login') }}" class="block text-sm text-gray-300 hover:text-white py-1">Inloggen</a>
            <a href="{{ route('register') }}" class="inline-block bg-[#c8f135] text-black text-sm font-bold px-4 py-2 rounded-full mt-1">Registreren</a>
        @endauth
    </div>
</nav>
