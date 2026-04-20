<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.15em] text-gray-400 mb-0.5">Beheerderspanel</p>
                <h2 class="font-black text-2xl tracking-tight">{{ auth()->user()->name }}</h2>
            </div>
            <a href="{{ route('admin.leads.index') }}"
                class="bg-[#0a0a0a] text-white text-sm font-bold px-5 py-2.5 rounded-full hover:bg-gray-800 transition inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                Leads scrapen
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-10 space-y-8">

        @if(session('success'))
            <div class="bg-[#c8f135]/20 border border-[#c8f135] text-gray-800 px-5 py-3.5 rounded-2xl text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        {{-- Stats strip --}}
        <div class="bg-[#0a0a0a] rounded-2xl overflow-hidden">
            <div class="grid grid-cols-3 md:grid-cols-5 divide-x divide-white/10">
                @foreach([
                    [$stats['students'],     'Studenten'],
                    [$stats['companies'],    'Bedrijven'],
                    [$stats['jobs'],         'Vacatures'],
                    [$stats['applications'], 'Reacties'],
                    [$stats['leads'],        'Leads'],
                ] as [$val, $label])
                <div class="px-4 py-5 md:px-6 md:py-7 text-center">
                    <div class="font-black text-2xl md:text-4xl tracking-tight leading-none text-[#c8f135]">{{ $val }}</div>
                    <div class="text-[10px] md:text-xs text-gray-500 uppercase tracking-widest mt-1.5">{{ $label }}</div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Beheerkaarten --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <a href="{{ route('admin.users') }}"
                class="card-hover bg-white border border-gray-200 rounded-2xl p-6 md:p-7 group">
                <div class="w-10 h-10 bg-[#0a0a0a] rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-[#c8f135]" viewBox="0 0 24 24" fill="currentColor"><path d="M12.3 12.22A4.92 4.92 0 0 0 14 8.5a5 5 0 0 0-10 0 4.92 4.92 0 0 0 1.7 3.72A8 8 0 0 0 1 19.5a1 1 0 1 0 2 0 6 6 0 0 1 12 0 1 1 0 0 0 2 0 8 8 0 0 0-4.7-7.28ZM9 11.5a3 3 0 1 1 0-6 3 3 0 0 1 0 6Zm9.74.32A5 5 0 0 0 15 3.5a1 1 0 0 0 0 2 3 3 0 0 1 3 3 3 3 0 0 1-1.5 2.59 1 1 0 0 0-.05 1.7l.39.26.13.07a7 7 0 0 1 4 6.38 1 1 0 0 0 2 0 9 9 0 0 0-4.23-7.68Z"/></svg>
                </div>
                <h3 class="font-black text-base mb-1 group-hover:text-[#0a0a0a] transition">Gebruikersbeheer</h3>
                <p class="text-gray-400 text-sm leading-relaxed">Bekijk, blokkeer of verwijder gebruikers.</p>
                <span class="inline-block mt-4 text-sm font-bold text-[#0a0a0a] group-hover:translate-x-1 transition-transform">Beheren &rarr;</span>
            </a>

            <a href="{{ route('admin.jobs') }}"
                class="card-hover bg-white border border-gray-200 rounded-2xl p-6 md:p-7 group">
                <div class="w-10 h-10 bg-[#0a0a0a] rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-[#c8f135]" viewBox="0 0 24 24" fill="currentColor"><path d="M19 6.5h-3v-1a3 3 0 0 0-3-3h-2a3 3 0 0 0-3 3v1H5a3 3 0 0 0-3 3v9a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-9a3 3 0 0 0-3-3Zm-9-1a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v1h-4Zm10 13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-5.61l3 .54V14.5a1 1 0 0 0 2 0v-1.28l2 .36V14.5a1 1 0 1 0 2 0v-.56l2-.36V14.5a1 1 0 0 0 2 0v-.93l3-.54Zm0-7.72-4 .72V11a1 1 0 0 0-2 0v.86l-2 .36V11.5a1 1 0 1 0-2 0v1.08l-2-.36V11.5a1 1 0 0 0-2 0v.36l-4-.72v-1.64a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1Z"/></svg>
                </div>
                <h3 class="font-black text-base mb-1 group-hover:text-[#0a0a0a] transition">Vacaturebeheer</h3>
                <p class="text-gray-400 text-sm leading-relaxed">Beheer alle vacatures op het platform.</p>
                <span class="inline-block mt-4 text-sm font-bold text-[#0a0a0a] group-hover:translate-x-1 transition-transform">Beheren &rarr;</span>
            </a>

            <a href="{{ route('admin.leads.index') }}"
                class="card-hover bg-white border border-gray-200 rounded-2xl p-6 md:p-7 group">
                <div class="w-10 h-10 bg-[#0a0a0a] rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-[#c8f135]" viewBox="0 0 24 24" fill="currentColor"><path d="M14 8h1a1 1 0 0 0 0-2h-1a1 1 0 0 0 0 2Zm0 4h1a1 1 0 0 0 0-2h-1a1 1 0 0 0 0 2ZM9 8h1a1 1 0 0 0 0-2H9a1 1 0 0 0 0 2Zm0 4h1a1 1 0 0 0 0-2H9a1 1 0 0 0 0 2Zm12 8h-1V3a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v17H3a1 1 0 0 0 0 2h18a1 1 0 0 0 0-2Zm-8 0h-2v-4h2Zm5 0h-3v-5a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v5H6V4h12Z"/></svg>
                </div>
                <h3 class="font-black text-base mb-1 group-hover:text-[#0a0a0a] transition">Bedrijven zonder site beheer</h3>
                <p class="text-gray-400 text-sm leading-relaxed">beheer bedrijven zonder website.</p>
                <span class="inline-block mt-4 text-sm font-bold text-[#0a0a0a] group-hover:translate-x-1 transition-transform">Beheren &rarr;</span>
            </a>

        </div>

    </div>
</x-app-layout>
