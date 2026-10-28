<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 font-mono text-xs text-slate-400 mb-1">
                    <a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">Cms</a>
                    <span class="text-slate-600">/</span>
                    <span class="text-vermilion-400">Notes</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold font-mono text-white tracking-tight">
                    Catatan Teknis &amp; Learning Log
                </h1>
                <p class="text-xs font-mono text-slate-400 mt-0.5">
                    Kelola dokumentasi arsitektur, deep-dive Laravel, cloud engineering, dan artikel teknis untuk /notes.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('notes.index') }}" 
                    target="_blank" 
                    class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg font-mono text-xs text-slate-300 hover:text-white bg-carbon-900 hover:bg-carbon-850 border border-carbon-800 transition-colors">
                        <span>Lihat Halaman Publik</span>
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </a>
                <a href="{{ route('learning-log.create') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-vermilion-500 hover:bg-vermilion-600 text-white font-mono text-xs font-semibold shadow-lg shadow-vermilion-500/20 transition-all hover:scale-[1.02] active:scale-[0.98]">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Tulis Catatan Baru</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8"
         x-data="{
             deleteModalOpen: false,
             deleteAction: '',
             noteTitle: '',
             noteCategory: '',
             noteTag: '',
             noteSlug: '',
             openDeleteModal(action, title, category, tag, slug) {
                 this.deleteAction = action;
                 this.noteTitle = title;
                 this.noteCategory = category;
                 this.noteTag = tag;
                 this.noteSlug = slug;
                 this.deleteModalOpen = true;
             },
             closeDeleteModal() {
                 this.deleteModalOpen = false;
             }
         }"
         @keydown.escape.window="closeDeleteModal()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Flash Session Alert -->
            @if (session('status'))
                <div class="flex items-center justify-between p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-mono">
                    <div class="flex items-center gap-2.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>{{ session('status') }}</span>
                    </div>
                    <span class="text-[10px] text-emerald-500/70 uppercase">SUCCESS_OK</span>
                </div>
            @endif

            <!-- ─── STATS CARDS ────────────────────────────────────────────────── -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                
                <!-- 1. Total Catatan -->
                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 shadow-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] font-mono uppercase tracking-wider text-slate-500">Total Artikel</span>
                        <span class="w-2 h-2 rounded-full bg-vermilion-400"></span>
                    </div>
                    <div class="text-2xl font-bold font-mono text-white">{{ $stats['total'] }}</div>
                    <span class="text-[11px] font-mono text-slate-400">Catatan &amp; Eksperimen</span>
                </div>

                <!-- 2. Pilar Kategori -->
                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 shadow-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] font-mono uppercase tracking-wider text-slate-500">Pilar Utama</span>
                        <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                    </div>
                    <div class="text-2xl font-bold font-mono text-white">
                        <span class="text-vermilion-400">{{ $stats['laravel'] }}</span> <span class="text-slate-600 font-normal">/</span> <span class="text-cyan-400">{{ $stats['cloud'] }}</span>
                    </div>
                    <span class="text-[11px] font-mono text-slate-400">Laravel / Cloud &amp; DevOps</span>
                </div>

                <!-- 3. Status Tag Kesiapan -->
                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 shadow-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] font-mono uppercase tracking-wider text-slate-500">Tingkat Kesiapan</span>
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    </div>
                    <div class="text-2xl font-bold font-mono text-white">
                        <span class="text-emerald-400">{{ $stats['production_ready'] }}</span> <span class="text-slate-600 font-normal">/</span> <span class="text-amber-400">{{ $stats['exploring'] }}</span>
                    </div>
                    <span class="text-[11px] font-mono text-slate-400">Production-Ready / Exploring</span>
                </div>

                <!-- 4. Status Publikasi -->
                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 shadow-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] font-mono uppercase tracking-wider text-slate-500">Status Tayang</span>
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    </div>
                    <div class="text-2xl font-bold font-mono text-emerald-400">{{ $stats['published'] }}</div>
                    <span class="text-[11px] font-mono text-slate-400">{{ $stats['draft'] }} draft tersimpan</span>
                </div>

            </div>

            <!-- ─── TOOLBAR & FILTER TABS ──────────────────────────────────────── -->
            <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 space-y-3">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                    
                    <!-- Filter Pills Kategori & Tag -->
                    <div class="flex items-center gap-1.5 flex-wrap">
                        <a href="{{ route('learning-log.index') }}" 
                           class="px-3 py-1.5 rounded-lg text-xs font-mono transition-colors {{ empty($selectedCategory) && empty($selectedTag) && empty($selectedStatus) ? 'bg-carbon-800 text-white font-semibold' : 'text-slate-400 hover:text-white hover:bg-carbon-850' }}">
                            Semua ({{ $stats['total'] }})
                        </a>
                        <a href="{{ route('learning-log.index', ['category' => 'laravel']) }}" 
                           class="px-3 py-1.5 rounded-lg text-xs font-mono transition-colors {{ $selectedCategory === 'laravel' ? 'bg-vermilion-500/20 text-vermilion-400 font-semibold border border-vermilion-500/30' : 'text-slate-400 hover:text-white hover:bg-carbon-850' }}">
                            Laravel ({{ $stats['laravel'] }})
                        </a>
                        <a href="{{ route('learning-log.index', ['category' => 'cloud_engineering']) }}" 
                           class="px-3 py-1.5 rounded-lg text-xs font-mono transition-colors {{ $selectedCategory === 'cloud_engineering' ? 'bg-cyan-500/20 text-cyan-400 font-semibold border border-cyan-500/30' : 'text-slate-400 hover:text-white hover:bg-carbon-850' }}">
                            Cloud &amp; DevOps ({{ $stats['cloud'] }})
                        </a>
                        <span class="text-slate-700 hidden sm:inline">|</span>
                        <a href="{{ route('learning-log.index', ['tag' => 'production_ready']) }}" 
                           class="px-3 py-1.5 rounded-lg text-xs font-mono transition-colors {{ $selectedTag === 'production_ready' ? 'bg-emerald-500/20 text-emerald-400 font-semibold border border-emerald-500/30' : 'text-slate-400 hover:text-white hover:bg-carbon-850' }}">
                            Production-Ready ({{ $stats['production_ready'] }})
                        </a>
                        <a href="{{ route('learning-log.index', ['tag' => 'exploring']) }}" 
                           class="px-3 py-1.5 rounded-lg text-xs font-mono transition-colors {{ $selectedTag === 'exploring' ? 'bg-amber-500/20 text-amber-400 font-semibold border border-amber-500/30' : 'text-slate-400 hover:text-white hover:bg-carbon-850' }}">
                            Exploring ({{ $stats['exploring'] }})
                        </a>
                    </div>

                    <!-- Search Input -->
                    <form method="GET" action="{{ route('learning-log.index') }}" class="flex items-center gap-2">
                        @if($selectedCategory)<input type="hidden" name="category" value="{{ $selectedCategory }}">@endif
                        @if($selectedTag)<input type="hidden" name="tag" value="{{ $selectedTag }}">@endif
                        @if($selectedStatus)<input type="hidden" name="status" value="{{ $selectedStatus }}">@endif

                        <div class="relative">
                            <input type="text" 
                                   name="q" 
                                   value="{{ $search ?? '' }}" 
                                   placeholder="Cari judul / konten..." 
                                   class="w-48 sm:w-64 bg-carbon-950 border border-carbon-800 text-xs font-mono text-slate-200 rounded-lg pl-8 pr-3 py-1.5 focus:border-vermilion-500 focus:ring-1 focus:ring-vermilion-500/30 placeholder-slate-600 transition-colors">
                            <svg class="w-3.5 h-3.5 text-slate-500 absolute left-2.5 top-2.5 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </form>

                </div>
            </div>

            <!-- ─── ARTICLES LIST (RESPONSIVE GRID) ────────────────────────────── -->
            @if ($entries->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 items-stretch">
                    @foreach ($entries as $item)
                        @php
                            $publishedFormatted = $item->published_at ? $item->published_at->format('d M Y') : 'Draft';
                            $isLaravel = $item->category === 'laravel';
                            $isProd = $item->tag === 'production_ready';
                        @endphp

                        <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-xl overflow-hidden flex flex-col justify-between hover:border-carbon-700/80 transition-all duration-200">
                            
                            <div>
                                <!-- Window Mockup Header Bar -->
                                <div class="px-4 py-2.5 bg-carbon-950/80 border-b border-carbon-800 flex items-center justify-between gap-2 flex-wrap select-none">
                                    <div class="flex items-center gap-2">
                                        <div class="flex items-center gap-1.5">
                                            <span class="w-2 h-2 rounded-full bg-rose-500/80"></span>
                                            <span class="w-2 h-2 rounded-full bg-amber-400/80"></span>
                                            <span class="w-2 h-2 rounded-full bg-emerald-400/80"></span>
                                        </div>
                                        
                                        <!-- Category Badge -->
                                        <span class="font-mono text-[10px] font-semibold uppercase px-2 py-0.5 rounded border {{ $isLaravel ? 'text-vermilion-400 bg-vermilion-500/10 border-vermilion-500/20' : 'text-cyan-400 bg-cyan-500/10 border-cyan-500/20' }}">
                                            {{ $isLaravel ? 'Laravel' : 'Cloud & DevOps' }}
                                        </span>

                                        <!-- Tag Badge -->
                                        <span class="font-mono text-[10px] font-semibold uppercase px-2 py-0.5 rounded border {{ $isProd ? 'text-emerald-400 bg-emerald-500/10 border-emerald-500/20' : 'text-amber-400 bg-amber-500/10 border-amber-500/20' }}">
                                            {{ $isProd ? 'Production-Ready' : 'Exploring' }}
                                        </span>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <span class="font-mono text-[10px] text-slate-400 bg-carbon-950 px-2 py-0.5 rounded border border-carbon-800">
                                            {{ $item->reading_time }}
                                        </span>
                                        <span class="font-mono text-[10px] px-2 py-0.5 rounded border {{ $item->status === 'published' ? 'text-emerald-400 bg-emerald-500/10 border-emerald-500/20' : 'text-slate-400 bg-carbon-800 border-carbon-700' }}">
                                            {{ strtoupper($item->status) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="p-5 sm:p-6 space-y-3.5">
                                    <div>
                                        <div class="flex items-center gap-2 font-mono text-[11px] text-slate-500 mb-1">
                                            <span>{{ $publishedFormatted }}</span>
                                            <span>&bull;</span>
                                            <span class="text-slate-600">/notes/{{ $item->slug }}</span>
                                        </div>
                                        <h3 class="text-base sm:text-lg font-bold font-mono text-white leading-snug">
                                            {{ $item->title }}
                                        </h3>
                                    </div>

                                    <!-- Excerpt Content -->
                                    <p class="text-xs text-slate-400 leading-relaxed font-sans line-clamp-3">
                                        {{ $item->content }}
                                    </p>

                                    <!-- Keterhubungan ke Featured Project -->
                                    @if ($item->relatedProject)
                                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded bg-carbon-950 border border-carbon-800 text-[11px] font-mono text-slate-300">
                                            <span class="text-vermilion-400 font-bold">#0{{ $item->relatedProject->complexity_order }}</span>
                                            <span>Terhubung: {{ $item->relatedProject->title }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Footer Actions -->
                            <div class="px-5 py-3 bg-carbon-950/60 border-t border-carbon-800 flex items-center justify-between text-xs font-mono">
                                <div>
                                    @if ($item->status === 'published')
                                        <a href="{{ route('notes.show', $item->slug) }}" 
                                           target="_blank" 
                                           class="inline-flex items-center gap-1 text-[11px] text-vermilion-400 hover:text-vermilion-300 transition-colors">
                                            <span>Baca di Publik</span>
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>
                                    @else
                                        <span class="text-[11px] text-slate-500 italic">Draft Lokal</span>
                                    @endif
                                </div>

                                <div class="flex items-center gap-2">
                                    <a href="{{ route('learning-log.edit', $item) }}" 
                                       class="px-2.5 py-1 rounded-md bg-carbon-800 hover:bg-carbon-700 text-slate-200 hover:text-white transition-colors">
                                        Edit
                                    </a>

                                    <button type="button" 
                                            @click="openDeleteModal('{{ route('learning-log.destroy', $item) }}', '{{ addslashes($item->title) }}', '{{ addslashes($item->category) }}', '{{ $item->tag }}', '{{ $item->slug }}')"
                                            class="px-2.5 py-1 rounded-md bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 hover:text-rose-300 border border-rose-500/20 transition-colors cursor-pointer">
                                        Hapus
                                    </button>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="p-12 rounded-xl bg-carbon-900 border border-dashed border-carbon-800 text-center">
                    <div class="w-12 h-12 mx-auto rounded-full bg-carbon-800 flex items-center justify-center text-slate-400 mb-3">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold font-mono text-white mb-1">Tidak Ada Catatan Ditemukan</h3>
                    <p class="text-xs font-mono text-slate-400 max-w-sm mx-auto mb-4">
                        Tulis artikel baru mengenai arsitektur Laravel, caching Redis, atau container Docker untuk melengkapi portofolio.
                    </p>
                    <a href="{{ route('learning-log.create') }}" 
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-vermilion-500 hover:bg-vermilion-600 text-white font-mono text-xs font-semibold transition-colors">
                        <span>+ Tulis Catatan Baru</span>
                    </a>
                </div>
            @endif

        </div>

        <!-- ─── Modal Konfirmasi Hapus Catatan Teknis / Learning Log (Dark Architectural Carbon UI) ─── -->
        <div x-show="deleteModalOpen"
             style="display: none;"
             class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0 flex items-center justify-center"
             x-cloak>

            <!-- Backdrop Blur Overlay -->
            <div x-show="deleteModalOpen"
                 x-transition:enter="ease-out duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-150"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="closeDeleteModal()"
                 class="fixed inset-0 bg-carbon-950/80 backdrop-blur-md transition-opacity"></div>

            <!-- Modal Dialog Window -->
            <div x-show="deleteModalOpen"
                 x-transition:enter="ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-3 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-3 sm:translate-y-0 sm:scale-95"
                 class="relative w-full max-w-md bg-carbon-900 border border-carbon-800 rounded-xl overflow-hidden shadow-2xl z-10 text-slate-100">

                <!-- Window Terminal Header -->
                <div class="px-5 py-3.5 bg-carbon-950/90 border-b border-carbon-800 flex items-center justify-between select-none">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-rose-500/80 inline-block"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-400/80 inline-block"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400/80 inline-block"></span>
                        <span class="ml-2 font-mono text-[11px] font-semibold text-slate-400 uppercase tracking-wider">
                            KONFIRMASI_HAPUS_NOTE // DANGER_ZONE
                        </span>
                    </div>
                    <button type="button"
                            @click="closeDeleteModal()"
                            class="text-slate-500 hover:text-white transition-colors p-1 rounded hover:bg-carbon-800">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Window Content -->
                <div class="p-6 space-y-4">

                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-rose-500/10 border border-rose-500/20 flex items-center justify-center text-rose-400 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="space-y-1">
                            <h3 class="font-mono text-sm font-bold text-white">
                                Hapus Catatan Teknis Ini?
                            </h3>
                            <p class="text-xs text-slate-400 leading-relaxed font-mono">
                                Tindakan ini tidak dapat dibatalkan. Seluruh konten Markdown, riwayat waktu baca, dan rute publik catatan akan dihapus permanen.
                            </p>
                        </div>
                    </div>

                    <!-- Highlighted Target Item Box -->
                    <div class="p-3.5 rounded-lg bg-carbon-950 border border-carbon-800 space-y-2 font-mono text-xs">
                        <div class="flex items-center justify-between text-[10px] text-slate-500 uppercase tracking-wider">
                            <span x-text="noteCategory || 'TECHNICAL_NOTE'"></span>
                            <span class="px-1.5 py-0.5 rounded border text-[10px]"
                                  :class="{
                                      'text-emerald-400 bg-emerald-500/10 border-emerald-500/20': noteTag === 'Production-Ready',
                                      'text-amber-400 bg-amber-500/10 border-amber-500/20': noteTag === 'Exploring'
                                  }"
                                  x-text="noteTag"></span>
                        </div>
                        <div class="text-sm font-bold text-white" x-text="noteTitle"></div>
                        <div class="text-[11px] text-slate-500 flex items-center gap-1.5">
                            <span class="text-slate-600">URL:</span>
                            <span class="text-vermilion-400/90 font-mono" x-text="'/notes/' + noteSlug"></span>
                        </div>
                    </div>

                </div>

                <!-- Window Footer Actions -->
                <div class="px-6 py-4 bg-carbon-950/70 border-t border-carbon-800 flex items-center justify-end gap-3 font-mono text-xs">
                    <button type="button"
                            @click="closeDeleteModal()"
                            class="px-4 py-2 rounded-lg font-medium text-slate-300 hover:text-white bg-carbon-850 hover:bg-carbon-800 border border-carbon-750 transition-colors cursor-pointer">
                        Batal
                    </button>

                    <form :action="deleteAction" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg font-medium text-white bg-rose-600 hover:bg-rose-500 active:bg-rose-700 border border-rose-500/50 shadow-lg shadow-rose-950/50 transition-all cursor-pointer">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            <span>Konfirmasi Hapus</span>
                        </button>
                    </form>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>
