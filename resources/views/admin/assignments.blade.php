<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Opdrachtenbeheer</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Titel</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bedrijf</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Regio</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acties</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($assignments as $assignment)
                        <tr>
                            <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $assignment->title }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $assignment->company->companyProfile->company_name ?? $assignment->company->name }}</td>
                            <td class="px-4 py-3 text-xs text-gray-500">{{ ucfirst($assignment->type) }}</td>
                            <td class="px-4 py-3 text-xs text-gray-500">{{ $assignment->region }}</td>
                            <td class="px-4 py-3">
                                <span class="text-xs px-2 py-1 rounded {{ $assignment->status === 'open' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $assignment->status === 'open' ? 'Open' : 'Gesloten' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <form method="POST" action="{{ route('admin.assignments.destroy', $assignment) }}"
                                    onsubmit="return confirm('Opdracht verwijderen?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs px-2 py-1 rounded bg-red-100 text-red-700 hover:bg-red-200">
                                        Verwijderen
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $assignments->links() }}</div>
        </div>
    </div>
</x-app-layout>
