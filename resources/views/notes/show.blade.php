<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $entry->title }} — Ashidqy Handbook</title>
    <meta name="description" content="{{ Str::limit(strip_tags($entry->content), 155) }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $entry->title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($entry->content), 155) }}">
    <meta property="og:type" content="article">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-web.svg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800|jetbrains-mono:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ── Prose: Medium-style typography for Markdown-rendered content ── */
        .prose-note {
            --prose-body: #cbd5e1;        /* slate-300 */
            --prose-heading: #f1f5f9;     /* slate-100 */
            --prose-lead: #94a3b8;        /* slate-400 */
            --prose-code-bg: #141a27;     /* carbon-850 */
            --prose-code-border: #1e2638; /* carbon-800 */
            --prose-quote-border: #ff4d6d; /* vermilion-400 */
            --prose-hr: #1e2638;

            color: var(--prose-body);
            font-size: 1.0625rem; /* 17px — comfortable reading size */
            line-height: 1.8;
        }

        /* Headings */
        .prose-note h1,
        .prose-note h2,
        .prose-note h3,
        .prose-note h4 {
            color: var(--prose-heading);
            font-weight: 700;
            line-height: 1.3;
            margin-top: 2em;
            margin-bottom: 0.6em;
        }
        .prose-note h2 { font-size: 1.35rem; }
        .prose-note h3 { font-size: 1.15rem; }
        .prose-note h4 { font-size: 1.05rem; }

        /* Paragraphs */
        .prose-note p {
            margin-top: 0;
            margin-bottom: 1.4em;
        }

        /* Strong & Em */
        .prose-note strong { color: var(--prose-heading); font-weight: 600; }
        .prose-note em { color: #94a3b8; }

        /* Inline code */
        .prose-note code:not(pre > code) {
            background: var(--prose-code-bg);
            border: 1px solid var(--prose-code-border);
            border-radius: 4px;
            padding: 0.1em 0.4em;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.85em;
            color: #fb923c; /* orange-400 — warm contrast */
        }

        /* Code blocks */
        .prose-note pre {
            background: var(--prose-code-bg) !important;
            border: 1px solid var(--prose-code-border);
            border-radius: 8px;
            padding: 1.25rem 1.5rem;
            overflow-x: auto;
            margin: 1.75em 0;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.875rem;
            line-height: 1.7;
        }
        .prose-note pre code {
            background: none !important;
            border: none !important;
            padding: 0 !important;
            color: #e2e8f0 !important;
            font-size: inherit;
        }

        /* Blockquote */
        .prose-note blockquote {
            border-left: 3px solid var(--prose-quote-border);
            padding-left: 1.25rem;
            margin-left: 0;
            color: var(--prose-lead);
            font-style: italic;
        }

        /* Lists */
        .prose-note ul,
        .prose-note ol {
            padding-left: 1.5rem;
            margin-bottom: 1.4em;
        }
        .prose-note li { margin-bottom: 0.35em; }
        .prose-note ul { list-style-type: disc; }
        .prose-note ol { list-style-type: decimal; }

        /* Horizontal rule */
        .prose-note hr {
            border: none;
            border-top: 1px solid var(--prose-hr);
            margin: 2.5em 0;
        }

        /* Tables */
        .prose-note table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
            margin: 1.75em 0;
        }
        .prose-note th {
            background: #1e2638;
            color: #f1f5f9;
            text-align: left;
            padding: 0.6rem 0.9rem;
            border-bottom: 2px solid #2d3748;
            font-weight: 600;
        }
        .prose-note td {
            padding: 0.5rem 0.9rem;
            border-bottom: 1px solid #1e2638;
            color: #cbd5e1;
        }
        .prose-note tr:last-child td { border-bottom: none; }
        .prose-note tr:hover td { background: rgba(30,38,56,0.4); }

        /* Images */
        .prose-note img {
            max-width: 100%;
            border-radius: 8px;
            border: 1px solid #1e2638;
            margin: 1.75em auto;
            display: block;
        }

        /* Links */
        .prose-note a {
            color: #ff4d6d;
            text-decoration: underline;
            text-underline-offset: 3px;
            transition: color 0.15s;
        }
        .prose-note a:hover { color: #fb7185; }

        /* Reading progress bar */
        #reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 2px;
            background: linear-gradient(to right, #ff4d6d, #fb923c);
            z-index: 9999;
            width: 0%;
            transition: width 0.1s linear;
        }
    </style>
</head>
<body class="bg-carbon-950 text-slate-100 font-sans antialiased selection:bg-rose-500 selection:text-white relative min-h-screen">

    <!-- Global grid background -->
    <div class="fixed inset-0 bg-[linear-gradient(to_right,#1f293d18_2px,transparent_2px),linear-gradient(to_bottom,#1f293d18_2px,transparent_2px)] bg-[size:3.5rem_3.5rem] pointer-events-none z-0"></div>

    <!-- Reading progress bar -->
    <div id="reading-progress" aria-hidden="true"></div>

    <div class="relative z-10">
        <!-- ── Reader-Mode Header ── -->
        <header x-data="{
                    showTitle: false,
                    copied: false,
                    init() {
                        const target = document.getElementById('article-title');
                        if (target) {
                            const observer = new IntersectionObserver(([entry]) => {
                                this.showTitle = !entry.isIntersecting;
                            }, { threshold: 0 });
                            observer.observe(target);
                        }
                    },
                    copyUrl() {
                        navigator.clipboard.writeText(window.location.href);
                        this.copied = true;
                        setTimeout(() => this.copied = false, 2500);
                    }
                }"
                class="sticky top-0 z-50 backdrop-blur-md bg-carbon-950/85 border-b border-carbon-800/80 transition-all duration-300">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-4">

                <!-- Left: Logo & Back to Home -->
                <div class="flex items-center gap-3 shrink-0">
                    <a href="/" class="flex items-center gap-2.5 group focus:outline-none focus:ring-2 focus:ring-vermilion-500/40 rounded-lg p-1" title="Kembali ke Beranda">
                        <!-- 3 Window Dots Motif -->
                        <div class="flex items-center gap-1 p-1 rounded bg-carbon-900 border border-carbon-800 group-hover:border-carbon-700 transition-colors">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500/90"></span>
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400/90"></span>
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400/90"></span>
                        </div>
                        <span class="font-mono text-sm sm:text-base font-bold text-white tracking-tight">
                            <span class="text-vermilion-400 group-hover:-translate-x-0.5 transition-transform inline-block">&lt;</span>
                            <span class="text-slate-100 group-hover:text-white transition-colors">Ashidqy</span>
                            <span class="text-vermilion-400 group-hover:translate-x-0.5 transition-transform inline-block">/&gt;</span>
                        </span>
                    </a>

                    <span class="h-4 w-px bg-carbon-800 hidden sm:block"></span>

                    <a href="/"
                       class="hidden sm:inline-flex items-center gap-1.5 text-xs font-mono text-slate-400 hover:text-white transition-colors group px-2 py-1 rounded-md hover:bg-carbon-900"
                       id="back-to-home-link">
                        <span>Beranda</span>
                    </a>
                </div>

                <!-- Center: Scrolled Article Title Fade-in -->
                <div class="hidden md:flex flex-1 items-center justify-center min-w-0 px-4">
                    <div x-show="showTitle"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-2"
                         style="display: none;"
                         class="text-xs font-medium text-slate-300 truncate max-w-sm lg:max-w-md text-center">
                        {{ $entry->title }}
                    </div>
                </div>

                <!-- Right: Actions & Badges -->
                <div class="flex items-center gap-2 sm:gap-2.5 shrink-0">
                    <!-- Track Badge -->
                    @if($entry->category === 'laravel')
                        <span class="hidden sm:inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-medium bg-rose-500/10 text-rose-400 border border-rose-500/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-400 animate-pulse"></span>
                            Laravel
                        </span>
                    @else
                        <span class="hidden sm:inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono font-medium bg-cyan-500/10 text-cyan-400 border border-cyan-500/20">
                            <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
                            Cloud
                        </span>
                    @endif

                    <!-- Reading Time -->
                    <span class="text-slate-500 text-[11px] font-mono hidden xs:inline-block px-1">
                        {{ $entry->reading_time }}
                    </span>

                    <!-- Copy / Share Button -->
                    <button @click="copyUrl()"
                            type="button"
                            class="relative p-2 rounded-lg bg-carbon-900 hover:bg-carbon-850 border border-carbon-800 hover:border-slate-700 text-slate-400 hover:text-white transition-all shadow-sm focus:outline-none"
                            :title="copied ? 'Tautan tersalin!' : 'Salin tautan artikel'"
                            aria-label="Salin tautan artikel">
                        <svg x-show="!copied" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                        <svg x-show="copied" style="display: none;" class="w-3.5 h-3.5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <!-- Tooltip notification -->
                        <span x-show="copied"
                              x-transition
                              style="display: none;"
                              class="absolute -bottom-8 right-0 px-2 py-0.5 rounded bg-emerald-500/20 border border-emerald-500/40 text-emerald-400 text-[10px] font-mono whitespace-nowrap shadow-lg">
                            Tersalin!
                        </span>
                    </button>

                    <!-- Link to All Notes Archive -->
                    <a href="{{ route('notes.index') }}"
                       class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg bg-carbon-900 hover:bg-carbon-850 border border-carbon-800 hover:border-slate-700 text-slate-300 hover:text-white transition-all text-xs font-mono group"
                       title="Lihat semua catatan & eksperimen">
                        <svg class="w-3.5 h-3.5 text-vermilion-400 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <span class="hidden sm:inline">Semua Catatan</span>
                    </a>
                </div>

            </div>
        </header>

        <!-- ── Article ── -->
        <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">

            <!-- Article header -->
            <header class="mb-10" id="article-header">

                <!-- Status badge -->
                @if($entry->tag === 'production_ready')
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-mono font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 mb-4">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Production Ready
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-mono font-medium bg-amber-500/10 text-amber-400 border border-amber-500/20 mb-4">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                        Exploring
                    </span>
                @endif

                <!-- Title -->
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white leading-tight tracking-tight mb-4" id="article-title">
                    {{ $entry->title }}
                </h1>

                <!-- Meta bar -->
                <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-slate-500 text-sm font-mono border-t border-carbon-800 pt-4">
                    @if($entry->published_at)
                        <time datetime="{{ $entry->published_at->format('Y-m-d') }}" class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $entry->published_at->format('d M Y') }}
                        </time>
                    @endif

                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $entry->reading_time }}
                    </span>

                    @if($entry->relatedProject)
                        <a href="#" class="flex items-center gap-1.5 text-slate-500 hover:text-vermilion-400 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                            {{ $entry->relatedProject->title }}
                        </a>
                    @endif
                </div>
            </header>

            <!-- Lead / Excerpt -->
            <div class="bg-carbon-900 border border-carbon-800 rounded-xl px-6 py-5 mb-10 text-slate-300 text-sm leading-relaxed font-sans italic border-l-2 border-l-rose-500/40">
                {{ $entry->content }}
            </div>

            <!-- ── Main content (rendered Markdown) ── -->
            <article class="prose-note" id="article-body">
                {!! $entry->body_html !!}
            </article>

            <!-- ── Author Card / Mini Profile ── -->
            <div class="mt-14 pt-8 border-t border-carbon-800">
                <div class="p-6 rounded-2xl bg-carbon-900/70 border border-carbon-800/80 backdrop-blur-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-5">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-carbon-800 border border-carbon-700/80 flex items-center justify-center font-mono font-bold text-vermilion-400 text-base shadow-inner shrink-0">
                            <img src="/images/Siakad.jpg" alt="Moch Hasbi Ashidqy" class="w-full h-full rounded-xl object-cover">
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-sm font-bold text-white tracking-tight">Moch Hasbi Ashidqy</h3>
                                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-medium bg-vermilion-500/10 border border-vermilion-500/20 text-vermilion-400">Author</span>
                            </div>
                            <p class="text-xs text-slate-400 mt-0.5 leading-relaxed">
                                Aspiring Cloud &amp; Infrastructure Engineer &bull; Berbagi catatan eksplorasi Linux, Docker, cloud architecture, dan sistem infrastruktur.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </main>

        <!-- ── Prev / Next Navigation ── -->
        @if($prevEntry || $nextEntry)
        <nav class="border-t border-carbon-800 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10" aria-label="Navigasi catatan">
            <p class="text-xs font-mono text-slate-500 uppercase tracking-widest mb-6">Catatan lainnya dalam track ini</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                @if($prevEntry)
                <a href="{{ route('notes.show', $prevEntry->slug) }}"
                   id="prev-note-link"
                   class="group flex flex-col gap-2 p-4 rounded-xl bg-carbon-900 border border-carbon-800 hover:border-slate-700 hover:bg-carbon-850 transition-all duration-200">
                    <span class="flex items-center gap-1.5 text-xs font-mono text-slate-500 group-hover:text-slate-400">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                        Sebelumnya
                    </span>
                    <span class="text-sm font-medium text-slate-300 group-hover:text-white transition-colors leading-snug">
                        {{ $prevEntry->title }}
                    </span>
                </a>
                @else
                <div></div>
                @endif

                @if($nextEntry)
                <a href="{{ route('notes.show', $nextEntry->slug) }}"
                   id="next-note-link"
                   class="group flex flex-col gap-2 p-4 rounded-xl bg-carbon-900 border border-carbon-800 hover:border-slate-700 hover:bg-carbon-850 transition-all duration-200 sm:text-right">
                    <span class="flex items-center gap-1.5 text-xs font-mono text-slate-500 group-hover:text-slate-400 sm:justify-end">
                        Berikutnya
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </span>
                    <span class="text-sm font-medium text-slate-300 group-hover:text-white transition-colors leading-snug">
                        {{ $nextEntry->title }}
                    </span>
                </a>
                @endif

            </div>
        </nav>
        @endif

        <!-- ── Site Footer ── -->
        <footer class="relative bg-carbon-950 text-slate-100 border-t border-carbon-800/90 overflow-hidden mt-16">
            <!-- Subtle Top Edge Gradient Accent Line -->
            <div class="h-px w-full bg-gradient-to-r from-transparent via-vermilion-500/30 to-transparent"></div>

            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-14">
                <div class="flex flex-col md:flex-row items-center justify-between gap-8">

                    <!-- Left: Brand / Logo & Tagline -->
                    <div class="flex flex-col items-center md:items-start text-center md:text-left gap-2">
                        <a href="/" class="inline-flex items-center gap-2.5 group">
                            <div class="flex items-center gap-1 p-1 rounded bg-carbon-900 border border-carbon-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500/90"></span>
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400/90"></span>
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400/90"></span>
                            </div>
                            <span class="font-mono text-base font-bold text-white tracking-tight">
                                <span class="text-vermilion-400">&lt;</span>Ashidqy<span class="text-vermilion-400">/&gt;</span>
                            </span>
                        </a>
                        <p class="text-xs text-slate-400 max-w-md leading-relaxed font-normal">
                            {{ __('footer.tagline') }}
                        </p>
                    </div>

                    <!-- Center / Quick Links -->
                    <div class="flex items-center gap-5 text-xs font-mono text-slate-400">
                        <a href="/#projects" class="hover:text-white transition-colors">Projek</a>
                        <a href="/#tech-stack" class="hover:text-white transition-colors">Teknologi</a>
                        <a href="/#experience" class="hover:text-white transition-colors">Pengalaman</a>
                        <a href="{{ route('notes.index') }}" class="text-vermilion-400 font-semibold hover:text-vermilion-300 transition-colors">Catatan</a>
                        <a href="/" class="hover:text-white transition-colors">Beranda</a>
                    </div>

                    <!-- Right: Social Links -->
                    <div class="flex items-center gap-2.5">
                        <a href="https://github.com"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="p-2.5 rounded-lg bg-carbon-900 hover:bg-carbon-850 border border-carbon-800 hover:border-slate-700 text-slate-400 hover:text-white transition-all shadow-sm"
                           aria-label="GitHub"
                           title="GitHub">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" />
                            </svg>
                        </a>

                        <a href="https://linkedin.com"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="p-2.5 rounded-lg bg-carbon-900 hover:bg-carbon-850 border border-carbon-800 hover:border-slate-700 text-slate-400 hover:text-white transition-all shadow-sm"
                           aria-label="LinkedIn"
                           title="LinkedIn">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v8.37H9.25V10.9H6.46M7.86 6.74a1.6 1.6 0 1 0 0 3.2 1.6 1.6 0 0 0 0-3.2z" />
                            </svg>
                        </a>

                        <a href="mailto:contact@example.com"
                           class="p-2.5 rounded-lg bg-carbon-900 hover:bg-carbon-850 border border-carbon-800 hover:border-slate-700 text-slate-400 hover:text-white transition-all shadow-sm"
                           aria-label="Email"
                           title="Kirim Email">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </a>
                    </div>

                </div>

                <!-- Bottom Bar: Copyright & Built with Info -->
                <div class="mt-8 pt-8 border-t border-carbon-800/80 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
                    <p>
                        &copy; {{ date('Y') }} Ashidqy. {{ __('footer.rights') }}
                    </p>

                    <div class="flex items-center gap-1.5 font-mono text-[11px] text-slate-400">
                        <span>{{ __('footer.built_with') }}</span>
                        <span class="text-vermilion-400 font-semibold">Laravel</span>
                        <span>&amp;</span>
                        <span class="text-sky-300 font-semibold">Tailwind CSS</span>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    <!-- Reading progress JS -->
    <script>
        (function () {
            const bar   = document.getElementById('reading-progress');
            const body  = document.getElementById('article-body');
            if (!bar || !body) return;

            function updateProgress() {
                const rect        = body.getBoundingClientRect();
                const total       = rect.height;
                const scrolled    = Math.max(0, -rect.top);
                const viewHeight  = window.innerHeight;
                const progress    = Math.min(100, (scrolled / (total - viewHeight + 200)) * 100);
                bar.style.width   = progress + '%';
            }

            window.addEventListener('scroll', updateProgress, { passive: true });
        })();
    </script>
</body>
</html>
