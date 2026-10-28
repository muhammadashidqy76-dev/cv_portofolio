<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 font-mono text-xs text-slate-400 mb-1">
                    <a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">Cms</a>
                    <span class="text-slate-600">/</span>
                    <span class="text-vermilion-400">Work-Experience</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold font-mono text-white tracking-tight">
                    Riwayat Pengalaman Kerja &amp; Magang
                </h1>
                <p class="text-xs font-mono text-slate-400 mt-0.5">
                    Kelola riwayat profesional, posisi backend, periode kerja, dan poin pencapaian nyata.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('work-experience.create') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-vermilion-500 hover:bg-vermilion-600 text-white font-mono text-xs font-semibold shadow-lg shadow-vermilion-500/20 transition-all hover:scale-[1.02] active:scale-[0.98]">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Tambah Pengalaman</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8"
         x-data="{
             deleteModalOpen: false,
             deleteAction: '',
             positionLabel: '',
             companyLabel: '',
             isCurrent: false,
             openDeleteModal(action, position, company, current) {
                 this.deleteAction = action;
                 this.positionLabel = position;
                 this.companyLabel = company;
                 this.isCurrent = current;
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
                
                <!-- 1. Total Pengalaman -->
                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 shadow-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] font-mono uppercase tracking-wider text-slate-500">Total Entri</span>
                        <span class="w-2 h-2 rounded-full bg-vermilion-400"></span>
                    </div>
                    <div class="text-2xl font-bold font-mono text-white">{{ $stats['total'] }}</div>
                    <span class="text-[11px] font-mono text-slate-400">Perusahaan / Institusi</span>
                </div>

                <!-- 2. Aktif Saat Ini (Current) -->
                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 shadow-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] font-mono uppercase tracking-wider text-slate-500">Aktif Sekarang</span>
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    </div>
                    <div class="text-2xl font-bold font-mono text-emerald-400">{{ $stats['current'] }}</div>
                    <span class="text-[11px] font-mono text-slate-400">Status "Present"</span>
                </div>

                <!-- 3. Published -->
                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 shadow-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] font-mono uppercase tracking-wider text-slate-500">Publik (Live)</span>
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    </div>
                    <div class="text-2xl font-bold font-mono text-emerald-400">{{ $stats['published'] }}</div>
                    <span class="text-[11px] font-mono text-slate-400">Tayang di portofolio</span>
                </div>

                <!-- 4. Draft -->
                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 shadow-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] font-mono uppercase tracking-wider text-slate-500">Draft</span>
                        <span class="w-2 h-2 rounded-full bg-slate-500"></span>
                    </div>
                    <div class="text-2xl font-bold font-mono text-slate-400">{{ $stats['draft'] }}</div>
                    <span class="text-[11px] font-mono text-slate-400">Belum dipublikasikan</span>
                </div>

            </div>

            <!-- ─── FILTER TABS & TOOLBAR ──────────────────────────────────────── -->
            <div class="flex flex-wrap items-center justify-between gap-3 p-3 rounded-xl bg-carbon-900 border border-carbon-800">
                <div class="flex items-center gap-1.5 flex-wrap">
                    <a href="{{ route('work-experience.index') }}" 
                       class="px-3 py-1.5 rounded-lg text-xs font-mono transition-colors {{ empty($selectedStatus) || $selectedStatus === 'all' ? 'bg-carbon-800 text-white font-semibold shadow-sm' : 'text-slate-400 hover:text-white hover:bg-carbon-850' }}">
                        Semua Status ({{ $stats['total'] }})
                    </a>
                    <a href="{{ route('work-experience.index', ['status' => 'published']) }}" 
                       class="px-3 py-1.5 rounded-lg text-xs font-mono transition-colors {{ $selectedStatus === 'published' ? 'bg-emerald-500/20 text-emerald-400 font-semibold border border-emerald-500/30' : 'text-slate-400 hover:text-white hover:bg-carbon-850' }}">
                        Published ({{ $stats['published'] }})
                    </a>
                    <a href="{{ route('work-experience.index', ['status' => 'draft']) }}" 
                       class="px-3 py-1.5 rounded-lg text-xs font-mono transition-colors {{ $selectedStatus === 'draft' ? 'bg-carbon-800 text-slate-200 font-semibold' : 'text-slate-400 hover:text-white hover:bg-carbon-850' }}">
                        Draft ({{ $stats['draft'] }})
                    </a>
                </div>

                <div class="text-[11px] font-mono text-slate-500">
                    Urutan: Kronologis Terkini &rarr; Lampau
                </div>
            </div>

            <!-- ─── WORK EXPERIENCE LIST ───────────────────────────────────────── -->
            @if ($experiences->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @foreach ($experiences as $item)
                        @php
                            $duration = $item->duration_label ?? '';
                            $typeBadge = $item->employment_type_badge_classes ?? 'text-sky-400 bg-sky-500/10 border-sky-500/20';
                            $typeLabel = $item->employment_type_label ?? 'Internship';
                        @endphp

                        <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-xl overflow-hidden flex flex-col justify-between hover:border-carbon-700/80 transition-all duration-200">
                            
                            <div>
                                <!-- Window Mockup Header -->
                                <div class="px-4 py-2.5 bg-carbon-950/80 border-b border-carbon-800 flex items-center justify-between gap-2 flex-wrap">
                                    <div class="flex items-center gap-2">
                                        <div class="flex items-center gap-1.5">
                                            <span class="w-2 h-2 rounded-full bg-rose-500/80"></span>
                                            <span class="w-2 h-2 rounded-full bg-amber-400/80"></span>
                                            <span class="w-2 h-2 rounded-full bg-emerald-400/80"></span>
                                        </div>
                                        <span class="font-mono text-[10px] font-semibold uppercase px-2 py-0.5 rounded border {{ $typeBadge }}">
                                            {{ $typeLabel }}
                                        </span>
                                        @if ($item->is_current)
                                            <span class="font-mono text-[10px] text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2 py-0.5 rounded flex items-center gap-1">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                                Active
                                            </span>
                                        @endif
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <span class="font-mono text-[10px] text-vermilion-400 bg-vermilion-500/10 border border-vermilion-500/20 px-2 py-0.5 rounded">
                                            {{ $duration }}
                                        </span>
                                        <span class="font-mono text-[10px] px-2 py-0.5 rounded border {{ $item->status === 'published' ? 'text-emerald-400 bg-emerald-500/10 border-emerald-500/20' : 'text-slate-400 bg-carbon-800 border-carbon-700' }}">
                                            {{ strtoupper($item->status) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="p-5 sm:p-6 space-y-4">
                                    <div>
                                        <h3 class="text-base sm:text-lg font-bold font-mono text-white leading-snug">
                                            {{ $item->position }}
                                        </h3>
                                        <div class="flex items-center gap-2 mt-1.5 text-xs text-slate-300 font-mono flex-wrap">
                                            <span class="text-slate-200 font-semibold">{{ $item->company_name }}</span>
                                            @if (!empty($item->location))
                                                <span class="text-slate-600">&bull;</span>
                                                <span class="inline-flex items-center gap-1 text-slate-400">
                                                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                    {{ $item->location }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Description / Poin Pencapaian -->
                                    @if (!empty($item->description))
                                        <div class="p-3.5 rounded-lg bg-carbon-950 border border-carbon-800/80 text-xs text-slate-300 leading-relaxed font-mono whitespace-pre-line">
                                            {{ Str::limit($item->description, 240) }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Footer Actions -->
                            <div class="px-5 py-3 bg-carbon-950/60 border-t border-carbon-800 flex items-center justify-between text-xs font-mono">
                                <span class="text-[10px] text-slate-500">Order: #{{ $item->display_order }}</span>

                                <div class="flex items-center gap-2">
                                    <a href="{{ route('work-experience.edit', $item) }}" 
                                       class="px-2.5 py-1 rounded-md bg-carbon-800 hover:bg-carbon-700 text-slate-200 hover:text-white transition-colors">
                                        Edit
                                    </a>

                                    <!-- Delete Button — triggers custom modal -->
                                    <button type="button"
                                            @click="openDeleteModal('{{ route('work-experience.destroy', $item) }}', '{{ addslashes($item->position) }}', '{{ addslashes($item->company_name) }}', {{ $item->is_current ? 'true' : 'false' }})"
                                            class="px-2.5 py-1 rounded-md bg-rose-500/10 hover:bg-rose-500/20 active:bg-rose-500/30 text-rose-400 hover:text-rose-300 border border-rose-500/20 transition-colors cursor-pointer">
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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold font-mono text-white mb-1">Belum Ada Riwayat Pengalaman</h3>
                    <p class="text-xs font-mono text-slate-400 max-w-sm mx-auto mb-4">
                        Tambahkan riwayat magang, freelance, atau pekerjaan backend Anda untuk melengkapi narasi profesional.
                    </p>
                    <a href="{{ route('work-experience.create') }}" 
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-vermilion-500 hover:bg-vermilion-600 text-white font-mono text-xs font-semibold transition-colors">
                        <span>+ Tambah Pengalaman Baru</span>
                    </a>
                </div>
            @endif

        </div>

        <!-- ─── Modal Konfirmasi Hapus Work Experience (Dark Architectural Carbon UI) ─── -->
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
                            KONFIRMASI_HAPUS_PENGALAMAN // DANGER_ZONE
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
                                Hapus Riwayat Pengalaman Ini?
                            </h3>
                            <p class="text-xs text-slate-400 leading-relaxed font-mono">
                                Tindakan ini tidak dapat dibatalkan. Entri pengalaman akan dihapus permanen dari portofolio.
                            </p>
                        </div>
                    </div>

                    <!-- Highlighted Target Item Box -->
                    <div class="p-3.5 rounded-lg bg-carbon-950 border border-carbon-800 space-y-1.5 font-mono text-xs">
                        <div class="flex items-center justify-between text-[10px] text-slate-500 uppercase tracking-wider">
                            <span>EXPERIENCE_TARGET</span>
                            <span x-show="isCurrent" class="inline-flex items-center gap-1 text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-1.5 py-0.5 rounded">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                <span>Active / Present</span>
                            </span>
                        </div>
                        <div class="text-sm font-bold text-white" x-text="positionLabel"></div>
                        <div class="text-[11px] text-slate-400" x-text="companyLabel"></div>
                        <div x-show="isCurrent" class="text-[11px] text-amber-400 mt-1">
                            ⚠ Ini adalah posisi aktif yang sedang berjalan (status Present).
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
