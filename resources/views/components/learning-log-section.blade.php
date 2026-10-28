@props(['learningLogs' => null])

@php
    $items = $learningLogs;

    if ($items === null && class_exists(\App\Models\LearningLogEntry::class)) {
        $items = \App\Models\LearningLogEntry::published()->with('relatedProject')->latest('published_at')->get();
    }

    if (!$items || $items->isEmpty()) {
        $items = collect([
            (object)[
                'title' => 'Breeze vs Sanctum: Membedah State Cookie vs Stateless Token',
                'content' => 'Eksperimen membedah arsitektur otentikasi di Laravel. Membandingkan kapan harus memakai session-based cookie dengan Breeze untuk web monolith vs API token stateless dengan Sanctum untuk SPA/Mobile.',
                'tag' => 'production_ready',
                'category' => 'laravel',
                'relatedProject' => (object)['title' => 'OrderSync API'],
                'published_at' => \Carbon\Carbon::parse('2026-06-15'),
            ],
            (object)[
                'title' => 'Penerapan Form Requests & API Resources untuk Clean Controller',
                'content' => 'Catatan mengenai pemisahan tanggung jawab (Separation of Concerns). Memindahkan validasi rumit ke Form Requests dan formatting payload JSON ke API Resources agar controller tetap ramping.',
                'tag' => 'production_ready',
                'category' => 'laravel',
                'relatedProject' => (object)['title' => 'Portfolio CMS'],
                'published_at' => \Carbon\Carbon::parse('2026-08-25'),
            ],
            (object)[
                'title' => 'Eksplorasi Redis Caching untuk API Rate Limiting & Session Store',
                'content' => 'Catatan pengujian latensi pemindahan driver session dan rate throttling dari MySQL ke Redis in-memory server lokal. Latensi throttling terpangkas dari 15ms menjadi kurang dari 2ms.',
                'tag' => 'production_ready',
                'category' => 'cloud_engineering',
                'relatedProject' => (object)['title' => 'OrderSync API'],
                'published_at' => \Carbon\Carbon::parse('2026-06-01'),
            ],
            (object)[
                'title' => 'Containerization PHP 8.3 & Nginx dengan Docker Multi-Stage Build',
                'content' => 'Bedah optimasi ukuran Docker image untuk Laravel. Memisahkan tahapan composer install dengan production image berbasis Alpine Linux, memangkas ukuran dari 800MB menjadi 135MB siap rilis.',
                'tag' => 'exploring',
                'category' => 'cloud_engineering',
                'relatedProject' => (object)['title' => 'Portfolio CMS'],
                'published_at' => \Carbon\Carbon::parse('2026-09-02'),
            ],
        ]);
    }

    // Limit to latest 2 entries per track for a clean, focused homepage showcase
    $laravelItems = $items->filter(fn($item) => ($item->category ?? 'laravel') === 'laravel')->take(2);
    $cloudItems = $items->filter(fn($item) => ($item->category ?? '') === 'cloud_engineering')->take(2);
@endphp

<section id="learning-log" class="relative bg-carbon-950/60 text-slate-100 py-20 lg:py-28 overflow-hidden border-b border-carbon-800/80">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10" x-data="{ activeMobileTrack: 'cloud' }">

        <!-- ─── Section Header ─── -->
        <div class="mb-10 lg:mb-14 max-w-2xl">
            <span class="inline-flex items-center gap-1.5 font-mono text-[11px] font-semibold uppercase tracking-widest text-cyan-400 mb-3">
                <span class="w-3.5 h-px bg-cyan-400 rounded"></span>
                // {{ __('log.tag') }}
            </span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white leading-tight tracking-tight">
                {{ __('log.title') }}
            </h2>
            <p class="mt-3 text-slate-400 text-sm leading-relaxed font-normal">
                {{ __('log.subtitle') }}
            </p>
        </div>

        <!-- ─── Mobile Segmented Tab Switcher (Visible only on < lg screens) ─── -->
        <div class="flex lg:hidden items-center justify-center mb-8">
            <div class="inline-flex p-1 rounded-xl bg-carbon-900 border border-carbon-800 max-w-sm w-full font-mono text-xs">
                <button type="button"
                        @click="activeMobileTrack = 'cloud'"
                        class="flex-1 py-2 px-3 rounded-lg text-center font-medium transition-all duration-200 flex items-center justify-center gap-2 cursor-pointer"
                        :class="activeMobileTrack === 'cloud' ? 'bg-carbon-950 text-cyan-400 border border-carbon-800 shadow-sm font-bold' : 'text-slate-400 hover:text-white'">
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
                    <span>{{ __('log.tab_cloud') }}</span>
                    <span class="text-[10px] opacity-70">({{ $cloudItems->count() }})</span>
                </button>
                <button type="button"
                        @click="activeMobileTrack = 'laravel'"
                        class="flex-1 py-2 px-3 rounded-lg text-center font-medium transition-all duration-200 flex items-center justify-center gap-2 cursor-pointer"
                        :class="activeMobileTrack === 'laravel' ? 'bg-carbon-950 text-amber-400 border border-carbon-800 shadow-sm font-bold' : 'text-slate-400 hover:text-white'">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                    <span>{{ __('log.tab_laravel') }}</span>
                    <span class="text-[10px] opacity-70">({{ $laravelItems->count() }})</span>
                </button>
            </div>
        </div>

        <!-- ─── Two-Track Grid Layout (Desktop: 2 side-by-side columns | Mobile: Tab-controlled) ─── -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10 items-start">

            <!-- ═════ TRACK 1: CLOUD ENGINEERING & INFRASTRUCTURE ═════ -->
            <div class="flex-col gap-5"
                 :class="activeMobileTrack === 'cloud' ? 'flex' : 'hidden lg:flex'">
                <!-- Track Pillar Header -->
                <div class="flex items-center justify-between p-4 rounded-xl bg-carbon-900/90 border border-carbon-800 backdrop-blur-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 shrink-0">
                            <!-- Cloud / Server Cluster Icon -->
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 00-9.78 2.096A4.001 4.001 0 003 15z" />
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-mono text-[10px] uppercase font-bold text-cyan-400 tracking-wider">// TRACK 01</span>
                            </div>
                            <h3 class="text-sm font-bold text-white tracking-tight">
                                {{ __('log.track_cloud_title') }}
                            </h3>
                        </div>
                    </div>
                    <span class="font-mono text-[10px] text-slate-400 bg-carbon-950 border border-carbon-800 px-2.5 py-1 rounded">
                        {{ $cloudItems->count() }} {{ $cloudItems->count() === 1 ? 'entry' : 'entries' }}
                    </span>
                </div>

                <p class="text-xs text-slate-400 font-sans px-1 -mt-2">
                    {{ __('log.track_cloud_desc') }}
                </p>

                <!-- Cards List -->
                <div class="flex flex-col gap-5">
                    @forelse($cloudItems as $log)
                        @php
                            $pubDate = null;
                            if (!empty($log->published_at)) {
                                $pubDate = is_string($log->published_at)
                                    ? \Carbon\Carbon::parse($log->published_at)->format('d M Y')
                                    : $log->published_at->format('d M Y');
                            }
                            $relatedName = is_object($log->relatedProject) ? $log->relatedProject->title : null;
                            $readTime = $log->reading_time ?? (function($text) {
                                $words = str_word_count(strip_tags((string)$text));
                                $min = max(1, (int) ceil($words / 180));
                                return "{$min} min read";
                            })($log->content);
                        @endphp

                        <article class="group flex flex-col justify-between rounded-xl bg-carbon-900 border border-carbon-800 hover:border-cyan-500/40 transition-all duration-200 hover:-translate-y-0.5 overflow-hidden">
                            <div>
                                <!-- Window Mockup Header Bar -->
                                <div class="flex items-center justify-between px-4 py-2.5 bg-carbon-950 border-b border-carbon-800 select-none">
                                    <div class="flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-rose-500/80"></span>
                                        <span class="w-2 h-2 rounded-full bg-amber-400/80"></span>
                                        <span class="w-2 h-2 rounded-full bg-emerald-400/80"></span>
                                    </div>
                                    <div>
                                        <!-- Medium-Style Reading Time Pill -->
                                        <span class="font-mono text-[10px] font-semibold text-slate-300 bg-carbon-900 border border-carbon-800 px-2 py-0.5 rounded inline-flex items-center gap-1.5 select-none">
                                            <svg class="w-3 h-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $readTime }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="p-5 flex flex-col gap-2.5">
                                    @if(!empty($log->slug))
                                        <a href="{{ route('notes.show', $log->slug) }}" class="block">
                                            <h4 class="text-sm sm:text-base font-bold text-white group-hover:text-cyan-400 transition-colors leading-snug">
                                                {{ $log->title }}
                                            </h4>
                                        </a>
                                    @else
                                        <h4 class="text-sm sm:text-base font-bold text-white group-hover:text-cyan-400 transition-colors leading-snug">
                                            {{ $log->title }}
                                        </h4>
                                    @endif
                                    <p class="text-xs text-slate-300 leading-relaxed font-sans">
                                        {{ $log->content }}
                                    </p>
                                </div>
                            </div>

                            <!-- Card Footer Meta -->
                            <div class="px-5 pb-4 pt-3 flex items-center justify-between border-t border-carbon-800/80 mt-1 text-[11px] text-slate-400 font-mono">
                                <span class="text-[10px] text-slate-400">
                                    {{ $pubDate ?? '—' }}
                                </span>
                                <div class="flex items-center gap-2">
                                    @if($relatedName)
                                        <span class="text-[10px] font-medium text-slate-400 bg-carbon-950 border border-carbon-800 px-2 py-0.5 rounded truncate max-w-[120px]">
                                            {{ $relatedName }}
                                        </span>
                                    @endif
                                    @if(!empty($log->slug))
                                        <a href="{{ route('notes.show', $log->slug) }}"
                                           class="inline-flex items-center gap-1 text-[10px] font-semibold text-cyan-400 hover:text-cyan-300 transition-colors">
                                            Baca
                                            <svg class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="p-8 rounded-xl border border-dashed border-carbon-800 text-center font-mono text-xs text-slate-500 bg-carbon-950/40">
                            {{ __('log.empty_track') }}
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- ═════ TRACK 2: SYSTEM ARCHITECTURE & RUNTIME ═════ -->
            <div class="flex-col gap-5"
                 :class="activeMobileTrack === 'laravel' ? 'flex' : 'hidden lg:flex'">
                <!-- Track Pillar Header -->
                <div class="flex items-center justify-between p-4 rounded-xl bg-carbon-900/90 border border-carbon-800 backdrop-blur-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400 shrink-0">
                            <!-- Code Layer Icon -->
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-mono text-[10px] uppercase font-bold text-amber-400 tracking-wider">// TRACK 02</span>
                            </div>
                            <h3 class="text-sm font-bold text-white tracking-tight">
                                {{ __('log.track_laravel_title') }}
                            </h3>
                        </div>
                    </div>
                    <span class="font-mono text-[10px] text-slate-400 bg-carbon-950 border border-carbon-800 px-2.5 py-1 rounded">
                        {{ $laravelItems->count() }} {{ $laravelItems->count() === 1 ? 'entry' : 'entries' }}
                    </span>
                </div>

                <p class="text-xs text-slate-400 font-sans px-1 -mt-2">
                    {{ __('log.track_laravel_desc') }}
                </p>

                <!-- Cards List -->
                <div class="flex flex-col gap-5">
                    @forelse($laravelItems as $log)
                        @php
                            $pubDate = null;
                            if (!empty($log->published_at)) {
                                $pubDate = is_string($log->published_at)
                                    ? \Carbon\Carbon::parse($log->published_at)->format('d M Y')
                                    : $log->published_at->format('d M Y');
                            }
                            $relatedName = is_object($log->relatedProject) ? $log->relatedProject->title : null;
                            $readTime = $log->reading_time ?? (function($text) {
                                $words = str_word_count(strip_tags((string)$text));
                                $min = max(1, (int) ceil($words / 180));
                                return "{$min} min read";
                            })($log->content);
                        @endphp

                        <article class="group flex flex-col justify-between rounded-xl bg-carbon-900 border border-carbon-800 hover:border-amber-500/40 transition-all duration-200 hover:-translate-y-0.5 overflow-hidden">
                            <div>
                                <!-- Window Mockup Header Bar -->
                                <div class="flex items-center justify-between px-4 py-2.5 bg-carbon-950 border-b border-carbon-800 select-none">
                                    <div class="flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-rose-500/80"></span>
                                        <span class="w-2 h-2 rounded-full bg-amber-400/80"></span>
                                        <span class="w-2 h-2 rounded-full bg-emerald-400/80"></span>
                                    </div>
                                    <div>
                                        <!-- Medium-Style Reading Time Pill -->
                                        <span class="font-mono text-[10px] font-semibold text-slate-300 bg-carbon-900 border border-carbon-800 px-2 py-0.5 rounded inline-flex items-center gap-1.5 select-none">
                                            <svg class="w-3 h-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $readTime }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="p-5 flex flex-col gap-2.5">
                                    @if(!empty($log->slug))
                                        <a href="{{ route('notes.show', $log->slug) }}" class="block">
                                            <h4 class="text-sm sm:text-base font-bold text-white group-hover:text-amber-400 transition-colors leading-snug">
                                                {{ $log->title }}
                                            </h4>
                                        </a>
                                    @else
                                        <h4 class="text-sm sm:text-base font-bold text-white group-hover:text-amber-400 transition-colors leading-snug">
                                            {{ $log->title }}
                                        </h4>
                                    @endif
                                    <p class="text-xs text-slate-300 leading-relaxed font-sans">
                                        {{ $log->content }}
                                    </p>
                                </div>
                            </div>

                            <!-- Card Footer Meta -->
                            <div class="px-5 pb-4 pt-3 flex items-center justify-between border-t border-carbon-800/80 mt-1 text-[11px] text-slate-400 font-mono">
                                <span class="text-[10px] text-slate-400">
                                    {{ $pubDate ?? '—' }}
                                </span>
                                <div class="flex items-center gap-2">
                                    @if($relatedName)
                                        <span class="text-[10px] font-medium text-slate-400 bg-carbon-950 border border-carbon-800 px-2 py-0.5 rounded truncate max-w-[120px]">
                                            {{ $relatedName }}
                                        </span>
                                    @endif
                                    @if(!empty($log->slug))
                                        <a href="{{ route('notes.show', $log->slug) }}"
                                           class="inline-flex items-center gap-1 text-[10px] font-semibold text-amber-400 hover:text-amber-300 transition-colors">
                                            Baca
                                            <svg class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="p-8 rounded-xl border border-dashed border-carbon-800 text-center font-mono text-xs text-slate-500 bg-carbon-950/40">
                            {{ __('log.empty_track') }}
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- ─── Bottom CTA: Explore All Notes Archive ─── -->
        <div class="mt-12 lg:mt-16 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('notes.index') }}"
               id="view-all-notes-btn"
               class="inline-flex items-center gap-3 px-6 py-3.5 rounded-xl bg-carbon-900 hover:bg-carbon-850 border border-carbon-800 hover:border-vermilion-500/40 text-slate-200 hover:text-white font-mono text-xs sm:text-sm font-semibold transition-all duration-200 group shadow-lg shadow-black/20 hover:shadow-vermilion-500/10 hover:-translate-y-0.5">
                <svg class="w-4 h-4 text-vermilion-400 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <span>Lihat Semua Catatan &amp; Eksperimen</span>
                <span class="px-2 py-0.5 rounded text-[11px] bg-carbon-950 border border-carbon-800 text-vermilion-400 group-hover:border-vermilion-500/30">
                    {{ $items->count() }} Catatan
                </span>
                <svg class="w-4 h-4 text-slate-400 group-hover:text-vermilion-400 group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>

    </div>
</section>
