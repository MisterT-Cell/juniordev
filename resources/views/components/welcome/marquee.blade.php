@php
    // Haal skills op uit requirements van recente vacatures
    $dbSkills = \App\Models\Job::whereNotNull('requirements')
        ->latest()->take(20)->pluck('requirements')
        ->flatMap(fn($r) => preg_split('/[,\n]+/', $r))
        ->map(fn($s) => trim($s))
        ->filter(fn($s) => strlen($s) >= 2 && strlen($s) <= 22)
        ->unique()->shuffle()->take(12)->values()->toArray();

    // Fallback als er nog geen data is
    $fallback = ['PHP', 'Laravel', 'JavaScript', 'Vue.js', 'React', 'MySQL', 'Tailwind CSS', 'Node.js', 'Python', 'TypeScript', 'Docker', 'Git'];
    $skills = count($dbSkills) >= 6 ? $dbSkills : $fallback;

    $all = array_merge($skills, $skills); // dubbel voor continue loop
@endphp

<div class="overflow-hidden border-y border-black/10 bg-[#c8f135]">
    <div class="marquee-track py-3">
        @foreach($all as $s)
            <span class="inline-block text-black/60 text-xs font-bold uppercase tracking-[0.15em] px-8">{{ $s }}</span>
            <span class="inline-block text-black/30 text-xs">·</span>
        @endforeach
    </div>
</div>
