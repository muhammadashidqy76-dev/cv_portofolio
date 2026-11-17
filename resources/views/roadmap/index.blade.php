<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $currentRole->name }} — Learning Path Tracker | Ashidqy</title>
    <meta name="description" content="Peta kurikulum pembelajaran terapan dan penguasaan peran {{ $currentRole->name }} oleh Moch Hasbi Ashidqy.">

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
             selectedStatus: 'all',
             matchesFilter(itemStatus, itemTitle, itemDesc, itemRef) {
                 const matchStatus = (this.selectedStatus === 'all' || this.selectedStatus === itemStatus);
                 const query = this.search.toLowerCase().trim();
                 const matchSearch = !query || 
                     itemTitle.toLowerCase().includes(query) || 
                     (itemDesc && itemDesc.toLowerCase().includes(query)) ||
                     (itemRef && itemRef.toLowerCase().includes(query));
                 return matchStatus && matchSearch;
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

                    <span class="hidden sm:inline-flex items-center gap-1.5 text-xs font-mono text-indigo-400 bg-indigo-500/10 border border-indigo-500/20 px-2 py-0.5 rounded">
                        <span>Learning Path</span>
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
                    <span class="text-slate-300">Learning Path Tracker</span>
                    <span class="text-slate-600">/</span>
                    <span class="text-indigo-400 font-semibold">{{ $currentRole->name }}</span>
                </nav>

                <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 border-b border-carbon-800 pb-8">
                    <div class="max-w-3xl space-y-3">
                        <div class="inline-flex items-center gap-2 font-mono text-[11px] font-semibold uppercase tracking-widest text-indigo-400">
                            <span class="w-3.5 h-px bg-indigo-500 rounded"></span>
                            <span>ROLE LEARNING PATH // {{ strtoupper($currentRole->slug) }}</span>
                        </div>
                        <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight">
                            {{ $currentRole->name }}
                        </h1>
                        <p class="text-slate-400 text-sm sm:text-base leading-relaxed">
                            {{ $currentRole->tagline }}
                        </p>
                    </div>

                    <!-- Live Progress Bar & Status Pill -->
                    <div class="space-y-3 self-start lg:self-end shrink-0 w-full lg:w-72">
                        <div class="flex items-center justify-between font-mono text-xs">
                            <span class="text-slate-400">Tingkat Penguasaan</span>
                            <span class="font-bold text-emerald-400">{{ $stats['percentage'] }}% Selesai</span>
                        </div>
                        <!-- Progress track -->
                        <div class="w-full h-2 rounded-full bg-carbon-900 border border-carbon-800 overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-indigo-500 to-emerald-400 transition-all duration-500 rounded-full"
                                 style="width: {{ $stats['percentage'] }}%"></div>
                        </div>
                        <div class="flex items-center justify-between font-mono text-[11px] text-slate-500">
                            <span>{{ $stats['finished'] }} dari {{ $stats['total'] }} modul</span>
                            <span>{{ $stats['in_progress'] }} on progress</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── Role Switcher Tabs (Jika ada multi-role di masa depan) ── -->
            @if ($allRoles->count() > 1)
                <div class="flex items-center gap-2 border-b border-carbon-800/80 pb-3 font-mono text-xs">
                    <span class="text-slate-500 text-[11px] uppercase tracking-wider">Pilih Role:</span>
                    @foreach ($allRoles as $r)
                        <a href="{{ route('roadmap.index', ['roleSlug' => $r->slug]) }}"
                           class="px-3 py-1.5 rounded-lg transition-colors {{ $r->id === $currentRole->id ? 'bg-indigo-500 text-white font-semibold shadow-sm' : 'bg-carbon-900 text-slate-400 hover:text-white border border-carbon-800' }}">
                            {{ $r->name }}
                        </a>
                    @endforeach
                </div>
            @endif

            <!-- ── Stat Metric Cards ── -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-mono text-slate-400 uppercase tracking-wider">Total Checkpoints</div>
                        <div class="text-2xl font-bold font-mono text-white mt-1">{{ $stats['total'] }}</div>
                    </div>
                    <div class="w-9 h-9 rounded-lg bg-carbon-950 border border-carbon-800 flex items-center justify-center text-slate-400">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- ── Interactive Filter & Search Bar ── -->
            <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 flex flex-col md:flex-row md:items-center justify-between gap-4 font-mono text-xs">
                
                <!-- Status Filter Pills -->
                <div class="flex items-center gap-2">
                    <span class="text-slate-500 text-[11px] uppercase tracking-wider">Filter Status:</span>
                    <button type="button"
                            @click="selectedStatus = 'all'"
                            :class="selectedStatus === 'all' ? 'text-white underline decoration-indigo-500 underline-offset-4 font-bold' : 'text-slate-400 hover:text-white'"
                            class="px-2 py-0.5 transition-colors">
                        Semua ({{ $stats['total'] }})
                    </button>
                    <button type="button"
                            @click="selectedStatus = 'finished'"
                            :class="selectedStatus === 'finished' ? 'text-emerald-400 underline decoration-emerald-500 underline-offset-4 font-bold' : 'text-slate-400 hover:text-white'"
                            class="px-2 py-0.5 transition-colors">
                        Finished ({{ $stats['finished'] }})
                    </button>
                    <button type="button"
                            @click="selectedStatus = 'in_progress'"
                            :class="selectedStatus === 'in_progress' ? 'text-amber-400 underline decoration-amber-500 underline-offset-4 font-bold' : 'text-slate-400 hover:text-white'"
                            class="px-2 py-0.5 transition-colors">
                        In Progress ({{ $stats['in_progress'] }})
                    </button>
                    <button type="button"
                            @click="selectedStatus = 'not_started'"
                            :class="selectedStatus === 'not_started' ? 'text-rose-400 underline decoration-rose-500 underline-offset-4 font-bold' : 'text-slate-400 hover:text-white'"
                            class="px-2 py-0.5 transition-colors">
                        Planned ({{ $stats['not_started'] }})
                    </button>
                </div>

                <!-- Search Input -->
                <div class="relative w-full md:w-64">
                    <input type="text"
                           x-model="search"
                           placeholder="Cari materi / modul..."
                           class="w-full bg-carbon-950 border border-carbon-800 text-slate-100 text-xs rounded-lg pl-8 pr-3 py-2 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30 font-mono transition-colors">
                    <svg class="w-3.5 h-3.5 text-slate-500 absolute left-2.5 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <!-- ── Structured Phases & Checkpoints Feed ── -->
            <div class="space-y-10">
                @foreach ($phases as $phaseName => $items)
                    <div class="space-y-4">
                        
                        <!-- Phase Header Bar -->
                        <div class="flex items-center justify-between pb-3 border-b border-carbon-800">
                            <div class="flex items-center gap-3">
                                <span class="w-2.5 h-2.5 rounded-sm bg-indigo-500"></span>
                                <h2 class="text-base sm:text-lg font-bold font-mono text-white tracking-tight">
                                    {{ $phaseName }}
                                </h2>
                            </div>
                            <span class="text-xs font-mono text-slate-500">
                                {{ count($items) }} Checkpoints
                            </span>
                        </div>

                        <!-- Checkpoints Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($items as $item)
                                @php
                                    $badge = $item->status_badge_classes;
                                @endphp
                                <div x-show="matchesFilter('{{ $item->status }}', '{{ addslashes($item->title) }}', '{{ addslashes($item->description ?? '') }}', '{{ addslashes($item->source_reference ?? '') }}')"
                                     x-transition:enter="transition ease-out duration-150"
                                     x-transition:enter-start="opacity-0 translate-y-1"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     class="p-5 rounded-xl bg-carbon-900 border border-carbon-800 hover:border-carbon-700 transition-all duration-200 flex flex-col justify-between space-y-4">
                                    
                                    <div class="space-y-3">
                                        <!-- Top bar: Status badge & Reference -->
                                        <div class="flex items-start justify-between gap-2">
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md {{ $badge['bg'] }} border {{ $badge['border'] }} font-mono text-[11px] {{ $badge['text'] }}">
                                                <span class="w-1.5 h-1.5 rounded-full {{ $badge['dot'] }}"></span>
                                                <span>{!! $badge['label'] !!}</span>
                                            </span>

                                            @if ($item->source_reference)
                                                <span class="text-[10px] font-mono text-slate-500 text-right truncate max-w-[200px]" title="{{ $item->source_reference }}">
                                                    {{ $item->source_reference }}
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Checkpoint Title -->
                                        <h3 class="text-sm sm:text-base font-bold text-white tracking-tight">
                                            {{ $item->title }}
                                        </h3>

                                        <!-- Checkpoint Description -->
                                        <p class="text-xs sm:text-sm text-slate-400 leading-relaxed font-normal">
                                            {{ $item->description }}
                                        </p>
                                    </div>

                                    <!-- Bottom Action Links (Note / Project integration) -->
                                    <div class="pt-3 border-t border-carbon-800/80 flex flex-wrap items-center justify-between gap-2 text-xs font-mono">
                                        @if ($item->note)
                                            <a href="{{ route('notes.show', $item->note->slug) }}"
                                               class="inline-flex items-center gap-1.5 text-indigo-400 hover:text-indigo-300 transition-colors group">
                                                <svg class="w-3.5 h-3.5 text-indigo-400 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                </svg>
                                                <span>Baca Catatan Teknis &rarr;</span>
                                            </a>
                                        @else
                                            <span class="text-[11px] text-slate-600 italic">Dokumentasi teori internal</span>
                                        @endif

                                        @if ($item->project)
                                            <a href="/#projects"
                                               class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-carbon-950 border border-carbon-800 text-vermilion-400 hover:text-vermilion-300 transition-colors text-[11px]">
                                                <span>Projek: {{ $item->project->title }}</span>
                                            </a>
                                        @endif
                                    </div>

                                </div>
                            @endforeach
                        </div>

                    </div>
                @endforeach
            </div>

            <!-- ── Back to Top & Return to Home Bar ── -->
            <div class="pt-8 border-t border-carbon-800/80 flex flex-col sm:flex-row items-center justify-between gap-4 font-mono text-xs">
                <a href="/" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-carbon-900 hover:bg-carbon-850 border border-carbon-800 text-slate-300 hover:text-white transition-colors">
                    <svg class="w-4 h-4 text-vermilion-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali ke Beranda</span>
                </a>

                <button type="button" @click="window.scrollTo({ top: 0, behavior: 'smooth' })" class="text-slate-400 hover:text-white transition-colors flex items-center gap-1.5 cursor-pointer">
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
                <p>&copy; {{ date('Y') }} Moch Hasbi Ashidqy &bull; IT Support, Cloud &amp; Backend Engineer.</p>
                <p class="text-slate-600">Built with Laravel, Blade, Tailwind CSS &amp; Alpine.js.</p>
            </div>
        </footer>

    </div>

</body>
</html>
