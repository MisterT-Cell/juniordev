<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Gebruikersbeheer</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <!-- Filters -->
            <form method="GET" class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-4 flex gap-3 items-end">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Zoek op naam..."
                        class="w-full border-gray-300 rounded-md shadow-sm text-sm">
                </div>
                <div>
                    <select name="role" class="border-gray-300 rounded-md shadow-sm text-sm">
                        <option value="">Alle rollen</option>
                        <option value="student" {{ request('role') === 'student' ? 'selected' : '' }}>Studenten</option>
                        <option value="company" {{ request('role') === 'company' ? 'selected' : '' }}>Bedrijven</option>
                        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Beheerders</option>
                    </select>
                </div>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm hover:bg-indigo-700">Zoeken</button>
            </form>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Naam</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">E-mail</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aangemeld</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acties</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($users as $user)
                        <tr class="{{ $user->is_blocked ? 'bg-red-50' : '' }}">
                            <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $user->email }}</td>
                            <td class="px-4 py-3">
                                <span class="text-xs px-2 py-1 rounded
                                    {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : ($user->role === 'company' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600') }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="text-xs px-2 py-1 rounded {{ $user->is_blocked ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                    {{ $user->is_blocked ? 'Geblokkeerd' : 'Actief' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-xs text-gray-400">{{ $user->created_at->format('d-m-Y') }}</td>
                            <td class="px-4 py-3 text-right">
                                @if($user->id !== auth()->id())
                                <div class="flex justify-end gap-2">
                                    <form method="POST" action="{{ route('admin.users.block', $user) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-xs px-2 py-1 rounded {{ $user->is_blocked ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200' }}">
                                            {{ $user->is_blocked ? 'Deblokkeren' : 'Blokkeren' }}
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                        onsubmit="return confirm('Gebruiker {{ $user->name }} permanent verwijderen?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs px-2 py-1 rounded bg-red-100 text-red-700 hover:bg-red-200">
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

            <div class="mt-4">{{ $users->withQueryString()->links() }}</div>
        </div>
    </div>
</x-app-layout>
