<x-guest-layout>

    <div class="mb-8">
        <h1 class="font-black text-2xl tracking-tight text-gray-900">Welkom terug</h1>
        <p class="text-gray-400 text-sm mt-1">Log in op je JuniorDev account</p>
    </div>

    <x-auth-session-status class="mb-5" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-widest text-gray-500 mb-2">
                E-mailadres
            </label>
            <input id="email" type="email" name="email"
                value="{{ old('email') }}"
                required autofocus autocomplete="username"
                class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 bg-white"
                placeholder="jij@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <div>
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-xs font-bold uppercase tracking-widest text-gray-500">
                    Wachtwoord
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-xs text-gray-400 hover:text-gray-700 transition">
                        Wachtwoord vergeten?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password"
                required autocomplete="current-password"
                class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 bg-white"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <div class="flex items-center gap-2.5">
            <input id="remember_me" type="checkbox" name="remember"
                class="rounded border-gray-300 text-[#0a0a0a] focus:ring-[#0a0a0a] w-4 h-4" />
            <label for="remember_me" class="text-sm text-gray-500 cursor-pointer select-none">
                Onthoud mij
            </label>
        </div>

        <button type="submit"
            class="w-full bg-[#0a0a0a] text-white font-bold py-3 rounded-full hover:bg-gray-800 transition text-sm">
            Inloggen
        </button>
    </form>

    <p class="text-center text-sm text-gray-400 mt-6">
        Nog geen account?
        <a href="{{ route('register') }}" class="text-gray-900 font-semibold hover:underline">
            Registreren
        </a>
    </p>

</x-guest-layout>
