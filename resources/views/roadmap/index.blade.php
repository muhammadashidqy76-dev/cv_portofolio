<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Developer Roadmap &amp; Skill Mastery — Ashidqy</title>
    <meta name="description" content="Peta kurikulum pembelajaran dan penguasaan teknologi Laravel Backend Developer oleh Moch Hasbi Ashidqy.">

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

    <div class="relative z-10 flex-1"
         x-data="{
             search: '',
             selectedCategory: '{{ $selectedCategory ?? 'all' }}',
             selectedStatus: '{{ $selectedStatus ?? 'all' }}',
             highlightedTech: '{{ $tech ?? '' }}',
             init() {
                 const hash = window.location.hash.replace('#tech-', '');
                 if (hash) {
                     this.highlightedTech = hash;
                 }
                 if (this.highlightedTech) {
                     this.$nextTick(() => {
                         const el = document.getElementById('tech-' + this.highlightedTech);
                         if (el) {
                             el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                         }
                     });
                 }
             },
             matchesFilter(itemCat, itemStatus, itemName, itemDesc) {
                 const matchCat = (this.selectedCategory === 'all' || this.selectedCategory === itemCat);
                 const matchStatus = (this.selectedStatus === 'all' || this.selectedStatus === itemStatus);
                 const query = this.search.toLowerCase().trim();
                 const matchSearch = !query || 
                     itemName.toLowerCase().includes(query) || 
                     itemCat.toLowerCase().includes(query) ||
                     (itemDesc && itemDesc.toLowerCase().includes(query));
                 return matchCat && matchStatus && matchSearch;
             }
         }">

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
                        <span>Roadmap</span>
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
                    <a href="/notes" class="hidden md:inline-block text-slate-400 hover:text-white transition-colors px-2 py-1">
                        Catatan Teknis
                    </a>
                    <a href="/" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-carbon-900 hover:bg-carbon-850 border border-carbon-800 text-vermilion-400 hover:text-vermilion-300 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Beranda</span>
                    </a>
                </div>
            </div>
        </header>

        <!-- ── Main Content Container ── -->
        <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16 space-y-10">

            <!-- ── Breadcrumb & Section Badge ── -->
            <div class="space-y-4">
                <nav class="flex items-center gap-2 font-mono text-xs text-slate-400">
                    <a href="/" class="hover:text-white transition-colors">Beranda</a>
                    <span class="text-slate-600">/</span>
                    <a href="/#tech-stack" class="hover:text-white transition-colors">Teknologi</a>
                    <span class="text-slate-600">/</span>
                    <span class="text-vermilion-400 font-semibold">Roadmap</span>
                </nav>

                <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 border-b border-carbon-800 pb-8">
                    <div class="max-w-2xl space-y-2">
                        <div class="inline-flex items-center gap-2 font-mono text-[11px] font-semibold uppercase tracking-widest text-vermilion-400">
                            <span class="w-3.5 h-px bg-vermilion-500 rounded"></span>
                            <span>BACKEND ENGINEERING TRACK // ROADMAP</span>
                        </div>
                        <h1 class="text-2xl sm:text-4xl font-extrabold text-white tracking-tight">
                            Peta Penguasaan Teknologi
                        </h1>
                        <p class="text-slate-400 text-sm sm:text-base leading-relaxed">
                            Kurikulum terstruktur dan rekam jejak penguasaan spesialisasi <strong class="text-white font-medium">Laravel Backend Developer</strong> — dari sintaks bahasa pemrograman, arsitektur framework MVC, optimasi basis data &amp; caching, hingga otomatisasi kontainer.
                        </p>
                    </div>

                    <!-- Live Status Legend Mini -->
                    <div class="flex flex-wrap items-center gap-2 sm:gap-3 font-mono text-xs self-start lg:self-end">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-emerald-400/10 border border-emerald-400/20 text-emerald-400">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            Finished ({{ $stats['finished'] }})
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-amber-400/10 border border-amber-400/20 text-amber-400">
                            <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                            In Progress ({{ $stats['in_progress'] }})
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-rose-400/10 border border-rose-400/20 text-rose-400">
                            <span class="w-2 h-2 rounded-full bg-rose-400"></span>
                            Not Started ({{ $stats['not_started'] }})
                        </span>
                    </div>
                </div>
            </div>

            <!-- ── Stat Metric Cards ── -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-mono text-slate-400 uppercase tracking-wider">Total Ekosistem</div>
                        <div class="text-2xl font-bold font-mono text-white mt-1">{{ $stats['total'] }}</div>
                    </div>
                    <div class="w-9 h-9 rounded-lg bg-carbon-950 border border-carbon-800 flex items-center justify-center text-slate-400">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-mono text-emerald-400 uppercase tracking-wider">Selesai (Finished)</div>
                        <div class="text-2xl font-bold font-mono text-emerald-400 mt-1">{{ $stats['finished'] }}</div>
                    </div>
                    <div class="w-9 h-9 rounded-lg bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-mono text-amber-400 uppercase tracking-wider">Sedang Belajar</div>
                        <div class="text-2xl font-bold font-mono text-amber-400 mt-1">{{ $stats['in_progress'] }}</div>
                    </div>
                    <div class="w-9 h-9 rounded-lg bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-mono text-rose-400 uppercase tracking-wider">Target Belajar</div>
                        <div class="text-2xl font-bold font-mono text-rose-400 mt-1">{{ $stats['not_started'] }}</div>
                    </div>
                    <div class="w-9 h-9 rounded-lg bg-rose-500/10 border border-rose-500/20 flex items-center justify-center text-rose-400">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- ── Interactive Filter & Search Bar ── -->
            <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 space-y-4">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    
                    <!-- Category Tabs -->
                    <div class="flex flex-wrap items-center gap-1.5 font-mono text-xs">
                        <button type="button"
                                @click="selectedCategory = 'all'"
                                :class="selectedCategory === 'all' 
                                    ? 'bg-vermilion-500 text-white font-semibold' 
                                    : 'bg-carbon-950 text-slate-400 hover:text-white hover:bg-carbon-850 border border-carbon-800'"
                                class="px-3 py-1.5 rounded-lg transition-colors">
                            Semua Kategori
                        </button>
                        @foreach ($categories as $cat)
                            <button type="button"
                                    @click="selectedCategory = '{{ $cat }}'"
                                    :class="selectedCategory === '{{ $cat }}' 
                                        ? 'bg-vermilion-500 text-white font-semibold' 
                                        : 'bg-carbon-950 text-slate-400 hover:text-white hover:bg-carbon-850 border border-carbon-800'"
                                    class="px-3 py-1.5 rounded-lg transition-colors">
                                {{ $cat }}
                            </button>
                        @endforeach
                    </div>

                    <!-- Search Input -->
                    <div class="relative w-full md:w-64">
                        <input type="text"
                               x-model="search"
                               placeholder="Cari skill / topik..."
                               class="w-full bg-carbon-950 border border-carbon-800 text-slate-100 text-xs rounded-lg pl-8 pr-3 py-2 focus:border-vermilion-500 focus:ring-1 focus:ring-vermilion-500/30 font-mono transition-colors">
                        <svg class="w-3.5 h-3.5 text-slate-500 absolute left-2.5 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Status Filter Pills -->
                <div class="flex items-center gap-2 pt-2 border-t border-carbon-800/60 font-mono text-xs">
                    <span class="text-slate-500 text-[11px] uppercase tracking-wider">Status:</span>
                    <button type="button"
                            @click="selectedStatus = 'all'"
                            :class="selectedStatus === 'all' ? 'text-white underline decoration-vermilion-500 underline-offset-4 font-bold' : 'text-slate-400 hover:text-white'"
                            class="px-2 py-0.5 transition-colors">
                        Semua
                    </button>
                    <button type="button"
                            @click="selectedStatus = 'finished'"
                            :class="selectedStatus === 'finished' ? 'text-emerald-400 underline decoration-emerald-500 underline-offset-4 font-bold' : 'text-slate-400 hover:text-white'"
                            class="px-2 py-0.5 transition-colors">
                        Finished
                    </button>
                    <button type="button"
                            @click="selectedStatus = 'in_progress'"
                            :class="selectedStatus === 'in_progress' ? 'text-amber-400 underline decoration-amber-500 underline-offset-4 font-bold' : 'text-slate-400 hover:text-white'"
                            class="px-2 py-0.5 transition-colors">
                        In Progress
                    </button>
                    <button type="button"
                            @click="selectedStatus = 'not_started'"
                            :class="selectedStatus === 'not_started' ? 'text-rose-400 underline decoration-rose-500 underline-offset-4 font-bold' : 'text-slate-400 hover:text-white'"
                            class="px-2 py-0.5 transition-colors">
                        Not Started
                    </button>
                </div>
            </div>

            <!-- ── Tech Stack Roadmap Detailed Feed ── -->
            <div class="space-y-8">
                @php
                    $techIconPaths = [
                        'Laravel'          => '<path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>',
                        'PHP'              => '<path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h10M7 16h10"/>',
                        'RESTful API'      => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>',
                        'MySQL'            => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>',
                        'Redis'            => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 2l9 4.9v9.8L12 22l-9-4.9V6.9L12 2z"/>',
                        'Blade Templating' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16v12H4z"/>',
                        'Blade'            => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16v12H4z"/>',
                        'Tailwind CSS'     => '<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
                        'Alpine.js'        => '<path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/>',
                        'Git & GitHub'     => '<path stroke-linecap="round" stroke-linejoin="round" d="M8 7h8M8 12h8M8 17h8"/>',
                        'Composer'         => '<path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 12h14M5 16h14"/>',
                        'Postman'          => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>',
                        'Docker'           => '<path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>',
                    ];
                    $fallbackIconPath = '<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>';
                @endphp

                @foreach ($items as $item)
                    @php
                        $slug = \Illuminate\Support\Str::slug($item->name);
                        $badgeClasses = $item->status_badge_classes;
                        $iconPath = $techIconPaths[$item->name] ?? $fallbackIconPath;
                        $curr = $curriculum[$item->name] ?? null;
                    @endphp

                    <div id="tech-{{ $slug }}"
                         x-show="matchesFilter('{{ $item->category }}', '{{ $item->status }}', '{{ addslashes($item->name) }}', '{{ addslashes($curr['description'] ?? '') }}')"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="rounded-xl bg-carbon-900 border transition-all duration-300 overflow-hidden"
                         :class="highlightedTech === '{{ $slug }}' 
                             ? 'border-emerald-400 ring-2 ring-emerald-400/40 shadow-xl shadow-emerald-500/10' 
                             : 'border-carbon-800 hover:border-carbon-700'">

                        <!-- Card Header Bar -->
                        <div class="px-6 py-4 bg-carbon-950/70 border-b border-carbon-800/80 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <!-- Tech Icon -->
                                <div class="w-9 h-9 rounded-lg {{ $badgeClasses['bg'] }} border {{ $badgeClasses['border'] }} flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4 {{ $badgeClasses['text'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        {!! $iconPath !!}
                                    </svg>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h2 class="text-base sm:text-lg font-bold font-mono text-white tracking-tight">
                                            {{ $item->name }}
                                        </h2>
                                        <span class="text-[11px] font-mono px-2 py-0.5 rounded bg-carbon-900 border border-carbon-800 text-slate-400">
                                            {{ $item->category }}
                                        </span>
                                        <template x-if="highlightedTech === '{{ $slug }}'">
                                            <span class="text-[10px] font-mono font-semibold px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-300 border border-emerald-500/40 animate-pulse">
                                                FOKUS AKTIF
                                            </span>
                                        </template>
                                    </div>
                                    @if ($curr)
                                        <span class="text-[11px] font-mono text-vermilion-400">
                                            {{ $curr['phase'] }} &bull; {{ $curr['level'] }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md {{ $badgeClasses['bg'] }} border {{ $badgeClasses['border'] }} font-mono text-xs {{ $badgeClasses['text'] }}">
                                    @if ($item->status === \App\Models\TechStackItem::STATUS_FINISHED)
                                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                        <span>Finished &bull; Selesai Dikuasai</span>
                                    @elseif ($item->status === \App\Models\TechStackItem::STATUS_IN_PROGRESS)
                                        <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                                        <span>In Progress &bull; Sedang Berjalan</span>
                                    @else
                                        <span class="w-2 h-2 rounded-full bg-rose-400"></span>
                                        <span>Not Started &bull; Rencana Belajar</span>
                                    @endif
                                </span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 space-y-6">
                            @if ($curr)
                                <p class="text-sm text-slate-300 leading-relaxed">
                                    {{ $curr['description'] }}
                                </p>

                                <!-- Roadmap Checkpoints List -->
                                <div>
                                    <div class="flex items-center justify-between mb-3">
                                        <h3 class="text-xs font-mono font-semibold uppercase tracking-wider text-slate-400">
                                            Key Milestones &amp; Capaian Kompetensi
                                        </h3>
                                        <span class="text-[11px] font-mono text-slate-500">
                                            {{ count($curr['checkpoints']) }} Checkpoints
                                        </span>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        @foreach ($curr['checkpoints'] as $cp)
                                            <div class="p-3 rounded-lg bg-carbon-950/60 border border-carbon-800/80 flex items-start gap-3">
                                                <div class="mt-0.5 shrink-0">
                                                    @if ($item->status === \App\Models\TechStackItem::STATUS_FINISHED)
                                                        <svg class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    @elseif ($item->status === \App\Models\TechStackItem::STATUS_IN_PROGRESS)
                                                        <svg class="w-4 h-4 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    @else
                                                        <div class="w-3.5 h-3.5 rounded-full border border-slate-600 mt-0.5"></div>
                                                    @endif
                                                </div>
                                                <div class="space-y-0.5">
                                                    <div class="font-mono text-xs font-semibold text-white">
                                                        {{ $cp['title'] }}
                                                    </div>
                                                    <div class="text-[11px] text-slate-400 leading-normal">
                                                        {{ $cp['desc'] }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Connected Featured Projects -->
                            <div class="pt-4 border-t border-carbon-800/60 flex flex-col sm:flex-row sm:items-center justify-between gap-3 font-mono text-xs">
                                <div class="flex items-center gap-2">
                                    <span class="text-slate-400">Implementasi pada Proyek:</span>
                                    @if ($item->projects->isNotEmpty())
                                        <div class="flex flex-wrap items-center gap-1.5">
                                            @foreach ($item->projects as $proj)
                                                <a href="/#projects" class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-carbon-950 border border-carbon-800 text-vermilion-400 hover:text-vermilion-300 transition-colors">
                                                    <span>{{ $proj->title }}</span>
                                                    <span class="text-[10px] text-slate-500">(Tier {{ $proj->complexity_order }})</span>
                                                </a>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-slate-500 italic">Belum ditautkan ke featured project spesifik</span>
                                    @endif
                                </div>

                                @if ($curr && !empty($curr['documentation']))
                                    <a href="{{ $curr['documentation'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-slate-400 hover:text-white transition-colors">
                                        <span>Dokumentasi Resmi</span>
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                    </a>
                                @endif
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            <!-- ── Back to Top & Return to Home Bar ── -->
            <div class="pt-8 border-t border-carbon-800/80 flex flex-col sm:flex-row items-center justify-between gap-4 font-mono text-xs">
                <a href="/#tech-stack" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-carbon-900 hover:bg-carbon-850 border border-carbon-800 text-slate-300 hover:text-white transition-colors">
                    <svg class="w-4 h-4 text-vermilion-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali ke Bagian Tech Stack Beranda</span>
                </a>

                <button type="button" @click="window.scrollTo({ top: 0, behavior: 'smooth' })" class="text-slate-400 hover:text-white transition-colors flex items-center gap-1.5">
                    <span>Kembali ke Atas</span>
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                    </svg>
                </button>
            </div>

        </main>

        <!-- ── Footer ── -->
        <footer class="mt-16 border-t border-carbon-800/80 py-8 text-center text-xs font-mono text-slate-500">
            <div class="max-w-6xl mx-auto px-4 space-y-2">
                <p>&copy; {{ date('Y') }} Moch Hasbi Ashidqy &bull; Laravel Backend Developer.</p>
                <p class="text-slate-600">Built with Laravel, Blade, Tailwind CSS &amp; Alpine.js.</p>
            </div>
        </footer>

    </div>

</body>
</html>

