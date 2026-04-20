<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-black text-2xl tracking-tight">Leads beheer</h2>
            <div class="flex gap-2">
                <a href="{{ route('admin.leads.create') }}"
                    class="bg-[#0a0a0a] text-white text-sm font-bold px-5 py-2.5 rounded-full hover:bg-gray-800 transition inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    Toevoegen
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto px-6 py-10">

        @if(session('success'))
            <div class="bg-[#c8f135]/20 border border-[#c8f135] text-gray-800 px-5 py-3.5 rounded-2xl text-sm font-medium mb-5">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-3.5 rounded-2xl text-sm font-medium mb-5">{{ session('error') }}</div>
        @endif

        {{-- Scrapen via OpenStreetMap --}}
        <form method="POST" action="{{ route('admin.leads.scrape') }}"
            class="bg-white rounded-2xl border border-gray-200 p-5 mb-6">
            @csrf
            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-3">Bedrijven zoeken via OpenStreetMap</label>
            <div class="flex gap-3 items-end flex-wrap">
                <div class="min-w-44">
                    <label class="block text-xs text-gray-400 mb-1.5">Provincie</label>
                    <select name="provincie" required class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 bg-white">
                        <option value="">Kies provincie...</option>
                        @foreach(['groningen','friesland','drenthe','overijssel','flevoland','gelderland','utrecht','noord-holland','zuid-holland','zeeland','noord-brabant','limburg'] as $prov)
                            <option value="{{ $prov }}" {{ old('provincie') === $prov ? 'selected' : '' }}>{{ ucfirst($prov) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="min-w-44">
                    <label class="block text-xs text-gray-400 mb-1.5">Categorie</label>
                    <select name="category" required class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 bg-white">
                        <option value="">Kies categorie...</option>
                        <optgroup label="Bouw & installatie">
                            <option value="schilder">Schilder</option>
                            <option value="timmerman">Timmerman</option>
                            <option value="installateur">Installateur</option>
                            <option value="elektricien">Elektricien</option>
                            <option value="loodgieter">Loodgieter</option>
                            <option value="dakdekker">Dakdekker</option>
                            <option value="stukadoor">Stukadoor</option>
                            <option value="metselaar">Metselaar</option>
                            <option value="aannemer">Aannemer</option>
                            <option value="hvac">HVAC / Klimaat</option>
                        </optgroup>
                        <optgroup label="Horeca & winkels">
                            <option value="restaurant">Restaurant</option>
                            <option value="cafe">Café</option>
                            <option value="bar">Bar</option>
                            <option value="kapper">Kapper</option>
                            <option value="bakker">Bakker</option>
                            <option value="slager">Slager</option>
                            <option value="garage">Garage</option>
                            <option value="bloemist">Bloemist</option>
                            <option value="fietsen">Fietsenmaker</option>
                            <option value="schoonheid">Schoonheidssalon</option>
                            <option value="apotheek">Apotheek</option>
                            <option value="tandarts">Tandarts</option>
                            <option value="gym">Sportschool</option>
                        </optgroup>
                    </select>
                </div>
                <div class="w-24">
                    <label class="block text-xs text-gray-400 mb-1.5">Max</label>
                    <input type="number" name="limit" value="100" min="1" max="500"
                        class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0">
                </div>
                <button type="submit" class="bg-[#c8f135] text-black text-sm font-bold px-5 py-2.5 rounded-full hover:bg-[#d4f54e] transition inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Scrapen
                </button>
            </div>
        </form>

        {{-- Zoeken + CSV import --}}
        <div class="flex gap-4 mb-6 flex-wrap">
            <form method="GET" class="flex-1 bg-white rounded-2xl border border-gray-200 p-5 flex gap-3 items-end flex-wrap">
                <div class="flex-1 min-w-48">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Zoeken</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Bedrijfsnaam of stad..."
                        class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0">
                </div>
                <button type="submit" class="bg-[#0a0a0a] text-white text-sm font-bold px-5 py-2.5 rounded-full hover:bg-gray-800 transition">Zoeken</button>
            </form>

            <form method="POST" action="{{ route('admin.leads.import') }}" enctype="multipart/form-data"
                class="bg-white rounded-2xl border border-gray-200 p-5 flex gap-3 items-end flex-wrap">
                @csrf
                <div class="min-w-48">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">CSV importeren</label>
                    <input type="file" name="csv_file" accept=".csv,.txt"
                        class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                </div>
                <button type="submit" class="bg-[#0a0a0a] text-white text-sm font-bold px-5 py-2.5 rounded-full hover:bg-gray-800 transition">Importeren</button>
            </form>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-100">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-widest">Bedrijf</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-widest">Stad</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-widest">Categorie</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-widest">Telefoon</th>
                        <th class="px-5 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-widest">Acties</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($leads as $lead)
                    <tr>
                        <td class="px-5 py-4 text-sm font-semibold text-gray-900">{{ $lead->business_name }}</td>
                        <td class="px-5 py-4 text-sm text-gray-500">{{ $lead->city ?? '-' }}</td>
                        <td class="px-5 py-4">
                            @if($lead->category)
                                <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-blue-100 text-blue-700">{{ $lead->category }}</span>
                            @else
                                <span class="text-xs text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-sm text-gray-500">{{ $lead->phone ?? '-' }}</td>
                        <td class="px-5 py-4">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.leads.edit', $lead) }}"
                                    class="text-xs font-semibold bg-gray-100 text-gray-700 px-3 py-1.5 rounded-full hover:bg-gray-200 transition">
                                    Bewerken
                                </a>
                                <form method="POST" action="{{ route('admin.leads.destroy', $lead) }}"
                                    onsubmit="return confirm('{{ $lead->business_name }} verwijderen?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs font-semibold bg-red-50 text-red-600 px-3 py-1.5 rounded-full hover:bg-red-100 transition">
                                        Verwijderen
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-5 py-10 text-center text-sm text-gray-400">
                            Nog geen leads. Voer <code class="bg-gray-100 px-1.5 py-0.5 rounded">php artisan leads:scrape</code> uit om automatisch bedrijven te vinden.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">{{ $leads->withQueryString()->links() }}</div>
    </div>
</x-app-layout>
