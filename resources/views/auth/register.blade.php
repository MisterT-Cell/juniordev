<x-guest-layout>

    <div class="mb-8">
        <h1 class="font-black text-2xl tracking-tight text-gray-900">Account aanmaken</h1>
        <p class="text-gray-400 text-sm mt-1">Gratis starten op JuniorDev</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5" x-data="{ role: '{{ old('role') }}' }">
        @csrf

        {{-- Role selection --}}
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-gray-500 mb-3">Ik ben een...</p>
            <div class="grid grid-cols-2 gap-3">

                <label class="cursor-pointer">
                    <input type="radio" name="role" value="student" x-model="role" class="sr-only" required />
                    <div :class="role === 'student'
                            ? 'border-[#0a0a0a] bg-[#0a0a0a] text-white'
                            : 'border-gray-200 bg-white text-gray-700 hover:border-gray-400'"
                        class="border-2 rounded-2xl p-4 transition text-center select-none">
                        <div class="text-2xl mb-2">🎓</div>
                        <p class="font-bold text-sm">Student</p>
                        <p class="text-xs opacity-60 mt-0.5">Junior developer</p>
                    </div>
                </label>

                <label class="cursor-pointer">
                    <input type="radio" name="role" value="company" x-model="role" class="sr-only" required />
                    <div :class="role === 'company'
                            ? 'border-[#c8f135] bg-[#c8f135] text-[#0a0a0a]'
                            : 'border-gray-200 bg-white text-gray-700 hover:border-gray-400'"
                        class="border-2 rounded-2xl p-4 transition text-center select-none">
                        <div class="text-2xl mb-2">🏢</div>
                        <p class="font-bold text-sm">Bedrijf</p>
                        <p class="text-xs opacity-60 mt-0.5">Vacatures plaatsen</p>
                    </div>
                </label>

            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-1.5" />
        </div>

        <div>
            <label for="name" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">
                Naam
            </label>
            <input id="name" type="text" name="name"
                value="{{ old('name') }}"
                required autofocus
                class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 bg-white"
                placeholder="Jan de Vries" />
            <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
        </div>

        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">
                E-mailadres
            </label>
            <input id="email" type="email" name="email"
                value="{{ old('email') }}"
                required
                class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 bg-white"
                placeholder="jij@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label for="password" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">
                    Wachtwoord
                </label>
                <input id="password" type="password" name="password"
                    required autocomplete="new-password"
                    class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 bg-white"
                    placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
            </div>
            <div>
                <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">
                    Bevestigen
                </label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                    required
                    class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 bg-white"
                    placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
            </div>
        </div>

        <button type="submit"
            class="w-full bg-[#0a0a0a] text-white font-bold py-3 rounded-full hover:bg-gray-800 transition text-sm">
            Account aanmaken
        </button>
    </form>

    <p class="text-center text-sm text-gray-400 mt-6">
        Al een account?
        <a href="{{ route('login') }}" class="text-gray-900 font-semibold hover:underline">
            Inloggen
        </a>
    </p>

</x-guest-layout>
