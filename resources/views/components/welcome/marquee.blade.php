@php
    $dbSkills = \App\Models\Job::whereNotNull('requirements')
        ->latest()->take(20)->pluck('requirements')
        ->flatMap(fn($r) => preg_split('/[,\n]+/', $r))
        ->map(fn($s) => trim($s))
        ->filter(fn($s) => strlen($s) >= 2 && strlen($s) <= 22)
        ->unique()->shuffle()->take(12)->values()->toArray();

    $fallback = ['PHP', 'Laravel', 'JavaScript', 'Vue.js', 'React', 'MySQL', 'Tailwind CSS', 'Node.js', 'Python', 'TypeScript', 'Docker', 'Git'];
    $skills = count($dbSkills) >= 6 ? $dbSkills : $fallback;

    $all = array_merge($skills, $skills);
@endphp

<div class="relative overflow-hidden border-y-2 border-black/10 bg-brand cursor-default">
    {{-- Left fade --}}
    <div class="absolute left-0 top-0 bottom-0 w-16 bg-gradient-to-r from-brand to-transparent z-10 pointer-events-none"></div>
    {{-- Right fade --}}
    <div class="absolute right-0 top-0 bottom-0 w-16 bg-gradient-to-l from-brand to-transparent z-10 pointer-events-none"></div>

    <div class="marquee-track py-4">
        @foreach($all as $s)
            <span class="inline-block text-black/60 text-xs font-bold uppercase tracking-[0.15em] px-8">{{ $s }}</span>
            <span class="inline-block text-black/25 text-sm">&diams;</span>
        @endforeach
    </div>
</div>
