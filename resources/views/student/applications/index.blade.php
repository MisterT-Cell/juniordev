<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl tracking-tight">Mijn Reacties</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-6 py-10">
        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            @forelse($applications as $app)
            <div class="p-6 border-b border-gray-100 last:border-0">
                <div class="flex flex-wrap justify-between items-start gap-3 mb-4">
                    <div>
                        <a href="{{ route('jobs.show', $app->job) }}"
                            class="font-bold text-gray-900 hover:text-indigo-600 transition">
                            {{ $app->job->title }}
                        </a>
                        <p class="text-sm text-gray-400 mt-0.5">
                            {{ $app->job->company->companyProfile->company_name ?? $app->job->company->name }}
                            · {{ $app->job->region }} · {{ ucfirst($app->job->type) }}
                        </p>
                        <p class="text-xs text-gray-400 mt-1">{{ $app->created_at->format('d-m-Y') }}</p>
                    </div>
                    @php $colors = ['pending'=>'bg-yellow-100 text-yellow-700','accepted'=>'bg-[#c8f135]/30 text-gray-700','rejected'=>'bg-red-100 text-red-600']; @endphp
                    <span class="text-xs font-bold px-3 py-1.5 rounded-full {{ $colors[$app->status] }}">
                        {{ ['pending'=>'In behandeling','accepted'=>'Geaccepteerd','rejected'=>'Afgewezen'][$app->status] }}
                    </span>
                </div>
                <div class="bg-gray-50 rounded-xl p-4 text-sm text-gray-600">
                    <span class="font-semibold text-gray-700">Motivatie: </span>{{ Str::limit($app->motivation, 150) }}
                </div>
            </div>
            @empty
            <div class="p-16 text-center text-gray-400">
                <p class="font-semibold text-lg mb-2">Nog geen reacties verstuurd.</p>
                <a href="{{ route('jobs.index') }}" class="text-sm text-indigo-600 hover:underline">Bekijk opdrachten &rarr;</a>
            </div>
            @endforelse
        </div>
        <div class="mt-5">{{ $applications->links() }}</div>
    </div>
</x-app-layout>
