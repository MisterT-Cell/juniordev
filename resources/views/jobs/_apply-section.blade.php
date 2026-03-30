@if($hasApplied)
    <div class="bg-[#c8f135]/20 border border-[#c8f135] rounded-2xl p-5">
        <p class="font-bold text-gray-800 text-sm mb-1">Je hebt al gereageerd.</p>
        <a href="{{ route('student.applications.index') }}"
            class="text-xs text-gray-600 underline hover:text-gray-900 transition">
            Bekijk al je reacties &rarr;
        </a>
    </div>

@elseif($job->status === 'open')
    <div class="bg-white rounded-2xl border border-gray-200 p-6">
        <h3 class="font-black text-base mb-1">Reageer op deze vacature</h3>
        <p class="text-xs text-gray-400 mb-5">Minimaal 50 tekens motivatie vereist.</p>

        <form method="POST" action="{{ route('applications.store', $job) }}">
            @csrf
            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-widest mb-2">
                    Motivatie
                </label>
                <textarea name="motivation" rows="5" required minlength="50"
                    class="w-full border-gray-200 rounded-xl text-sm focus:border-gray-900 focus:ring-0 resize-none"
                    placeholder="Vertel waarom jij de juiste kandidaat bent...">{{ old('motivation') }}</textarea>
                <x-input-error :messages="$errors->get('motivation')" class="mt-2" />
            </div>
            <button type="submit"
                class="w-full bg-[#0a0a0a] text-white font-bold py-3 rounded-full hover:bg-gray-800 transition text-sm">
                Reactie versturen
            </button>
        </form>
    </div>

@else
    <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5 text-center">
        <p class="text-sm text-gray-500 font-medium">Deze vacature is gesloten.</p>
    </div>
@endif
