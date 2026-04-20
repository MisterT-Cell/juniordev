<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl tracking-tight">Bedrijf bewerken</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto px-6 py-10">
        <form method="POST" action="{{ route('admin.leads.update', $lead) }}" class="bg-white rounded-2xl border border-gray-200 p-8 space-y-6">
            @csrf @method('PUT')

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Bedrijfsnaam *</label>
                <input type="text" name="business_name" value="{{ old('business_name', $lead->business_name) }}" required
                    class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0">
                @error('business_name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Adres</label>
                    <input type="text" name="address" value="{{ old('address', $lead->address) }}"
                        class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Stad</label>
                    <input type="text" name="city" value="{{ old('city', $lead->city) }}"
                        class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Telefoon</label>
                    <input type="text" name="phone" value="{{ old('phone', $lead->phone) }}"
                        class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">Categorie</label>
                    <input type="text" name="category" value="{{ old('category', $lead->category) }}"
                        class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0">
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="bg-[#0a0a0a] text-white text-sm font-bold px-6 py-2.5 rounded-full hover:bg-gray-800 transition">
                    Bijwerken
                </button>
                <a href="{{ route('admin.leads.index') }}" class="text-sm text-gray-400 hover:text-gray-700 transition px-4 py-2.5">
                    Annuleren
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
