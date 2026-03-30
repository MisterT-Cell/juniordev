<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 flex-wrap">
            <a href="{{ route('jobs.index') }}" class="text-gray-400 hover:text-gray-700 text-sm">&larr; Terug</a>
            <span class="text-gray-300">/</span>
            <h2 class="font-black text-2xl tracking-tight">{{ $job->title }}</h2>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-6 py-10 space-y-5">

        @if(session('success'))
            <div class="bg-[#c8f135]/20 border border-[#c8f135] text-gray-800 px-5 py-3.5 rounded-2xl text-sm font-medium">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-3.5 rounded-2xl text-sm font-medium">{{ session('error') }}</div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-200 p-8">

            {{-- Meta --}}
            <div class="flex flex-wrap gap-2 mb-6">
                <span class="text-xs font-bold uppercase tracking-widest bg-gray-100 text-gray-600 px-3 py-1.5 rounded-full">{{ ucfirst($job->type) }}</span>
                <span class="text-xs font-bold uppercase tracking-widest bg-gray-100 text-gray-600 px-3 py-1.5 rounded-full">{{ $job->region }}</span>
                <span class="text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded-full {{ $job->status === 'open' ? 'bg-[#c8f135]/30 text-gray-800' : 'bg-red-100 text-red-600' }}">
                    {{ $job->status === 'open' ? 'Open' : 'Gesloten' }}
                </span>
            </div>

            <div class="flex justify-between items-start gap-4 mb-8 pb-8 border-b border-gray-100">
                <div>
                    <p class="text-sm text-gray-500 mb-0.5">Geplaatst door</p>
                    <p class="font-bold text-gray-900">{{ $job->company->companyProfile->company_name ?? $job->company->name }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500 mb-0.5">Reacties</p>
                    <p class="font-bold text-gray-900">{{ $job->applications->count() }}</p>
                </div>
            </div>

            {{-- Description --}}
            <div class="mb-8">
                <h3 class="font-black text-lg mb-4">Beschrijving</h3>
                <div class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $job->description }}</div>
            </div>

            @if($job->requirements)
            <div class="mb-8">
                <h3 class="font-black text-lg mb-4">Vereisten</h3>
                <div class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $job->requirements }}</div>
            </div>
            @endif

            {{-- Apply --}}
            @auth
                @if(auth()->user()->isStudent())
                    @if($hasApplied)
                        <div class="bg-[#c8f135]/20 border border-[#c8f135] rounded-2xl p-5">
                            <p class="font-bold text-gray-800 mb-1">Je hebt al gereageerd op deze vacature.</p>
                            <a href="{{ route('student.applications.index') }}" class="text-sm text-gray-600 underline">Bekijk je reacties</a>
                        </div>
                    @elseif($job->status === 'open')
                        <div class="border-t border-gray-100 pt-8">
                            <h3 class="font-black text-lg mb-6">Reageer op deze vacature</h3>
                            <form method="POST" action="{{ route('applications.store', $job) }}">
                                @csrf
                                <div class="mb-5">
                                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">
                                        Motivatie <span class="normal-case font-normal text-gray-400">(minimaal 50 tekens)</span>
                                    </label>
                                    <textarea name="motivation" rows="6" required minlength="50"
                                        class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 resize-none"
                                        placeholder="Vertel waarom jij de juiste kandidaat bent...">{{ old('motivation') }}</textarea>
                                    <x-input-error :messages="$errors->get('motivation')" class="mt-2" />
                                </div>
                                <button type="submit" class="bg-[#0a0a0a] text-white font-bold px-6 py-3 rounded-full hover:bg-gray-800 transition text-sm">
                                    Reactie versturen
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5 text-gray-500 text-sm">
                            Deze vacature is gesloten voor nieuwe reacties.
                        </div>
                    @endif
                @endif
            @else
                <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5">
                    <p class="text-gray-700 text-sm">
                        <a href="{{ route('login') }}" class="font-bold underline">Log in</a> of
                        <a href="{{ route('register') }}" class="font-bold underline">registreer</a> om te reageren.
                    </p>
                </div>
            @endauth
        </div>

    </div>
</x-app-layout>
