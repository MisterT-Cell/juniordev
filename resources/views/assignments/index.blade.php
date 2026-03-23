<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Opdrachten</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Filters -->
            <form method="GET" class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6 flex flex-wrap gap-3 items-end">
                <div class="flex-1 min-w-48">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Zoeken</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Zoek op titel..."
                        class="w-full border-gray-300 rounded-md shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div class="min-w-40">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Regio</label>
                    <select name="region" class="w-full border-gray-300 rounded-md shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Alle regio's</option>
                        @foreach($regions as $region)
                            <option value="{{ $region }}" {{ request('region') === $region ? 'selected' : '' }}>{{ $region }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="min-w-40">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                    <select name="type" class="w-full border-gray-300 rounded-md shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Alle types</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}" {{ request('type') === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm hover:bg-indigo-700">Zoeken</button>
                @if(request('search') || request('region') || request('type'))
                    <a href="{{ route('assignments.index') }}" class="text-sm text-gray-600 hover:underline self-center">Wis filters</a>
                @endif
            </form>

            @if($assignments->isEmpty())
                <div class="text-center py-12 text-gray-500">
                    <p class="text-lg">Geen opdrachten gevonden.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($assignments as $assignment)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition flex flex-col">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-xs font-medium bg-indigo-100 text-indigo-700 px-2 py-1 rounded">{{ ucfirst($assignment->type) }}</span>
                            <span class="text-xs text-gray-500">{{ $assignment->region }}</span>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">{{ $assignment->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4 flex-1">{{ Str::limit($assignment->description, 120) }}</p>
                        <div class="border-t border-gray-100 pt-3 flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-gray-700">{{ $assignment->company->companyProfile->company_name ?? $assignment->company->name }}</p>
                                <p class="text-xs text-gray-400">{{ $assignment->applications->count() ?? 0 }} reacties &bull; {{ $assignment->created_at->diffForHumans() }}</p>
                            </div>
                            <a href="{{ route('assignments.show', $assignment) }}"
                                class="text-sm bg-indigo-600 text-white px-3 py-1.5 rounded hover:bg-indigo-700 transition">
                                Bekijk
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-6">{{ $assignments->withQueryString()->links() }}</div>
            @endif
        </div>
    </div>
</x-app-layout>
