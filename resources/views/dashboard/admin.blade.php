<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl tracking-tight">Beheerderspanel</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-10 space-y-6">

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl border border-gray-200 p-6 text-center">
                <div class="text-4xl font-black tracking-tight text-indigo-600">{{ $stats['students'] }}</div>
                <div class="text-sm text-gray-500 mt-1">Studenten</div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6 text-center">
                <div class="text-4xl font-black tracking-tight text-purple-600">{{ $stats['companies'] }}</div>
                <div class="text-sm text-gray-500 mt-1">Bedrijven</div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6 text-center">
                <div class="text-4xl font-black tracking-tight text-[#5a7a00]">{{ $stats['assignments'] }}</div>
                <div class="text-sm text-gray-500 mt-1">Opdrachten</div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6 text-center">
                <div class="text-4xl font-black tracking-tight text-yellow-600">{{ $stats['applications'] }}</div>
                <div class="text-sm text-gray-500 mt-1">Reacties</div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <a href="{{ route('admin.users') }}" class="card-hover bg-[#0a0a0a] text-white rounded-2xl p-8 group">
                <h3 class="font-black text-xl mb-2 group-hover:text-[#c8f135] transition">Gebruikersbeheer</h3>
                <p class="text-gray-400 text-sm">Bekijk, blokkeer of verwijder gebruikers van het platform.</p>
                <span class="inline-block mt-5 text-sm font-bold text-[#c8f135]">Beheren &rarr;</span>
            </a>
            <a href="{{ route('admin.assignments') }}" class="card-hover bg-white border border-gray-200 rounded-2xl p-8 group">
                <h3 class="font-black text-xl mb-2 group-hover:text-indigo-600 transition">Opdrachtenbeheer</h3>
                <p class="text-gray-400 text-sm">Beheer alle opdrachten die op het platform staan.</p>
                <span class="inline-block mt-5 text-sm font-bold text-indigo-600">Beheren &rarr;</span>
            </a>
        </div>

    </div>
</x-app-layout>
