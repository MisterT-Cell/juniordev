<section id="vacatures" class="scroll-mt-24 max-w-7xl mx-auto px-6 py-28">
    <div class="flex justify-between items-end mb-14">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.18em] text-gray-400 mb-4">Live op het platform</p>
            <h2 class="font-black text-5xl md:text-6xl tracking-tight leading-none text-balance">
                Nieuwste<br><span class="text-gray-400">vacatures</span>
            </h2>
        </div>
        <a href="{{ route('jobs.index') }}"
            class="group hidden md:inline-flex items-center gap-2 border border-gray-300 text-gray-600 text-sm font-semibold px-5 py-2.5 rounded-full hover:border-gray-900 hover:text-gray-900 transition press">
            Alle vacatures
            <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
        </a>
    </div>

    <div x-data="featuredJobs()" x-init="load()" class="relative">

        {{-- Left arrow --}}
        <button
            @click="prev()"
            :disabled="row === 0 || loading"
            class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-5 z-10 w-10 h-10 rounded-full border border-gray-200 bg-white flex items-center justify-center text-gray-400 hover:border-gray-900 hover:text-gray-900 shadow-sm transition disabled:opacity-0 disabled:pointer-events-none"
            aria-label="Vorige"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>

        {{-- Right arrow --}}
        <button
            @click="next()"
            :disabled="row === 1 || loading"
            class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-5 z-10 w-10 h-10 rounded-full border border-gray-200 bg-white flex items-center justify-center text-gray-400 hover:border-gray-900 hover:text-gray-900 shadow-sm transition disabled:opacity-0 disabled:pointer-events-none"
            aria-label="Volgende"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
            </svg>
        </button>

        {{-- Cards --}}
        <div class="grid md:grid-cols-3 gap-4 min-h-[280px]">

            {{-- Loading skeleton --}}
            <template x-if="loading">
                <template x-for="i in [1,2,3]" :key="i">
                    <div class="bg-white border border-gray-100 rounded-2xl p-7 animate-pulse">
                        <div class="flex justify-between items-start mb-6">
                            <div class="w-10 h-10 bg-gray-100 rounded-xl"></div>
                            <div class="w-16 h-6 bg-gray-100 rounded-full"></div>
                        </div>
                        <div class="h-5 bg-gray-100 rounded mb-2 w-3/4"></div>
                        <div class="h-4 bg-gray-100 rounded mb-1 w-full"></div>
                        <div class="h-4 bg-gray-100 rounded w-2/3"></div>
                    </div>
                </template>
            </template>

            {{-- Job cards --}}
            <template x-if="!loading">
                <template x-for="(job, index) in visibleJobs()" :key="job.id">
                    <a :href="job.url"
                        :class="index === 0
                            ? 'md:col-span-1 bg-dark grain text-white rounded-2xl p-8 flex flex-col justify-between min-h-[280px] group hover:shadow-[0_0_60px_rgba(200,241,53,0.08)] transition-all duration-300'
                            : 'bg-white border border-gray-200 rounded-2xl p-7 flex flex-col group hover:border-gray-300 hover:shadow-[0_16px_40px_rgba(0,0,0,0.06)] hover:-translate-y-0.5 transition-all duration-300'"
                    >
                        {{-- Featured (dark) card --}}
                        <template x-if="index === 0">
                            <div class="flex flex-col justify-between h-full">
                                <div>
                                    <div class="flex justify-between items-start mb-8">
                                        <div class="w-12 h-12 bg-brand text-black rounded-xl flex items-center justify-center font-black text-lg flex-shrink-0" x-text="job.initial"></div>
                                        <span class="text-xs font-bold text-white/40 uppercase tracking-widest" x-text="job.type"></span>
                                    </div>
                                    <h3 class="font-black text-2xl leading-snug mb-3 group-hover:text-brand transition" x-text="job.title"></h3>
                                    <p class="text-gray-500 text-sm leading-relaxed" x-text="job.description"></p>
                                </div>
                                <div class="flex justify-between items-center pt-6 mt-6 border-t border-white/10">
                                    <span class="text-xs text-gray-500" x-text="job.company + ' · ' + job.region"></span>
                                    <span class="w-9 h-9 bg-white/5 group-hover:bg-brand group-hover:text-black rounded-full flex items-center justify-center transition-all text-white text-sm font-bold group-hover:translate-x-1">&rarr;</span>
                                </div>
                            </div>
                        </template>

                        {{-- Regular (light) card --}}
                        <template x-if="index > 0">
                            <div class="flex flex-col h-full">
                                <div class="flex justify-between items-start mb-6">
                                    <div class="w-10 h-10 bg-gray-100 text-gray-700 rounded-xl flex items-center justify-center font-black text-sm flex-shrink-0 group-hover:bg-dark group-hover:text-white transition-all duration-300" x-text="job.initial"></div>
                                    <span class="text-xs font-bold uppercase tracking-widest bg-gray-100 text-gray-500 px-3 py-1.5 rounded-full" x-text="job.type"></span>
                                </div>
                                <h3 class="font-black text-lg leading-snug mb-2 flex-1" x-text="job.title"></h3>
                                <p class="text-gray-400 text-sm leading-relaxed mb-5" x-text="job.description"></p>
                                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                    <span class="text-xs text-gray-500" x-text="job.company + ' · ' + job.region"></span>
                                    <span class="text-gray-300 group-hover:text-gray-900 group-hover:translate-x-1 transition-all font-bold text-sm">&rarr;</span>
                                </div>
                            </div>
                        </template>
                    </a>
                </template>
            </template>

            {{-- Empty placeholders --}}
            <template x-if="!loading">
                <template x-for="i in Math.max(0, 3 - visibleJobs().length)" :key="'empty-' + i">
                    <div class="border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center min-h-[280px] text-center p-8">
                        <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-gray-400">Binnenkort meer</p>
                        <p class="text-xs text-gray-300 mt-1">vacatures</p>
                    </div>
                </template>
            </template>
        </div>

        {{-- Dot indicators --}}
        <div class="flex items-center justify-center gap-2 mt-8">
            <button @click="row = 0" :class="row === 0 ? 'w-5 h-1.5 bg-gray-900 rounded-full' : 'w-1.5 h-1.5 bg-gray-300 rounded-full'" class="transition-all duration-300"></button>
            <button @click="row = 1" :class="row === 1 ? 'w-5 h-1.5 bg-gray-900 rounded-full' : 'w-1.5 h-1.5 bg-gray-300 rounded-full'" class="transition-all duration-300"></button>
        </div>
    </div>

    <div class="text-center mt-8 md:hidden">
        <a href="{{ route('jobs.index') }}" class="text-sm font-semibold text-gray-500">Alle vacatures &rarr;</a>
    </div>
</section>

<script>
function featuredJobs() {
    return {
        allJobs: [],
        row: 0,
        loading: true,

        async load() {
            this.loading = true;
            const res = await fetch('/vacatures/featured');
            const data = await res.json();
            this.allJobs = data.jobs;
            this.loading = false;
        },

        visibleJobs() {
            return this.allJobs.slice(this.row * 3, this.row * 3 + 3);
        },

        next() { if (this.row === 0) this.row = 1; },
        prev() { if (this.row === 1) this.row = 0; },
    };
}
</script>
