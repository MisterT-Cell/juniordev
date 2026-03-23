<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Beheerderspanel</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 text-center">
                    <div class="text-3xl font-bold text-indigo-600">{{ $stats['students'] }}</div>
                    <div class="text-gray-600 text-sm mt-1">Studenten</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 text-center">
                    <div class="text-3xl font-bold text-purple-600">{{ $stats['companies'] }}</div>
                    <div class="text-gray-600 text-sm mt-1">Bedrijven</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 text-center">
                    <div class="text-3xl font-bold text-green-600">{{ $stats['assignments'] }}</div>
                    <div class="text-gray-600 text-sm mt-1">Opdrachten</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200 text-center">
                    <div class="text-3xl font-bold text-yellow-500">{{ $stats['applications'] }}</div>
                    <div class="text-gray-600 text-sm mt-1">Reacties</div>
                </div>
            </div>

            <!-- Snelkoppelingen -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('admin.users') }}" class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                    <h3 class="font-semibold text-gray-900 mb-2">Gebruikersbeheer</h3>
                    <p class="text-gray-600 text-sm">Bekijk, blokkeer of verwijder gebruikers.</p>
                </a>
                <a href="{{ route('admin.assignments') }}" class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                    <h3 class="font-semibold text-gray-900 mb-2">Opdrachtenbeheer</h3>
                    <p class="text-gray-600 text-sm">Beheer alle opdrachten op het platform.</p>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
