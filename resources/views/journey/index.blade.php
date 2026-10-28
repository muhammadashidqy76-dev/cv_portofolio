<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 font-mono text-xs text-slate-400 mb-1">
                    <a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">Cms</a>
                    <span class="text-slate-600">/</span>
                    <span class="text-vermilion-400">Journey</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold font-mono text-white tracking-tight">
                    Timeline Journey &amp; Kredensial
                </h1>
                <p class="text-xs font-mono text-slate-400 mt-0.5">
                    Kelola riwayat self-directed learning, narasi 3-langkah (Learned &rarr; Applied &rarr; Result), sertifikasi, dan ijazah.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('journey.create') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-vermilion-500 hover:bg-vermilion-600 text-white font-mono text-xs font-semibold shadow-lg shadow-vermilion-500/20 transition-all hover:scale-[1.02] active:scale-[0.98]">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Tambah Entri Baru</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8"
         x-data="{
             deleteModalOpen: false,
             deleteAction: '',
             courseName: '',
             credentialType: '',
             openDeleteModal(action, name, type) {
                 this.deleteAction = action;
                 this.courseName = name;
                 this.credentialType = type;
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
                
                <!-- 1. Total Entri -->
                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 shadow-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] font-mono uppercase tracking-wider text-slate-500">Total Kredensial</span>
                        <span class="w-2 h-2 rounded-full bg-vermilion-400"></span>
                    </div>
                    <div class="text-2xl font-bold font-mono text-white">{{ $stats['total'] }}</div>
                    <span class="text-[11px] font-mono text-slate-400">Entri Pembelajaran</span>
                </div>

                <!-- 2. Kursus / Belajar Mandiri -->
                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 shadow-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] font-mono uppercase tracking-wider text-slate-500">Kursus (Courses)</span>
                        <span class="w-2 h-2 rounded-full bg-sky-400"></span>
                    </div>
                    <div class="text-2xl font-bold font-mono text-sky-400">{{ $stats['courses'] }}</div>
                    <span class="text-[11px] font-mono text-slate-400">Narasi 3-Langkah</span>
                </div>

                <!-- 3. Sertifikasi & Ijazah -->
                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 shadow-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] font-mono uppercase tracking-wider text-slate-500">Sertifikasi &amp; Ijazah</span>
                        <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                    </div>
                    <div class="text-2xl font-bold font-mono text-amber-400">{{ $stats['certifications'] + $stats['diplomas'] }}</div>
                    <span class="text-[11px] font-mono text-slate-400">{{ $stats['certifications'] }} Sertifikat &bull; {{ $stats['diplomas'] }} Ijazah</span>
                </div>

                <!-- 4. Status Publikasi -->
                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 shadow-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] font-mono uppercase tracking-wider text-slate-500">Status Live</span>
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    </div>
                    <div class="text-2xl font-bold font-mono text-emerald-400">{{ $stats['published'] }}</div>
                    <span class="text-[11px] font-mono text-slate-400">{{ $stats['draft'] }} dalam status Draft</span>
                </div>

            </div>

            <!-- ─── FILTER TABS & TOOLBAR ──────────────────────────────────────── -->
            <div class="flex flex-wrap items-center justify-between gap-3 p-3 rounded-xl bg-carbon-900 border border-carbon-800">
                <div class="flex items-center gap-1.5 flex-wrap">
                    <a href="{{ route('journey.index') }}" 
                       class="px-3 py-1.5 rounded-lg text-xs font-mono transition-colors {{ empty($selectedType) || $selectedType === 'all' ? 'bg-carbon-800 text-white font-semibold shadow-sm' : 'text-slate-400 hover:text-white hover:bg-carbon-850' }}">
                        Semua Tipe ({{ $stats['total'] }})
                    </a>
                    <a href="{{ route('journey.index', ['type' => 'course']) }}" 
                       class="px-3 py-1.5 rounded-lg text-xs font-mono transition-colors {{ $selectedType === 'course' ? 'bg-sky-500/20 text-sky-400 font-semibold border border-sky-500/30' : 'text-slate-400 hover:text-white hover:bg-carbon-850' }}">
                        Courses ({{ $stats['courses'] }})
                    </a>
                    <a href="{{ route('journey.index', ['type' => 'certification']) }}" 
                       class="px-3 py-1.5 rounded-lg text-xs font-mono transition-colors {{ $selectedType === 'certification' ? 'bg-amber-500/20 text-amber-400 font-semibold border border-amber-500/30' : 'text-slate-400 hover:text-white hover:bg-carbon-850' }}">
                        Certifications ({{ $stats['certifications'] }})
                    </a>
                    <a href="{{ route('journey.index', ['type' => 'diploma']) }}" 
                       class="px-3 py-1.5 rounded-lg text-xs font-mono transition-colors {{ $selectedType === 'diploma' ? 'bg-emerald-500/20 text-emerald-400 font-semibold border border-emerald-500/30' : 'text-slate-400 hover:text-white hover:bg-carbon-850' }}">
                        Diploma ({{ $stats['diplomas'] }})
                    </a>
                </div>

                <div class="flex items-center gap-2">
                    <span class="text-[11px] font-mono text-slate-500">Status:</span>
                    <a href="{{ route('journey.index', array_merge(request()->query(), ['status' => 'published'])) }}" 
                       class="px-2.5 py-1 rounded text-[11px] font-mono transition-colors {{ $selectedStatus === 'published' ? 'bg-emerald-500/20 text-emerald-400 font-semibold' : 'text-slate-400 hover:text-white' }}">
                        Published ({{ $stats['published'] }})
                    </a>
                    <span class="text-slate-600 font-mono text-xs">&bull;</span>
                    <a href="{{ route('journey.index', array_merge(request()->query(), ['status' => 'draft'])) }}" 
                       class="px-2.5 py-1 rounded text-[11px] font-mono transition-colors {{ $selectedStatus === 'draft' ? 'bg-carbon-800 text-slate-200 font-semibold' : 'text-slate-400 hover:text-white' }}">
                        Draft ({{ $stats['draft'] }})
                    </a>
                </div>
            </div>

            <!-- ─── JOURNEY LIST (3-COLUMN RESPONSIVE GRID) ────────────────────── -->
            @if ($entries->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 items-stretch">
                    @foreach ($entries as $item)
                        @php
                            $completedFormatted = $item->completed_at ? $item->completed_at->format('M Y') : null;
                            $typeBadgeClass = match($item->credential_type) {
                                'certification' => 'text-amber-400 bg-amber-500/10 border-amber-500/20',
                                'diploma'       => 'text-emerald-400 bg-emerald-500/10 border-emerald-500/20',
                                default         => 'text-sky-400 bg-sky-500/10 border-sky-500/20',
                            };
                            $typeLabel = match($item->credential_type) {
                                'certification' => 'Sertifikasi',
                                'diploma'       => 'Ijazah / Gelar',
                                default         => 'Course',
                            };
                        @endphp

                        <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-xl overflow-hidden flex flex-col justify-between hover:border-carbon-700/80 transition-all duration-200">
                            
                            <div>
                                <!-- Window Mockup Header Bar -->
                                <div class="px-4 py-2.5 bg-carbon-950/80 border-b border-carbon-800 flex items-center justify-between gap-2 select-none">
                                    <div class="flex items-center gap-2">
                                        <div class="flex items-center gap-1.5">
                                            <span class="w-2 h-2 rounded-full bg-rose-500/80"></span>
                                            <span class="w-2 h-2 rounded-full bg-amber-400/80"></span>
                                            <span class="w-2 h-2 rounded-full bg-emerald-400/80"></span>
                                        </div>
                                        <span class="font-mono text-[10px] font-semibold uppercase px-2 py-0.5 rounded border {{ $typeBadgeClass }}">
                                            {{ $typeLabel }}
                                        </span>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        @if ($completedFormatted)
                                            <span class="font-mono text-[10px] text-vermilion-400 bg-vermilion-500/10 border border-vermilion-500/20 px-2 py-0.5 rounded">
                                                {{ $completedFormatted }}
                                            </span>
                                        @endif
                                        <span class="font-mono text-[10px] px-1.5 py-0.5 rounded border {{ $item->status === 'published' ? 'text-emerald-400 bg-emerald-500/10 border-emerald-500/20' : 'text-slate-400 bg-carbon-800 border-carbon-700' }}">
                                            {{ strtoupper($item->status) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Card Body -->
                                <div class="p-5 space-y-4">
                                    
                                    <!-- Title & Platform -->
                                    <div>
                                        <h3 class="text-sm sm:text-base font-bold font-mono text-white leading-snug">
                                            {{ $item->course_name }}
                                        </h3>
                                        <div class="flex items-center gap-2 mt-2 p-2 rounded-lg bg-carbon-950 border border-carbon-800 text-xs font-mono">
                                            <div class="w-6 h-6 shrink-0 rounded bg-carbon-900 border border-carbon-800 flex items-center justify-center overflow-hidden">
                                                <img src="{{ $item->issuer_logo }}" 
                                                     alt="{{ $item->source ?? 'Issuer' }}" 
                                                     class="w-full h-full object-contain p-0.5" 
                                                     onerror="this.style.display='none'" />
                                            </div>
                                            <span class="text-slate-300 font-semibold truncate">{{ $item->source ?: 'Belajar Mandiri' }}</span>
                                        </div>
                                    </div>

                                    <!-- 3-Step Narrative (Learned -> Applied -> Result) -->
                                    @if ($item->has_narrative)
                                        <div class="space-y-2 p-3 rounded-lg bg-carbon-950 border border-carbon-800/80 text-[11px] font-mono">
                                            <div class="flex items-center gap-1.5 text-vermilion-400 font-semibold mb-1">
                                                <span class="w-1.5 h-1.5 rounded-full bg-vermilion-400"></span>
                                                <span>NARASI 3-LANGKAH</span>
                                            </div>

                                            <div>
                                                <span class="text-slate-500 block uppercase text-[9px] tracking-wider font-semibold">1. Learned</span>
                                                <p class="text-slate-300 leading-relaxed">{{ $item->learned }}</p>
                                            </div>

                                            @if ($item->appliedProject)
                                                <div class="pt-1">
                                                    <span class="text-slate-500 block uppercase text-[9px] tracking-wider font-semibold">2. Applied (Featured Project)</span>
                                                    <a href="{{ route('projects.edit', $item->appliedProject) }}" class="inline-flex items-center gap-1 text-emerald-400 hover:text-emerald-300 font-medium transition-colors">
                                                        <span>&bull; {{ $item->appliedProject->title }} &rarr;</span>
                                                    </a>
                                                </div>
                                            @endif

                                            <div class="pt-1">
                                                <span class="text-slate-500 block uppercase text-[9px] tracking-wider font-semibold">3. Result / Impact</span>
                                                <p class="text-slate-300 leading-relaxed">{{ $item->result }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Links Dokumen & Verifikasi -->
                                    @if (!empty($item->certificate_file_path) || !empty($item->verification_url))
                                        <div class="flex items-center gap-2 pt-1 flex-wrap">
                                            @if (!empty($item->certificate_file_path))
                                                <a href="{{ $item->certificate_url }}" 
                                                   target="_blank" 
                                                   class="inline-flex items-center gap-1 px-2.5 py-1 rounded bg-carbon-950 hover:bg-carbon-850 text-slate-300 hover:text-white border border-carbon-800 text-[11px] font-mono transition-colors">
                                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                                    </svg>
                                                    <span>Lihat Dokumen ↗</span>
                                                </a>
                                            @endif

                                            @if (!empty($item->verification_url))
                                                <a href="{{ $item->verification_url }}" 
                                                   target="_blank" 
                                                   class="inline-flex items-center gap-1 px-2.5 py-1 rounded bg-vermilion-500/10 hover:bg-vermilion-500/20 text-vermilion-400 border border-vermilion-500/20 text-[11px] font-mono transition-colors">
                                                    <span>Verifikasi ↗</span>
                                                </a>
                                            @endif
                                        </div>
                                    @endif

                                </div>
                            </div>

                            <!-- Footer Actions -->
                            <div class="px-5 py-3 bg-carbon-950/60 border-t border-carbon-800 flex items-center justify-between text-xs font-mono">
                                <span class="text-[10px] text-slate-500">Order: #{{ $item->display_order }}</span>

                                <div class="flex items-center gap-2">
                                    <a href="{{ route('journey.edit', $item) }}" 
                                       class="px-2.5 py-1 rounded-md bg-carbon-800 hover:bg-carbon-700 text-slate-200 hover:text-white transition-colors">
                                        Edit
                                    </a>

                                    <!-- Delete Button — triggers custom modal -->
                                    <button type="button"
                                            @click="openDeleteModal('{{ route('journey.destroy', $item) }}', '{{ addslashes($item->course_name) }}', '{{ $item->credential_type }}')"
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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold font-mono text-white mb-1">Belum Ada Entri Pembelajaran</h3>
                    <p class="text-xs font-mono text-slate-400 max-w-sm mx-auto mb-4">
                        Tambahkan kursus mandiri, sertifikasi BNSP/AWS, atau ijazah untuk membuktikan komitmen belajar Anda.
                    </p>
                    <a href="{{ route('journey.create') }}" 
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-vermilion-500 hover:bg-vermilion-600 text-white font-mono text-xs font-semibold transition-colors">
                        <span>+ Tambah Entri Pembelajaran</span>
                    </a>
                </div>
            @endif

        </div>

        <!-- ─── Modal Konfirmasi Hapus Journey Entry (Dark Architectural Carbon UI) ─── -->
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
                            KONFIRMASI_HAPUS_JOURNEY // DANGER_ZONE
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
                                Hapus Entri Journey Ini?
                            </h3>
                            <p class="text-xs text-slate-400 leading-relaxed font-mono">
                                Tindakan ini tidak dapat dibatalkan. Entri pembelajaran beserta narasi 3-langkah akan dihapus permanen.
                            </p>
                        </div>
                    </div>

                    <!-- Highlighted Target Item Box -->
                    <div class="p-3.5 rounded-lg bg-carbon-950 border border-carbon-800 space-y-1.5 font-mono text-xs">
                        <div class="flex items-center justify-between text-[10px] text-slate-500 uppercase tracking-wider">
                            <span>JOURNEY_TARGET</span>
                            <span class="px-1.5 py-0.5 rounded border text-[10px]"
                                  :class="{
                                      'text-amber-400 bg-amber-500/10 border-amber-500/20': credentialType === 'certification',
                                      'text-emerald-400 bg-emerald-500/10 border-emerald-500/20': credentialType === 'diploma',
                                      'text-sky-400 bg-sky-500/10 border-sky-500/20': credentialType === 'course'
                                  }"
                                  x-text="credentialType === 'certification' ? 'Sertifikasi' : (credentialType === 'diploma' ? 'Ijazah / Gelar' : 'Course')"></span>
                        </div>
                        <div class="text-sm font-bold text-white" x-text="courseName"></div>
                        <div class="text-[11px] text-slate-500">
                            Narasi Learned → Applied → Result akan turut dihapus.
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
