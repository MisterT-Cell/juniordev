<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.15em] text-gray-400 mb-1">Bedrijven zonder website</p>
            <h2 class="font-black text-2xl tracking-tight flex items-center gap-2">
                <span class="w-2 h-2 bg-brand rounded-full animate-pulse"></span>
                {{ $leads->total() }} {{ $leads->total() === 1 ? 'bedrijf' : 'bedrijven' }} gevonden
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-10">

        <!-- Filters -->
        <form method="GET" class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4 mb-6 flex flex-wrap gap-3 items-end">
            <div class="flex-1 min-w-52">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Zoeken</label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Zoek op naam, stad of categorie..."
                        class="w-full pl-9 border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-2 focus:ring-brand/20">
                </div>
            </div>
            <div class="min-w-44">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Stad</label>
                <select name="city" class="w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-2 focus:ring-brand/20 bg-white">
                    <option value="">Alle steden</option>
                    @foreach($cities as $city)
                        <option value="{{ $city }}" {{ request('city') === $city ? 'selected' : '' }}>{{ $city }}</option>
                    @endforeach
                </select>
            </div>
            <div class="min-w-40">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Categorie</label>
                <select name="category" class="w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-2 focus:ring-brand/20 bg-white">
                    <option value="">Alle categorieën</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center gap-2">
                <button type="submit"
                    class="bg-brand text-black text-sm font-bold px-5 py-2.5 rounded-full hover:bg-brand-hover hover-glow transition press">
                    Zoeken
                </button>
                @if(request('search') || request('city') || request('category'))
                    <a href="{{ route('leads.index') }}"
                        class="text-sm text-gray-400 hover:text-gray-700 transition px-3 py-2.5 inline-flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Wissen
                    </a>
                @endif
            </div>
        </form>

        {{-- Active filter pills --}}
        @if(request('search') || request('city') || request('category'))
            <div class="flex flex-wrap gap-2 mb-6">
                @if(request('search'))
                    <a href="{{ route('leads.index', array_filter([...request()->query(), 'search' => null])) }}"
                        class="inline-flex items-center gap-1.5 bg-brand/15 text-gray-700 text-xs font-semibold px-3 py-1.5 rounded-full hover:bg-brand/25 transition">
                        "{{ request('search') }}"
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </a>
                @endif
                @if(request('city'))
                    <a href="{{ route('leads.index', array_filter([...request()->query(), 'city' => null])) }}"
                        class="inline-flex items-center gap-1.5 bg-brand/15 text-gray-700 text-xs font-semibold px-3 py-1.5 rounded-full hover:bg-brand/25 transition">
                        {{ request('city') }}
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </a>
                @endif
                @if(request('category'))
                    <a href="{{ route('leads.index', array_filter([...request()->query(), 'category' => null])) }}"
                        class="inline-flex items-center gap-1.5 bg-brand/15 text-gray-700 text-xs font-semibold px-3 py-1.5 rounded-full hover:bg-brand/25 transition">
                        {{ request('category') }}
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </a>
                @endif
            </div>
        @endif

        {{-- RESULTS MET LAZY LOADING --}}
        @if($leads->isEmpty())
            <div class="bg-white rounded-2xl border border-gray-200 p-16 text-center">
                <div class="mb-5 flex justify-center">
                    <svg class="w-16 h-16 text-gray-200" viewBox="0 0 24 24" fill="currentColor"><path d="M14 8h1a1 1 0 0 0 0-2h-1a1 1 0 0 0 0 2Zm0 4h1a1 1 0 0 0 0-2h-1a1 1 0 0 0 0 2ZM9 8h1a1 1 0 0 0 0-2H9a1 1 0 0 0 0 2Zm0 4h1a1 1 0 0 0 0-2H9a1 1 0 0 0 0 2Zm12 8h-1V3a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v17H3a1 1 0 0 0 0 2h18a1 1 0 0 0 0-2Zm-8 0h-2v-4h2Zm5 0h-3v-5a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v5H6V4h12Z"/></svg>
                </div>
                <p class="text-lg font-bold text-gray-700 mb-1">Geen bedrijven gevonden</p>
                <p class="text-sm text-gray-400 mb-5">Probeer andere zoektermen of verwijder de filters.</p>
                <a href="{{ route('leads.index') }}" class="inline-block bg-dark text-white font-bold text-sm px-6 py-2.5 rounded-full hover:bg-gray-800 transition press">
                    Alle bedrijven bekijken
                </a>
            </div>
        @else
            <div x-data="lazyLeads()" x-init="init()">
                {{-- Eerste batch (server-side gerenderd) --}}
                <div id="leads-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @include('leads._cards')
                </div>

                {{-- Meer laden knop --}}
                <div class="text-center mt-8" x-show="nextPage !== null">
                    <button @click="loadMore()"
                        :disabled="loading"
                        class="bg-dark text-white text-sm font-bold px-8 py-3 rounded-full hover:bg-gray-800 transition disabled:opacity-50 inline-flex items-center gap-2 press">
                        <svg x-show="loading" class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                        </svg>
                        <span x-text="loading ? 'Laden...' : 'Meer laden'"></span>
                    </button>
                </div>

                <p class="text-center text-sm text-gray-400 mt-4" x-show="nextPage === null && loaded">
                    Alle bedrijven zijn geladen.
                </p>
            </div>

            <script>
                function lazyLeads() {
                    return {
                        nextPage: {{ $leads->hasMorePages() ? $leads->currentPage() + 1 : 'null' }},
                        loading: false,
                        loaded: false,

                        init() {
                            window.addEventListener('scroll', () => {
                                if (this.loading || this.nextPage === null) return;
                                const bottom = document.documentElement.scrollHeight - window.innerHeight - 200;
                                if (window.scrollY >= bottom) {
                                    this.loadMore();
                                }
                            });
                        },

                        async loadMore() {
                            if (this.loading || this.nextPage === null) return;
                            this.loading = true;

                            const params = new URLSearchParams(window.location.search);
                            params.set('page', this.nextPage);

                            try {
                                const response = await fetch(`{{ route('leads.load-more') }}?${params.toString()}`);
                                const data = await response.json();

                                document.getElementById('leads-grid').insertAdjacentHTML('beforeend', data.html);
                                this.nextPage = data.next_page;

                                if (this.nextPage === null) {
                                    this.loaded = true;
                                }
                            } catch (error) {
                                console.error('Fout bij laden:', error);
                            } finally {
                                this.loading = false;
                            }
                        }
                    };
                }
            </script>
        @endif

    </div>
</x-app-layout>
