<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl tracking-tight">Berichtenbeheer</h2>
    </x-slot>

    <div class="max-w-6xl mx-auto px-6 py-10">

        @if(session('success'))
            <div class="bg-[#c8f135]/20 border border-[#c8f135] text-gray-800 px-5 py-3.5 rounded-2xl text-sm font-medium mb-5">{{ session('success') }}</div>
        @endif

        <form method="GET" class="bg-white rounded-2xl border border-gray-200 p-5 mb-6 flex gap-3 items-end flex-wrap">
            <div class="flex-1 min-w-48">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Zoeken op onderwerp</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Onderwerp..."
                    class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0">
            </div>
            <button type="submit" class="bg-[#0a0a0a] text-white text-sm font-bold px-5 py-2.5 rounded-full hover:bg-gray-800 transition">Zoeken</button>
        </form>

        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-100">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-widest">Van</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-widest">Naar</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-widest">Onderwerp</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-widest">Status</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-widest">Datum</th>
                        <th class="px-5 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-widest">Acties</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($messages as $message)
                    <tr class="{{ !$message->read_at ? 'bg-blue-50' : '' }}">
                        <td class="px-5 py-4 text-sm font-semibold text-gray-900">{{ $message->sender->name ?? '—' }}</td>
                        <td class="px-5 py-4 text-sm text-gray-600">{{ $message->receiver->name ?? '—' }}</td>
                        <td class="px-5 py-4 text-sm text-gray-800">{{ $message->subject }}</td>
                        <td class="px-5 py-4">
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full {{ $message->read_at ? 'bg-gray-100 text-gray-500' : 'bg-blue-100 text-blue-700' }}">
                                {{ $message->read_at ? 'Gelezen' : 'Ongelezen' }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-sm text-gray-400">{{ $message->created_at->format('d-m-Y H:i') }}</td>
                        <td class="px-5 py-4 flex justify-end gap-2">
                            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}"
                                onsubmit="return confirm('Dit bericht verwijderen?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs font-semibold bg-red-50 text-red-600 px-3 py-1.5 rounded-full hover:bg-red-100 transition">
                                    Verwijderen
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-10 text-center text-sm text-gray-400">Geen berichten gevonden.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">{{ $messages->withQueryString()->links() }}</div>
    </div>
</x-app-layout>
