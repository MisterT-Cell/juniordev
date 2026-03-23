<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <span class="text-2xl font-black text-indigo-600">Junior<span class="text-gray-800">Dev</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('assignments.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('assignments.*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium transition">
                        Opdrachten
                    </a>

                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('dashboard') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium transition">
                            Dashboard
                        </a>

                        @if(auth()->user()->isStudent())
                            <a href="{{ route('student.applications.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('student.applications.*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium transition">
                                Mijn Reacties
                            </a>
                        @endif

                        @if(auth()->user()->isCompany())
                            <a href="{{ route('company.assignments.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('company.assignments.*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium transition">
                                Mijn Opdrachten
                            </a>
                        @endif

                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.users') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium transition">
                                Beheer
                            </a>
                        @endif

                        <a href="{{ route('messages.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('messages.*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium transition">
                            Berichten
                            @php
                                $unread = \App\Models\Message::where('receiver_id', auth()->id())->whereNull('read_at')->count();
                            @endphp
                            @if($unread > 0)
                                <span class="ml-1 inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full">{{ $unread }}</span>
                            @endif
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Right side -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @guest
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900 font-medium mr-4">Inloggen</a>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                        Registreren
                    </a>
                @else
                    <div class="ms-3 relative" x-data="{ open: false }">
                        <button @click="open = !open" class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-100 transition">
                            <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center">
                                <span class="text-indigo-600 font-bold text-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                            </div>
                            <span>{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>

                        <div x-show="open" @click.outside="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-xs text-gray-500">Ingelogd als</p>
                                <p class="text-sm font-semibold text-gray-800 truncate">{{ auth()->user()->email }}</p>
                                <span class="inline-block mt-1 px-2 py-0.5 text-xs rounded-full {{ auth()->user()->isStudent() ? 'bg-blue-100 text-blue-700' : (auth()->user()->isCompany() ? 'bg-green-100 text-green-700' : 'bg-purple-100 text-purple-700') }}">
                                    {{ ucfirst(auth()->user()->role) }}
                                </span>
                            </div>

                            @if(auth()->user()->isStudent())
                                <a href="{{ route('student.profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Mijn Profiel</a>
                            @endif
                            @if(auth()->user()->isCompany())
                                <a href="{{ route('company.profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Bedrijfsprofiel</a>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    Uitloggen
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('assignments.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('assignments.*') ? 'border-indigo-500 text-indigo-700 bg-indigo-50' : 'border-transparent text-gray-600 hover:bg-gray-50' }} text-base font-medium">Opdrachten</a>
            @auth
                <a href="{{ route('dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:bg-gray-50 text-base font-medium">Dashboard</a>
                <a href="{{ route('messages.index') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:bg-gray-50 text-base font-medium">Berichten</a>
                @if(auth()->user()->isStudent())
                    <a href="{{ route('student.profile.edit') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:bg-gray-50 text-base font-medium">Mijn Profiel</a>
                    <a href="{{ route('student.applications.index') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:bg-gray-50 text-base font-medium">Mijn Reacties</a>
                @endif
                @if(auth()->user()->isCompany())
                    <a href="{{ route('company.profile.edit') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:bg-gray-50 text-base font-medium">Bedrijfsprofiel</a>
                    <a href="{{ route('company.assignments.index') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:bg-gray-50 text-base font-medium">Mijn Opdrachten</a>
                @endif
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.users') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:bg-gray-50 text-base font-medium">Beheer</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left pl-3 pr-4 py-2 border-l-4 border-transparent text-red-600 hover:bg-red-50 text-base font-medium">Uitloggen</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:bg-gray-50 text-base font-medium">Inloggen</a>
                <a href="{{ route('register') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:bg-gray-50 text-base font-medium">Registreren</a>
            @endguest
        </div>
    </div>
</nav>
