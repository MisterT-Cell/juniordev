<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl tracking-tight">Opdrachtenbeheer</h2>
    </x-slot>

    <div class="max-w-6xl mx-auto px-6 py-10">

        @if(session('success'))
            <div class="bg-[#c8f135]/20 border border-[#c8f135] text-gray-800 px-5 py-3.5 rounded-2xl text-sm font-medium mb-5">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-100">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-widest">Titel</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-widest">Bedrijf</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-widest">Type</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-widest">Regio</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-widest">Status</th>
                        <th class="px-5 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-widest">Actie</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($assignments as $assignment)
                    <tr>
                        <td class="px-5 py-4 text-sm font-semibold text-gray-900">{{ $assignment->title }}</td>
                        <td class="px-5 py-4 text-sm text-gray-500">{{ $assignment->company->companyProfile->company_name ?? $assignment->company->name }}</td>
                        <td class="px-5 py-4 text-xs text-gray-500">{{ ucfirst($assignment->type) }}</td>
                        <td class="px-5 py-4 text-xs text-gray-500">{{ $assignment->region }}</td>
                        <td class="px-5 py-4">
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full {{ $assignment->status === 'open' ? 'bg-[#c8f135]/30 text-gray-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ $assignment->status === 'open' ? 'Open' : 'Gesloten' }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-right">
                            <form method="POST" action="{{ route('admin.assignments.destroy', $assignment) }}"
                                onsubmit="return confirm('Opdracht verwijderen?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs font-semibold bg-red-50 text-red-600 px-3 py-1.5 rounded-full hover:bg-red-100 transition">
                                    Verwijderen
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-5">{{ $assignments->links() }}</div>
    </div>
</x-app-layout>
