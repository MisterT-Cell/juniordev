@if($hasApplied)
    <div class="bg-brand/15 border border-brand/40 rounded-2xl p-6 text-center">
        <div class="w-12 h-12 bg-brand/20 rounded-full flex items-center justify-center mx-auto mb-3">
            <svg class="w-6 h-6 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <p class="font-bold text-gray-800 text-sm mb-1">Je hebt al gereageerd!</p>
        <a href="{{ route('student.applications.index') }}"
            class="text-xs text-gray-600 underline decoration-brand/50 hover:decoration-brand hover:text-gray-900 transition">
            Bekijk al je reacties &rarr;
        </a>
    </div>

@elseif($job->status === 'open')
    <div class="bg-white rounded-2xl border border-gray-200 p-6" x-data="{ chars: 0 }">
        <h3 class="font-black text-base mb-1">Reageer op deze vacature</h3>
        <p class="text-xs text-gray-400 mb-5">Minimaal 50 tekens motivatie vereist.</p>

        <form method="POST" action="{{ route('applications.store', $job) }}">
            @csrf
            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">
                    Motivatie
                </label>
                <textarea name="motivation" rows="5" required minlength="50"
                    x-on:input="chars = $event.target.value.length"
                    class="w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-2 focus:ring-brand/20 resize-none"
                    placeholder="Vertel waarom jij de juiste kandidaat bent...">{{ old('motivation') }}</textarea>
                <div class="flex justify-between items-center mt-1.5">
                    <x-input-error :messages="$errors->get('motivation')" class="mt-0" />
                    <span class="text-xs ml-auto" :class="chars >= 50 ? 'text-brand' : 'text-gray-400'">
                        <span x-text="chars"></span>/50
                    </span>
                </div>
            </div>
            <button type="submit"
                class="w-full bg-brand text-black font-bold py-3 rounded-full hover:bg-brand-hover hover-glow transition text-sm press">
                Reactie versturen
            </button>
        </form>
    </div>

@else
    <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 text-center">
        <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-3">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
        <p class="text-sm text-gray-500 font-medium">Deze vacature is gesloten.</p>
    </div>
@endif
