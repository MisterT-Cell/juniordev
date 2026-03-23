<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl tracking-tight">Gebruikersbeheer</h2>
    </x-slot>

    <div class="max-w-6xl mx-auto px-6 py-10">

        @if(session('success'))
            <div class="bg-[#c8f135]/20 border border-[#c8f135] text-gray-800 px-5 py-3.5 rounded-2xl text-sm font-medium mb-5">{{ session('success') }}</div>
        @endif

        <form method="GET" class="bg-white rounded-2xl border border-gray-200 p-5 mb-6 flex gap-3 items-end flex-wrap">
            <div class="flex-1 min-w-48">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Zoeken</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Naam..."
                    class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Rol</label>
                <select name="role" class="border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0">
                    <option value="">Alle rollen</option>
                    <option value="student" {{ request('role')==='student' ? 'selected':'' }}>Studenten</option>
                    <option value="company" {{ request('role')==='company' ? 'selected':'' }}>Bedrijven</option>
                    <option value="admin" {{ request('role')==='admin' ? 'selected':'' }}>Admins</option>
                </select>
            </div>
            <button type="submit" class="bg-[#0a0a0a] text-white text-sm font-bold px-5 py-2.5 rounded-full hover:bg-gray-800 transition">Zoeken</button>
        </form>

        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-100">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-widest">Naam</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-widest">E-mail</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-widest">Rol</th>
                        <th class="px-5 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-widest">Status</th>
                        <th class="px-5 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-widest">Acties</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($users as $user)
                    <tr class="{{ $user->is_blocked ? 'bg-red-50' : '' }}">
                        <td class="px-5 py-4 text-sm font-semibold text-gray-900">{{ $user->name }}</td>
                        <td class="px-5 py-4 text-sm text-gray-500">{{ $user->email }}</td>
                        <td class="px-5 py-4">
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full
                                {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : ($user->role === 'company' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600') }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full {{ $user->is_blocked ? 'bg-red-100 text-red-600' : 'bg-[#c8f135]/30 text-gray-700' }}">
                                {{ $user->is_blocked ? 'Geblokkeerd' : 'Actief' }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            @if($user->id !== auth()->id())
                            <div class="flex justify-end gap-2">
                                <form method="POST" action="{{ route('admin.users.block', $user) }}">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="text-xs font-semibold px-3 py-1.5 rounded-full {{ $user->is_blocked ? 'bg-[#c8f135]/30 text-gray-700 hover:bg-[#c8f135]/50' : 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200' }} transition">
                                        {{ $user->is_blocked ? 'Deblokkeren' : 'Blokkeren' }}
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                    onsubmit="return confirm('{{ $user->name }} verwijderen?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-xs font-semibold bg-red-50 text-red-600 px-3 py-1.5 rounded-full hover:bg-red-100 transition">
                                        Verwijderen
                                    </button>
                                </form>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-5">{{ $users->withQueryString()->links() }}</div>
    </div>
</x-app-layout>
