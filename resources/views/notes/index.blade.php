<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Catatan Teknis &amp; Eksperimen — Ashidqy Handbook</title>
    <meta name="description" content="Kumpulan dokumentasi mendalam mengenai eksplorasi Cloud Engineering, Docker containerization, sistem Linux, Redis caching, dan infrastruktur deployment milik Moch Hasbi Ashidqy.">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-web.svg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800|jetbrains-mono:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-carbon-950 text-slate-100 font-sans antialiased selection:bg-rose-500 selection:text-white relative min-h-screen flex flex-col justify-between">

    <!-- Global grid background -->
    <div class="fixed inset-0 bg-[linear-gradient(to_right,#1f293d18_2px,transparent_2px),linear-gradient(to_bottom,#1f293d18_2px,transparent_2px)] bg-[size:3.5rem_3.5rem] pointer-events-none z-0"></div>

    <div class="relative z-10 flex-1">

        <!-- ── Navigation Bar ── -->
        <header class="sticky top-0 z-50 backdrop-blur-md bg-carbon-950/85 border-b border-carbon-800/80 transition-all duration-300">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-4">

                <!-- Left: Brand Logo & Back to Home -->
                <div class="flex items-center gap-3">
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

                    <span class="hidden sm:inline-flex items-center gap-1.5 text-xs font-mono text-slate-400 bg-carbon-900 border border-carbon-800 px-2 py-0.5 rounded">
                        <span>Handbook</span>
                    </span>
                </div>

                <!-- Right: Navigation Links -->
                <div class="flex items-center gap-2 sm:gap-4 font-mono text-xs">
                    <a href="/#projects" class="hidden md:inline-block text-slate-400 hover:text-white transition-colors px-2 py-1">
                        Projek
                    </a>
                    <a href="/#tech-stack" class="hidden md:inline-block text-slate-400 hover:text-white transition-colors px-2 py-1">
                        Teknologi
                    </a>
                    <a href="/#experience" class="hidden md:inline-block text-slate-400 hover:text-white transition-colors px-2 py-1">
                        Pengalaman
                    </a>

                    <a href="/"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-carbon-900 hover:bg-carbon-850 border border-carbon-800 hover:border-slate-700 text-slate-300 hover:text-white transition-all text-xs group">
                        <svg class="w-3.5 h-3.5 transition-transform group-hover:-translate-x-0.5 text-vermilion-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Beranda</span>
                    </a>
                </div>

            </div>
        </header>

        <!-- ── Main Content Container ── -->
        <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">

            <!-- ── Page Header ── -->
            <div class="max-w-3xl mb-12">
                <span class="inline-flex items-center gap-1.5 font-mono text-[11px] font-semibold uppercase tracking-widest text-vermilion-400 mb-3">
                    <span class="w-3.5 h-px bg-vermilion-500 rounded"></span>
                    // TECHNICAL NOTES &amp; ARCHITECTURE LOG
                </span>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight tracking-tight">
                    Catatan Teknis, Arsitektur &amp; Eksperimen
                </h1>
                <p class="mt-4 text-slate-400 text-sm sm:text-base leading-relaxed font-normal">
                    Dokumentasi mendalam mengenai eksplorasi Cloud Engineering, Docker containerization, sistem operasi Linux, optimasi Redis caching, dan keandalan sistem.
                </p>

                <!-- Stats summary pills -->
                <div class="flex flex-wrap items-center gap-2 sm:gap-3 mt-6 font-mono text-xs">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-carbon-900 border border-carbon-800 text-slate-300">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                        Total {{ $totalCount }} Catatan
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/20 text-cyan-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
                        {{ $cloudCount }} Cloud Engineering
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                        {{ $laravelCount }} Arsitektur Aplikasi
                    </span>
                </div>
            </div>

            <!-- ── Filter & Search Toolbar ── -->
            <div class="mb-10 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4 p-2 rounded-2xl bg-carbon-900/60 border border-carbon-800/80 backdrop-blur-sm">
                
                <!-- Category Tabs -->
                <div class="flex items-center gap-1 overflow-x-auto p-1 font-mono text-xs">
                    <a href="{{ route('notes.index', array_filter(['q' => $search])) }}"
                       class="px-3.5 py-2 rounded-xl transition-all whitespace-nowrap {{ empty($category) ? 'bg-carbon-950 text-white font-bold border border-carbon-800 shadow-sm' : 'text-slate-400 hover:text-white hover:bg-carbon-850' }}">
                        Semua ({{ $totalCount }})
                    </a>

                    <a href="{{ route('notes.index', array_filter(['category' => 'cloud_engineering', 'q' => $search])) }}"
                       class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl transition-all whitespace-nowrap {{ $category === 'cloud_engineering' ? 'bg-cyan-500/15 text-cyan-300 border border-cyan-500/30 font-bold shadow-sm' : 'text-slate-400 hover:text-cyan-400 hover:bg-carbon-850' }}">
                        <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
                        Cloud Engineering ({{ $cloudCount }})
                    </a>

                    <a href="{{ route('notes.index', array_filter(['category' => 'laravel', 'q' => $search])) }}"
                       class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl transition-all whitespace-nowrap {{ $category === 'laravel' ? 'bg-amber-500/15 text-amber-300 border border-amber-500/30 font-bold shadow-sm' : 'text-slate-400 hover:text-amber-400 hover:bg-carbon-850' }}">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                        Arsitektur Aplikasi ({{ $laravelCount }})
                    </a>
                </div>

                <!-- Search Input Form -->
                <form action="{{ route('notes.index') }}" method="GET" class="relative w-full md:w-72 px-1">
                    @if(!empty($category))
                        <input type="hidden" name="category" value="{{ $category }}">
                    @endif

                    <div class="relative">
                        <input type="text"
                               name="q"
                               value="{{ $search ?? '' }}"
                               placeholder="Cari topik / judul..."
                               class="w-full pl-9 pr-9 py-2 bg-carbon-950 border border-carbon-800 rounded-xl text-xs font-mono text-slate-200 placeholder-slate-500 focus:outline-none focus:border-vermilion-500/50 focus:ring-1 focus:ring-vermilion-500/30 transition-all">
                        
                        <svg class="w-4 h-4 text-slate-500 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>

                        @if(!empty($search))
                            <a href="{{ route('notes.index', array_filter(['category' => $category])) }}"
                               class="absolute right-2.5 top-1/2 -translate-y-1/2 p-1 text-slate-500 hover:text-white transition-colors"
                               title="Hapus pencarian">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </form>

            </div>

            <!-- ── Cards Grid ── -->
            @if($notes->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 items-stretch">
                    @foreach($notes as $note)
                        @php
                            $isLaravel = ($note->category ?? 'laravel') === 'laravel';
                            $trackBorder = $isLaravel ? 'hover:border-rose-500/40 hover:shadow-rose-500/5' : 'hover:border-cyan-500/40 hover:shadow-cyan-500/5';
                            $titleHover  = $isLaravel ? 'group-hover:text-rose-400' : 'group-hover:text-cyan-400';
                            $readLinkCol = $isLaravel ? 'text-rose-400 hover:text-rose-300' : 'text-cyan-400 hover:text-cyan-300';
                            $dateStr     = $note->published_at ? $note->published_at->format('d M Y') : '—';
                        @endphp

                        <article class="group flex flex-col justify-between rounded-2xl bg-carbon-900 border border-carbon-800 {{ $trackBorder }} transition-all duration-300 shadow-md hover:-translate-y-1 overflow-hidden">
                            
                            <!-- Card Body -->
                            <div class="p-6">
                                
                                <!-- Card Header: Track + Status + Reading time -->
                                <div class="flex items-center justify-between gap-2 mb-4">
                                    <div class="flex items-center gap-1.5">
                                        @if($isLaravel)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-mono font-medium bg-rose-500/10 text-rose-400 border border-rose-500/20">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-400"></span>
                                                Laravel
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-mono font-medium bg-cyan-500/10 text-cyan-400 border border-cyan-500/20">
                                                <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
                                                Cloud
                                            </span>
                                        @endif

                                        @if($note->tag === 'production_ready')
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-mono text-emerald-400 bg-emerald-500/10 border border-emerald-500/20" title="Production Ready">
                                                <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                                Prod
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-mono text-amber-400 bg-amber-500/10 border border-amber-500/20" title="Exploring">
                                                <svg class="w-2.5 h-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                                                Explore
                                            </span>
                                        @endif
                                    </div>

                                    <span class="text-slate-500 text-[11px] font-mono">
                                        {{ $note->reading_time }}
                                    </span>
                                </div>

                                <!-- Card Title -->
                                <a href="{{ route('notes.show', $note->slug) }}" class="block mb-2.5">
                                    <h2 class="text-base font-bold text-white {{ $titleHover }} transition-colors leading-snug">
                                        {{ $note->title }}
                                    </h2>
                                </a>

                                <!-- Card Excerpt -->
                                <p class="text-xs text-slate-300 leading-relaxed font-sans line-clamp-3">
                                    {{ $note->content }}
                                </p>

                            </div>

                            <!-- Card Footer Meta -->
                            <div class="px-6 py-3.5 bg-carbon-950/50 border-t border-carbon-800/80 flex items-center justify-between text-[11px] font-mono text-slate-400">
                                <span class="text-[10px] text-slate-500">
                                    {{ $dateStr }}
                                </span>

                                <div class="flex items-center gap-2">
                                    @if($note->relatedProject)
                                        <span class="text-[10px] font-medium text-slate-400 bg-carbon-900 border border-carbon-800 px-2 py-0.5 rounded truncate max-w-[110px]" title="Terkait: {{ $note->relatedProject->title }}">
                                            {{ $note->relatedProject->title }}
                                        </span>
                                    @endif

                                    <a href="{{ route('notes.show', $note->slug) }}"
                                       class="inline-flex items-center gap-1 text-[11px] font-semibold {{ $readLinkCol }} transition-colors">
                                        Baca
                                        <svg class="w-3 h-3 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($notes->hasPages())
                    <div class="mt-12 flex justify-center">
                        {{ $notes->links() }}
                    </div>
                @endif

            @else
                <!-- Empty State -->
                <div class="p-12 text-center rounded-2xl bg-carbon-900/40 border border-dashed border-carbon-800 max-w-lg mx-auto">
                    <div class="w-12 h-12 rounded-xl bg-carbon-800 border border-carbon-700 mx-auto flex items-center justify-center text-slate-400 mb-4">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-white mb-1">Tidak Ada Catatan Ditemukan</h3>
                    <p class="text-xs text-slate-400 mb-6">
                        @if(!empty($search))
                            Tidak ada catatan yang cocok dengan kata kunci "<strong>{{ $search }}</strong>".
                        @else
                            Belum ada catatan publik untuk kategori ini.
                        @endif
                    </p>
                    <a href="{{ route('notes.index') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-carbon-800 hover:bg-carbon-700 text-xs font-mono text-slate-200 hover:text-white transition-all">
                        Reset Filter &amp; Pencarian
                    </a>
                </div>
            @endif

        </main>

    </div>

    <!-- ── Full Site Footer ── -->
    <x-footer />

</body>
</html>
