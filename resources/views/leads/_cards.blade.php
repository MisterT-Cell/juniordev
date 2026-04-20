@foreach($leads as $lead)
<div class="group flex flex-col bg-white rounded-2xl border border-gray-200 p-6 hover:border-gray-400 hover:shadow-lg transition-all duration-200">

    {{-- Top row: avatar + categorie badge --}}
    <div class="flex justify-between items-start mb-5">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gray-100 text-gray-700 rounded-xl flex items-center justify-center font-black text-sm flex-shrink-0 group-hover:bg-[#0a0a0a] group-hover:text-white transition">
                {{ strtoupper(substr($lead->business_name, 0, 1)) }}
            </div>
            <div>
                <p class="text-sm font-bold text-gray-900 leading-tight">{{ $lead->business_name }}</p>
                <p class="text-xs text-gray-400">{{ $lead->city ?? 'Onbekend' }}</p>
            </div>
        </div>
        @if($lead->category)
            <span class="text-xs font-bold uppercase tracking-wider bg-gray-100 text-gray-500 px-3 py-1.5 rounded-full flex-shrink-0">
                {{ $lead->category }}
            </span>
        @endif
    </div>

    {{-- Details --}}
    @if($lead->address)
        <div class="flex items-start gap-2 mb-2">
            <svg class="w-4 h-4 text-gray-300 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <p class="text-sm text-gray-500">{{ $lead->address }}</p>
        </div>
    @endif

    @if($lead->phone)
        <div class="flex items-center gap-2 mb-2">
            <svg class="w-4 h-4 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
            </svg>
            <p class="text-sm text-gray-500">{{ $lead->phone }}</p>
        </div>
    @endif

    {{-- Bottom --}}
    <div class="flex justify-between items-center pt-4 mt-auto border-t border-gray-100">
        <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-orange-600 bg-orange-50 px-3 py-1.5 rounded-full">
            <span class="w-1.5 h-1.5 rounded-full bg-orange-400"></span>
            Geen website
        </span>
        <span class="text-xs text-gray-400">{{ $lead->created_at->diffForHumans() }}</span>
    </div>
</div>
@endforeach
