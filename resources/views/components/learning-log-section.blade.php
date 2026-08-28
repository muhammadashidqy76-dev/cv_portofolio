@props(['learningLogs' => null])

@php
    $items = $learningLogs;

    if ($items === null && class_exists(\App\Models\LearningLogEntry::class)) {
        $items = \App\Models\LearningLogEntry::published()->with('relatedProject')->latest('published_at')->get();
    }

    if (!$items || $items->isEmpty()) {
        $items = collect([
            (object)[
                'title' => 'Eksplorasi Redis Caching untuk API Rate Limiting',
                'content' => 'Mencoba memindahkan session dan rate limiting throttling dari database/file driver ke Redis server lokal. Hasilnya latensi throttling turun dari 15ms menjadi < 2ms.',
                'tag' => 'exploring',
                'relatedProject' => (object)['title' => 'OrderSync API'],
                'published_at' => \Carbon\Carbon::parse('2026-06-01'),
            ],
            (object)[
                'title' => 'Penerapan API Resources & Custom Form Requests',
                'content' => 'Praktik terbaik dalam memisahkan logika validasi input dengan Form Requests dan pemformatan output JSON dengan Eloquent API Resources untuk menjaga controller tetap clean.',
                'tag' => 'production_ready',
                'relatedProject' => (object)['title' => 'OrderSync API'],
                'published_at' => \Carbon\Carbon::parse('2026-06-15'),
            ],
            (object)[
                'title' => 'Eksplorasi Dynamic Component & Scope Query di Laravel Eloquent',
                'content' => 'Catatan mengenai efisiensi penulisan scope query seperti scopePublished() dan scopeOrderedByComplexity() agar kode pengambilan data di controller tetap expressive.',
                'tag' => 'production_ready',
                'relatedProject' => (object)['title' => 'Portfolio CMS'],
                'published_at' => \Carbon\Carbon::parse('2026-08-25'),
            ],
        ]);
    }
@endphp

<section id="learning-log" class="relative bg-[#0b0f19] text-slate-100 pt-10 pb-16 lg:pt-12 lg:pb-20 overflow-hidden border-t border-slate-800/60">
    <!-- Ambient Background Lighting -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-red-600/5 rounded-full blur-[100px] pointer-events-none -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-500/5 rounded-full blur-[100px] pointer-events-none translate-y-1/2 -translate-x-1/3"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- ─── Section Header ─── -->
        <div class="mb-10 max-w-2xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 border border-slate-800 text-xs font-mono text-slate-400 mb-4">
                <span class="w-2 h-2 rounded-full bg-sky-400 animate-pulse"></span>
                <span>Section 02 &bull; Learning Log &amp; Technical Notes</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white leading-tight tracking-tight">
                Catatan Eksplorasi &amp; Log Teknis (Learning Log)
            </h2>
            <p class="mt-2 text-sm sm:text-base text-slate-400 leading-relaxed">
                Log teknis bergaya blog singkat mengenai eksperimen, temuan optimasi, serta praktik terbaik yang siap diterapkan ke lingkungan produksi.
            </p>
        </div>

        <!-- ─── Collapsible Accordion Wrapper (Alpine.js) ─── -->
        <div x-data="{ open: false }" class="w-full">

            <!-- Accordion Trigger Button -->
            <button type="button"
                    @click="open = !open"
                    class="w-full flex items-center justify-between p-4 sm:p-5 rounded-xl bg-[#0f1422]/90 border border-slate-800/80 hover:border-slate-700/80 transition-all duration-200 group text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-red-500/40">
                <div class="flex items-center gap-4 sm:gap-5 min-w-0 pr-4">
                    <div class="w-10 h-10 shrink-0 rounded-lg bg-sky-500/10 border border-sky-500/20 flex items-center justify-center text-sky-400 group-hover:scale-105 transition-transform">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6" />
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1 min-w-0">
                        <span class="text-sm sm:text-base font-bold text-white block group-hover:text-sky-400 transition-colors truncate">
                            Learning Log Entries
                        </span>
                        <span class="text-xs text-slate-400 leading-normal">
                            <span x-text="open ? 'Sembunyikan catatan teknis' : 'Tampilkan {{ count($items) }} artikel & log eksplorasi (Exploring / Production-Ready)'"></span>
                        </span>
                    </div>
                </div>

                <div class="flex items-center gap-3 shrink-0">
                    <span class="font-mono text-xs text-sky-300/80 bg-slate-800/60 border border-slate-700/50 px-2.5 py-1 rounded-md">
                        {{ count($items) }} logs
                    </span>
                    <span class="p-1.5 rounded-lg bg-slate-800/80 text-slate-400 group-hover:text-white transition-colors">
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </div>
            </button>

            <!-- Collapsible Content -->
            <div x-show="open"
                 x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($items as $log)
                    @php
                        $pubDate = null;
                        if (!empty($log->published_at)) {
                            $pubDate = is_string($log->published_at)
                                ? \Carbon\Carbon::parse($log->published_at)->format('d M Y')
                                : $log->published_at->format('d M Y');
                        }
                        $isProdReady = ($log->tag === 'production_ready' || $log->tag === \App\Models\LearningLogEntry::TAG_PRODUCTION_READY);
                        $relatedName = is_object($log->relatedProject) ? $log->relatedProject->title : null;
                    @endphp

                    <!-- Window Mockup Card for Learning Log Entry -->
                    <article class="group flex flex-col justify-between rounded-xl bg-slate-900/70 border border-slate-800 hover:border-slate-700/80 transition-all duration-200 hover:-translate-y-0.5 overflow-hidden">
                        
                        <div>
                            <!-- Window Mockup Header Bar (3 colored dots) -->
                            <div class="flex items-center justify-between px-4 py-3 bg-slate-900 border-b border-slate-800/60">
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-rose-500/70"></span>
                                    <span class="w-2 h-2 rounded-full bg-amber-400/70"></span>
                                    <span class="w-2 h-2 rounded-full bg-emerald-400/70"></span>
                                </div>
                                
                                <div>
                                    @if($isProdReady)
                                        <span class="font-mono text-[10px] font-semibold text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2.5 py-0.5 rounded-full inline-flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                            Production-Ready
                                        </span>
                                    @else
                                        <span class="font-mono text-[10px] font-semibold text-amber-400 bg-amber-500/10 border border-amber-500/20 px-2.5 py-0.5 rounded-full inline-flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                                            Exploring
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="p-6 flex flex-col gap-3">
                                <h3 class="text-sm sm:text-base font-bold text-white group-hover:text-sky-400 transition-colors leading-snug">
                                    {{ $log->title }}
                                </h3>

                                <p class="text-xs text-slate-300 leading-relaxed">
                                    {{ $log->content }}
                                </p>
                            </div>
                        </div>

                        <!-- Card Footer Meta -->
                        <div class="px-5 pb-5 pt-3 sm:px-6 sm:pb-6 flex items-center justify-between border-t border-slate-800/60 mt-3 text-[11px] text-slate-400">
                            @if($pubDate)
                                <span class="font-mono text-[10px] text-slate-400">
                                    {{ $pubDate }}
                                </span>
                            @else
                                <span></span>
                            @endif

                            @if($relatedName)
                                <span class="text-[10px] font-medium text-slate-400 bg-slate-800/80 border border-slate-700/60 px-2.5 py-0.5 rounded truncate max-w-[150px]">
                                    {{ $relatedName }}
                                </span>
                            @endif
                        </div>

                    </article>
                @endforeach

            </div>
        </div>

    </div>
</section>
