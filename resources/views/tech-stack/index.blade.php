<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 font-mono text-xs text-slate-400 mb-1">
                    <a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">Cms</a>
                    <span class="text-slate-600">/</span>
                    <span class="text-vermilion-400">Tech-Stack</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold font-mono text-white tracking-tight flex items-center gap-2">
                    <span>Tech Stack Items</span>
                    <span class="text-xs px-2 py-0.5 rounded font-normal font-mono bg-carbon-800 border border-carbon-700 text-slate-300">
                        Batch 3 &bull; Active
                    </span>
                </h1>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('tech-stack.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-vermilion-500 hover:bg-vermilion-600 active:bg-vermilion-700 font-mono text-xs font-semibold text-white uppercase tracking-wider transition-all duration-150 shadow-lg shadow-vermilion-500/20 hover:shadow-vermilion-500/30">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Teknologi Baru</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8"
         x-data="{
             deleteModalOpen: false,
             deleteAction: '',
             techName: '',
             techCategory: '',
             projectsCount: 0,
             openDeleteModal(action, name, category, count) {
                 this.deleteAction = action;
                 this.techName = name;
                 this.techCategory = category;
                 this.projectsCount = count;
                 this.deleteModalOpen = true;
             },
             closeDeleteModal() {
                 this.deleteModalOpen = false;
             }
         }"
         @keydown.escape.window="closeDeleteModal()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Flash Session Status -->
            @if (session('status'))
                <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-mono text-xs flex items-center justify-between shadow-lg">
                    <div class="flex items-center gap-2.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>{{ session('status') }}</span>
                    </div>
                    <span class="text-[11px] text-emerald-500/80">CMS_SYNCED</span>
                </div>
            @endif

            <!-- ─── Stat Counter Bar ─────────────────────────────────────────────── -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                
                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-mono text-slate-400 uppercase">Total Teknologi</div>
                        <div class="text-2xl font-bold font-mono text-white mt-1">{{ $stats['total'] }}</div>
                    </div>
                    <div class="w-9 h-9 rounded-lg bg-carbon-950 border border-carbon-800 flex items-center justify-center text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-mono text-emerald-400 uppercase">Finished / Dikuasai</div>
                        <div class="text-2xl font-bold font-mono text-emerald-400 mt-1">{{ $stats['finished'] }}</div>
                    </div>
                    <div class="w-9 h-9 rounded-lg bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-mono text-amber-400 uppercase">In Progress / Belajar</div>
                        <div class="text-2xl font-bold font-mono text-amber-400 mt-1">{{ $stats['in_progress'] }}</div>
                    </div>
                    <div class="w-9 h-9 rounded-lg bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-mono text-rose-400 uppercase">Not Started / Rencana</div>
                        <div class="text-2xl font-bold font-mono text-rose-400 mt-1">{{ $stats['not_started'] }}</div>
                    </div>
                    <div class="w-9 h-9 rounded-lg bg-rose-500/10 border border-rose-500/20 flex items-center justify-center text-rose-400">
                        <span class="w-2.5 h-2.5 rounded-full bg-rose-400"></span>
                    </div>
                </div>

            </div>

            <!-- ─── Category Filter Tabs ─────────────────────────────────────────── -->
            <div class="flex items-center gap-2 overflow-x-auto pb-1 font-mono text-xs">
                <a href="{{ route('tech-stack.index') }}" 
                   class="px-3.5 py-1.5 rounded-lg border transition-colors shrink-0 {{ empty($selectedCategory) || $selectedCategory === 'all' ? 'bg-vermilion-500/10 border-vermilion-500/30 text-vermilion-400 font-bold' : 'bg-carbon-900 border-carbon-800 text-slate-400 hover:text-white' }}">
                    Semua Kategori ({{ $stats['total'] }})
                </a>

                @foreach ($categories as $cat)
                    <a href="{{ route('tech-stack.index', ['category' => $cat]) }}" 
                       class="px-3.5 py-1.5 rounded-lg border transition-colors shrink-0 {{ $selectedCategory === $cat ? 'bg-vermilion-500/10 border-vermilion-500/30 text-vermilion-400 font-bold' : 'bg-carbon-900 border-carbon-800 text-slate-400 hover:text-white' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>

            <!-- ─── Grouped Tech Stack Cards ─────────────────────────────────────── -->
            <div class="space-y-6">
                @forelse ($itemsGrouped as $category => $items)
                    <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-xl overflow-hidden">
                        
                        <!-- Category Header -->
                        <div class="px-5 py-3.5 bg-carbon-950/80 border-b border-carbon-800 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="w-2 h-2 rounded-full bg-vermilion-400"></span>
                                <h3 class="font-mono text-xs font-bold text-white uppercase tracking-wider">
                                    {{ $category }}
                                </h3>
                                <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-carbon-900 border border-carbon-800 text-slate-400">
                                    {{ $items->count() }} Items
                                </span>
                            </div>

                            <a href="{{ route('tech-stack.create', ['category' => $category]) }}" class="text-[11px] font-mono text-vermilion-400 hover:text-vermilion-300 transition-colors">
                                + Tambah ke {{ $category }}
                            </a>
                        </div>

                        <!-- Grid Items -->
                        <div class="p-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3.5">
                            @foreach ($items as $item)
                                @php
                                    $badge = $item->status_badge_classes;
                                @endphp
                                <div class="rounded-lg bg-carbon-950 border border-carbon-800 hover:border-carbon-700/80 p-3.5 transition-all flex flex-col justify-between group">
                                    
                                    <div>
                                        <div class="flex items-start justify-between gap-2 mb-2">
                                            <span class="font-mono text-sm font-bold text-white group-hover:text-vermilion-400 transition-colors">
                                                {{ $item->name }}
                                            </span>

                                            <span class="text-[10px] font-mono text-slate-600">
                                                #{{ $item->display_order }}
                                            </span>
                                        </div>

                                        <!-- Status Badge -->
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-[10px] font-mono font-medium {{ $badge['text'] }} {{ $badge['bg'] }} border {{ $badge['border'] }}">
                                                <span class="w-1.5 h-1.5 rounded-full {{ $badge['text'] === 'text-emerald-400' ? 'bg-emerald-400' : ($badge['text'] === 'text-amber-400' ? 'bg-amber-400' : 'bg-rose-400') }}"></span>
                                                <span>{{ ucfirst(str_replace('_', ' ', $item->status)) }}</span>
                                            </span>
                                        </div>

                                        <!-- Project Usage Indicator -->
                                        <div class="text-[11px] font-mono text-slate-500">
                                            @if ($item->projects_count > 0)
                                                <span class="text-slate-400">Digunakan di <strong class="text-slate-200">{{ $item->projects_count }}</strong> Proyek</span>
                                            @else
                                                <span class="text-slate-600">Belum terhubung ke proyek</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex items-center justify-end gap-2 pt-3 mt-3 border-t border-carbon-800/80">
                                        <a href="{{ route('tech-stack.edit', $item) }}" class="inline-flex items-center gap-1 text-[11px] font-mono text-slate-400 hover:text-white transition-colors">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            <span>Edit</span>
                                        </a>

                                        <!-- Delete Button — triggers custom modal -->                                        
                                        <button type="button"
                                                @click="openDeleteModal('{{ route('tech-stack.destroy', $item) }}', '{{ addslashes($item->name) }}', '{{ addslashes($item->category) }}', {{ $item->projects_count }})"
                                                class="inline-flex items-center gap-1 text-[11px] font-mono text-rose-400 hover:text-rose-300 active:text-rose-200 transition-colors cursor-pointer ml-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            <span>Hapus</span>
                                        </button>
                                    </div>

                                </div>
                            @endforeach
                        </div>

                    </div>
                @empty
                    <div class="rounded-xl bg-carbon-900 border border-carbon-800 p-12 text-center shadow-xl">
                        <div class="w-12 h-12 rounded-xl bg-carbon-950 border border-carbon-800 flex items-center justify-center text-slate-500 mx-auto mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <h3 class="font-mono text-sm font-bold text-white mb-1">Belum Ada Item Teknologi</h3>
                        <p class="text-xs text-slate-400 max-w-sm mx-auto mb-4 font-mono">
                            Tambahkan komponen stack Anda (Backend, Database, Tools, Frontend) untuk dihubungkan ke Featured Projects.
                        </p>
                        <a href="{{ route('tech-stack.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-vermilion-500 hover:bg-vermilion-600 font-mono text-xs font-semibold text-white uppercase tracking-wider">
                            <span>+ Tambah Teknologi Pertama</span>
                        </a>
                    </div>
                @endforelse
            </div>

        </div>

        <!-- ─── Modal Konfirmasi Hapus Tech Stack (Dark Architectural Carbon UI) ─── -->
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
                            KONFIRMASI_HAPUS_TEKNOLOGI // DANGER_ZONE
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
                                Hapus Item Teknologi Ini?
                            </h3>
                            <p class="text-xs text-slate-400 leading-relaxed font-mono">
                                Tindakan ini tidak dapat dibatalkan. Item teknologi akan dihapus permanen dari sistem.
                            </p>
                        </div>
                    </div>

                    <!-- Highlighted Target Item Box -->
                    <div class="p-3.5 rounded-lg bg-carbon-950 border border-carbon-800 space-y-1.5 font-mono text-xs">
                        <div class="flex items-center justify-between text-[10px] text-slate-500 uppercase tracking-wider">
                            <span>TECH_TARGET</span>
                            <span class="text-slate-400" x-text="techCategory"></span>
                        </div>
                        <div class="text-sm font-bold text-white" x-text="techName"></div>
                        <div class="text-[11px] space-y-0.5">
                            <div x-show="projectsCount > 0" class="text-amber-400">
                                ⚠ Digunakan di <span class="font-bold" x-text="projectsCount"></span> proyek — relasi pivot akan otomatis dilepas.
                            </div>
                            <div x-show="projectsCount === 0" class="text-slate-500">
                                Belum terhubung ke proyek manapun.
                            </div>
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
