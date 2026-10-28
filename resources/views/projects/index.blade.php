<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 font-mono text-xs text-slate-400 mb-1">
                    <a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">Cms</a>
                    <span class="text-slate-600">/</span>
                    <span class="text-vermilion-400">Projects</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold font-mono text-white tracking-tight flex items-center gap-2">
                    <span>Featured Projects</span>
                    <span class="text-xs px-2 py-0.5 rounded font-normal font-mono bg-carbon-800 border border-carbon-700 text-slate-300">
                        Batch 2 &bull; Active
                    </span>
                </h1>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('projects.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-vermilion-500 hover:bg-vermilion-600 active:bg-vermilion-700 font-mono text-xs font-semibold text-white uppercase tracking-wider transition-all duration-150 shadow-lg shadow-vermilion-500/20 hover:shadow-vermilion-500/30">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Proyek Baru</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8"
         x-data="{
             deleteModalOpen: false,
             deleteAction: '',
             projectTitle: '',
             complexityOrder: '',
             openDeleteModal(action, title, order) {
                 this.deleteAction = action;
                 this.projectTitle = title;
                 this.complexityOrder = order;
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

            <!-- Informational Banner -->
            <div class="p-4 sm:p-5 rounded-xl bg-carbon-900 border border-carbon-800 flex flex-col md:flex-row md:items-center justify-between gap-4 text-xs font-mono shadow-xl">
                <div class="flex items-start md:items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-carbon-950 border border-carbon-800 flex items-center justify-center text-vermilion-400 shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-white font-semibold">Aturan Arsitektur &amp; Kompleksitas</div>
                        <p class="text-slate-400 mt-0.5">
                            Urutan Featured Projects disusun dari kompleksitas rendah ke tinggi: 
                            <span class="text-slate-200">#1 E-Commerce</span> &rarr; 
                            <span class="text-slate-200">#2 API/Headless Backend</span> &rarr; 
                            <span class="text-slate-200">#3 Modular CMS</span>.
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3 text-[11px] text-slate-400 shrink-0 border-t md:border-t-0 md:border-l border-carbon-800 pt-3 md:pt-0 md:pl-4">
                    <div>Total: <span class="text-white font-bold">{{ $projects->count() }}</span></div>
                    <div>Live: <span class="text-emerald-400 font-bold">{{ $projects->where('status', 'published')->count() }}</span></div>
                    <div>Draft: <span class="text-slate-500 font-bold">{{ $projects->where('status', 'draft')->count() }}</span></div>
                </div>
            </div>

            <!-- Project Cards List -->
            <div class="space-y-4">
                @forelse ($projects as $project)
                    <div class="rounded-xl bg-carbon-900 border border-carbon-800 hover:border-carbon-700/80 transition-all p-5 shadow-xl overflow-hidden">
                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-5">
                            
                            <!-- Left Section: Thumbnail & Core Details -->
                            <div class="flex items-start gap-4">
                                <!-- Thumbnail Preview -->
                                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-lg bg-carbon-950 border border-carbon-800 overflow-hidden shrink-0 relative flex items-center justify-center">
                                    @if ($project->preview_image_url)
                                        <img src="{{ $project->preview_image_url }}" 
                                             alt="{{ $project->title }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <!-- API / Mockup Icon placeholder -->
                                        <div class="flex flex-col items-center justify-center text-slate-500 font-mono text-[10px]">
                                            <svg class="w-6 h-6 text-vermilion-500/60 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                            </svg>
                                            <span>API / Code</span>
                                        </div>
                                    @endif

                                    <!-- Complexity Badge on top of thumbnail -->
                                    <span class="absolute top-1 left-1 px-1.5 py-0.5 rounded text-[9px] font-mono font-bold bg-carbon-950/90 border border-carbon-800 text-vermilion-400">
                                        #0{{ $project->complexity_order }}
                                    </span>
                                </div>

                                <!-- Text Details -->
                                <div class="space-y-1.5 min-w-0">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <h3 class="font-mono text-base font-bold text-white hover:text-vermilion-400 transition-colors">
                                            <a href="{{ route('projects.edit', $project) }}">
                                                {{ $project->title }}
                                            </a>
                                        </h3>

                                        <!-- Status Badge -->
                                        <span class="px-2 py-0.5 rounded text-[10px] font-mono font-medium {{ $project->status === 'published' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-slate-800 text-slate-400 border border-slate-700' }}">
                                            {{ ucfirst($project->status) }}
                                        </span>
                                    </div>

                                    <!-- Slug & Impact Metric -->
                                    <div class="flex items-center gap-2.5 text-xs font-mono text-slate-400 flex-wrap">
                                        <span class="text-slate-500">/{{ $project->slug }}</span>

                                        @if ($project->impact_metric)
                                            <span class="text-slate-700">&bull;</span>
                                            <span class="text-slate-300 truncate max-w-xs" title="{{ $project->impact_metric }}">{{ $project->impact_metric }}</span>
                                        @endif
                                    </div>

                                    <!-- Problem Statement Preview -->
                                    <p class="text-xs text-slate-400 line-clamp-2 max-w-3xl">
                                        {{ $project->problem_statement }}
                                    </p>

                                    <!-- Attached Tech Stack Items (Pivot) -->
                                    <div class="flex flex-wrap gap-1.5 pt-1">
                                        @forelse ($project->techStackItems as $tech)
                                            <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-carbon-950 border border-carbon-800 text-slate-300">
                                                {{ $tech->name }}
                                            </span>
                                        @empty
                                            <span class="text-[11px] font-mono text-slate-600 italic">Belum ada tech stack yang dihubungkan</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                            <!-- Right Section: Actions -->
                            <div class="flex items-center gap-2 self-end lg:self-center shrink-0 border-t lg:border-t-0 border-carbon-800/80 pt-3 lg:pt-0 w-full lg:w-auto justify-end">
                                @if ($project->demo_url)
                                    <!-- Live Demo Button -->
                                    <a href="{{ $project->demo_url }}" 
                                       target="_blank" 
                                       rel="noopener noreferrer"
                                       title="Buka Live Demo: {{ $project->demo_url }}"
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg font-mono text-xs font-medium text-cyan-300 hover:text-cyan-200 bg-cyan-500/10 hover:bg-cyan-500/20 active:bg-cyan-500/30 border border-cyan-500/30 hover:border-cyan-400/60 shadow-sm hover:shadow-cyan-500/10 transition-all duration-150 group">
                                        <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 group-hover:bg-cyan-300 group-hover:scale-125 transition-transform animate-pulse"></span>
                                        <span>Live Demo</span>
                                        <svg class="w-3.5 h-3.5 text-cyan-400 group-hover:text-cyan-200 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                @endif

                                <!-- Edit Button -->
                                <a href="{{ route('projects.edit', $project) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg font-mono text-xs font-medium text-slate-200 bg-carbon-800 hover:bg-carbon-750 border border-carbon-700 hover:border-slate-600 transition-colors">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span>Edit</span>
                                </a>

                                <!-- Delete Button triggering custom UI popup modal -->
                                <button type="button" 
                                        @click="openDeleteModal('{{ route('projects.destroy', $project) }}', '{{ addslashes($project->title) }}', '{{ $project->complexity_order }}')"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg font-mono text-xs font-medium text-rose-400 hover:text-rose-300 bg-rose-500/10 hover:bg-rose-500/20 active:bg-rose-500/30 border border-rose-500/20 hover:border-rose-500/40 transition-colors cursor-pointer">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    <span>Hapus</span>
                                </button>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="rounded-xl bg-carbon-900 border border-carbon-800 p-12 text-center shadow-xl">
                        <div class="w-12 h-12 rounded-xl bg-carbon-950 border border-carbon-800 flex items-center justify-center text-slate-500 mx-auto mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <h3 class="font-mono text-sm font-bold text-white mb-1">Belum Ada Featured Projects</h3>
                        <p class="text-xs text-slate-400 max-w-sm mx-auto mb-4 font-mono">
                            Mulai tambahkan 3 proyek utama backend Anda untuk ditampilkan di beranda portofolio.
                        </p>
                        <a href="{{ route('projects.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-vermilion-500 hover:bg-vermilion-600 font-mono text-xs font-semibold text-white uppercase tracking-wider">
                            <span>+ Tambah Proyek Pertama</span>
                        </a>
                    </div>
                @endforelse
            </div>

        </div>

        <!-- ─── Modal Konfirmasi Hapus Proyek (Dark Architectural Carbon UI) ─── -->
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
                 class="relative w-full max-w-lg bg-carbon-900 border border-carbon-800 rounded-xl overflow-hidden shadow-2xl z-10 text-slate-100">

                <!-- Window Terminal Header -->
                <div class="px-5 py-3.5 bg-carbon-950/90 border-b border-carbon-800 flex items-center justify-between select-none">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-rose-500/80 inline-block"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-400/80 inline-block"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400/80 inline-block"></span>
                        <span class="ml-2 font-mono text-[11px] font-semibold text-slate-400 uppercase tracking-wider">
                            KONFIRMASI_HAPUS_PROYEK // DANGER_ZONE
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
                                Hapus Featured Project Ini?
                            </h3>
                            <p class="text-xs text-slate-400 leading-relaxed font-mono">
                                Apakah Anda yakin ingin menghapus proyek ini dari portofolio? Tindakan ini tidak dapat dibatalkan.
                            </p>
                        </div>
                    </div>

                    <!-- Highlighted Target Item Box -->
                    <div class="p-3.5 rounded-lg bg-carbon-950 border border-carbon-800 space-y-1.5 font-mono text-xs">
                        <div class="flex items-center justify-between text-[10px] text-slate-500 uppercase tracking-wider">
                            <span>PROYEK_TARGET</span>
                            <span class="text-vermilion-400" x-text="'ORDER #' + complexityOrder"></span>
                        </div>
                        <div class="text-sm font-bold text-white truncate" x-text="projectTitle"></div>
                        <div class="text-[11px] text-slate-400">
                            Relasi pivot ke Tech Stack Items dan referensi timeline Journey yang terhubung akan otomatis dilepaskan.
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
                            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
