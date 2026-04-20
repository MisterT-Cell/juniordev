<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.15em] text-gray-400 mb-1">Bedrijven zonder website</p>
            <h2 class="font-black text-2xl tracking-tight">
                {{ $leads->total() }} {{ $leads->total() === 1 ? 'bedrijf' : 'bedrijven' }} gevonden
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-10">

        <!-- Filters voor het zoeken -->
        <form method="GET" class="bg-white rounded-2xl border border-gray-200 p-4 mb-8 flex flex-wrap gap-3 items-end">
            <div class="flex-1 min-w-52">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Zoeken</label>
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Zoek op naam, stad of categorie..."
                        class="w-full pl-9 border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0">
                </div>
            </div>
            <div class="min-w-44">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Stad</label>
                <select name="city" class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 bg-white">
                    <option value="">Alle steden</option>
                    @foreach($cities as $city)
                        <option value="{{ $city }}" {{ request('city') === $city ? 'selected' : '' }}>{{ $city }}</option>
                    @endforeach
                </select>
            </div>
            <div class="min-w-40">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1.5">Categorie</label>
                <select name="category" class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 bg-white">
                    <option value="">Alle categorieën</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center gap-2">
                <button type="submit"
                    class="bg-[#0a0a0a] text-white text-sm font-bold px-5 py-2.5 rounded-full hover:bg-gray-800 transition">
                    Zoeken
                </button>
                @if(request('search') || request('city') || request('category'))
                    <a href="{{ route('leads.index') }}"
                        class="text-sm text-gray-400 hover:text-gray-700 transition px-3 py-2.5">
                        Wissen
                    </a>
                @endif
            </div>
        </form>

        {{-- ─── RESULTS MET LAZY LOADING ──────────────────── --}}
        @if($leads->isEmpty())
            <div class="text-center py-28 text-gray-400">
                <div class="text-5xl mb-4">🏢</div>
                <p class="text-lg font-semibold text-gray-600 mb-1">Geen bedrijven gevonden</p>
                <p class="text-sm">Probeer andere zoektermen of verwijder de filters.</p>
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
                        class="bg-[#0a0a0a] text-white text-sm font-bold px-8 py-3 rounded-full hover:bg-gray-800 transition disabled:opacity-50 inline-flex items-center gap-2">
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
                            // Optioneel: auto-load bij scrollen naar onderkant
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
