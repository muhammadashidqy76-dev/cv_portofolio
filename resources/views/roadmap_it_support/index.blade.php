<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 font-mono text-xs text-slate-400 mb-1">
                    <a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">CMS</a>
                    <span class="text-slate-600">/</span>
                    <span class="text-indigo-400">Roadmap IT Support</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold font-mono text-white tracking-tight flex items-center gap-2">
                    <span>Manajemen Roadmap IT Support</span>
                    <span class="text-xs px-2 py-0.5 rounded font-normal font-mono bg-indigo-500/10 border border-indigo-500/30 text-indigo-400">
                        {{ $stats['percentage'] }}% Mastered
                    </span>
                </h1>
            </div>

            <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
                <a href="{{ route('roadmap.index', ['roleSlug' => 'it-support']) }}" target="_blank"
                   class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg bg-carbon-900 border border-carbon-800 hover:border-slate-700 text-slate-300 hover:text-white font-mono text-xs transition-colors">
                    <svg class="w-3.5 h-3.5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    <span>Lihat Halaman Publik (Recruiter)</span>
                </a>

                <a href="{{ route('roadmap-it-support.create') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-500 font-mono text-xs font-semibold text-white uppercase tracking-wider transition-all duration-150 shadow-lg shadow-indigo-600/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Tambah Topik Baru</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8"
         x-data="{
             deleteModalOpen: false,
             deleteAction: '',
             checkpointTitle: '',
             openDeleteModal(action, title) {
                 this.deleteAction = action;
                 this.checkpointTitle = title;
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
                <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-mono text-xs flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>{{ session('status') }}</span>
                    </div>
                    <span class="text-[10px] text-emerald-500/70">Tersimpan ke Database</span>
                </div>
            @endif

            <!-- ─── 4 Metric Cards Summary ─────────────────────────────────────────── -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-mono text-slate-400 uppercase tracking-wider">Total Checkpoint</div>
                        <div class="text-2xl font-bold font-mono text-white mt-1">{{ $stats['total'] }}</div>
                    </div>
                    <div class="w-9 h-9 rounded-lg bg-carbon-950 border border-carbon-800 flex items-center justify-center text-slate-400">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-mono text-emerald-400 uppercase tracking-wider">Clear (Finished)</div>
                        <div class="text-2xl font-bold font-mono text-emerald-400 mt-1">{{ $stats['finished'] }}</div>
                    </div>
                    <div class="w-9 h-9 rounded-lg bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-mono text-amber-400 uppercase tracking-wider">In Progress</div>
                        <div class="text-2xl font-bold font-mono text-amber-400 mt-1">{{ $stats['in_progress'] }}</div>
                    </div>
                    <div class="w-9 h-9 rounded-lg bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800 flex items-center justify-between">
                    <div>
                        <div class="text-[11px] font-mono text-slate-400 uppercase tracking-wider">Planned</div>
                        <div class="text-2xl font-bold font-mono text-slate-400 mt-1">{{ $stats['not_started'] }}</div>
                    </div>
                    <div class="w-9 h-9 rounded-lg bg-carbon-950 border border-carbon-800 flex items-center justify-center text-slate-500">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- ─── Checkpoints Table Per Phase ───────────────────────────────────── -->
            <div class="space-y-6">
                @forelse ($phases as $phaseName => $items)
                    <div class="rounded-xl bg-carbon-900 border border-carbon-800 overflow-hidden shadow-lg">
                        <!-- Phase Header -->
                        <div class="px-6 py-3.5 bg-carbon-950 border-b border-carbon-800 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                                <h3 class="text-sm font-mono font-bold text-white uppercase tracking-tight">
                                    {{ $phaseName }}
                                </h3>
                            </div>
                            <span class="text-xs font-mono text-slate-400">
                                {{ count($items) }} Topik
                            </span>
                        </div>

                        <!-- Checkpoint List Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs font-mono">
                                <thead>
                                    <tr class="border-b border-carbon-800/80 bg-carbon-900/50 text-slate-400 uppercase text-[11px]">
                                        <th class="py-3 px-6 w-12">#</th>
                                        <th class="py-3 px-4">Judul Topik / Materi</th>
                                        <th class="py-3 px-4">Referensi / Sumber</th>
                                        <th class="py-3 px-4">Integrasi (Note / Proyek)</th>
                                        <th class="py-3 px-4">Status Penguasaan</th>
                                        <th class="py-3 px-6 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-carbon-800/60">
                                    @foreach ($items as $cp)
                                        @php $badge = $cp->status_badge_classes; @endphp
                                        <tr class="hover:bg-carbon-850/50 transition-colors">
                                            <td class="py-3.5 px-6 text-slate-500">
                                                {{ $cp->display_order }}
                                            </td>

                                            <!-- Title & Desc Excerpt -->
                                            <td class="py-3.5 px-4 max-w-xs">
                                                <div class="font-semibold text-white text-sm">
                                                    {{ $cp->title }}
                                                </div>
                                                <p class="text-slate-400 text-xs line-clamp-1 mt-0.5">
                                                    {{ $cp->description }}
                                                </p>
                                            </td>

                                            <!-- Reference / External URL -->
                                            <td class="py-3.5 px-4 text-slate-400">
                                                @if ($cp->external_url)
                                                    <a href="{{ $cp->external_url }}" target="_blank" rel="noopener noreferrer"
                                                       class="inline-flex items-center gap-1 text-indigo-400 hover:text-indigo-300 hover:underline">
                                                        <span class="truncate max-w-[150px]">{{ $cp->external_url_title ?: 'External Link' }}</span>
                                                        <svg class="w-3 h-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                        </svg>
                                                    </a>
                                                @elseif ($cp->source_reference)
                                                    <span class="text-slate-400 truncate max-w-[150px] block" title="{{ $cp->source_reference }}">
                                                        {{ $cp->source_reference }}
                                                    </span>
                                                @else
                                                    <span class="text-slate-600">-</span>
                                                @endif
                                            </td>

                                            <!-- Linked Note / Project -->
                                            <td class="py-3.5 px-4">
                                                @if ($cp->note)
                                                    <a href="{{ route('notes.show', $cp->note->slug) }}" target="_blank"
                                                       class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-indigo-500/10 border border-indigo-500/30 text-indigo-300 hover:text-white transition-colors text-[11px]" title="{{ $cp->note->title }}">
                                                        <span>Note: {{ \Illuminate\Support\Str::limit($cp->note->title, 18) }}</span>
                                                    </a>
                                                @endif
                                                @if ($cp->project)
                                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-vermilion-500/10 border border-vermilion-500/30 text-vermilion-300 text-[11px]" title="{{ $cp->project->title }}">
                                                        <span>Proj: {{ \Illuminate\Support\Str::limit($cp->project->title, 18) }}</span>
                                                    </span>
                                                @endif
                                                @if (!$cp->note && !$cp->project)
                                                    <span class="text-slate-600 italic text-[11px]">Belum ditautkan</span>
                                                @endif
                                            </td>

                                            <!-- Quick Toggle Status Dropdown Form -->
                                            <td class="py-3.5 px-4">
                                                <form action="{{ route('roadmap-it-support.toggle-status', $cp) }}" method="POST" class="inline-flex items-center gap-1.5">
                                                    @csrf
                                                    @method('PATCH')
                                                    
                                                    <select name="status" onchange="this.form.submit()"
                                                            class="bg-carbon-950 border border-carbon-800 text-xs rounded-lg py-1 px-2.5 font-mono cursor-pointer focus:ring-1 focus:ring-indigo-500 {{ $badge['text'] }}">
                                                        <option value="finished" {{ $cp->status === 'finished' ? 'selected' : '' }}>✓ Clear / Selesai</option>
                                                        <option value="in_progress" {{ $cp->status === 'in_progress' ? 'selected' : '' }}>⏳ In Progress</option>
                                                        <option value="not_started" {{ $cp->status === 'not_started' ? 'selected' : '' }}>○ Planned</option>
                                                    </select>
                                                </form>
                                            </td>

                                            <!-- Action Buttons -->
                                            <td class="py-3.5 px-6 text-right whitespace-nowrap space-x-2">
                                                <a href="{{ route('roadmap-it-support.edit', $cp) }}"
                                                   class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-carbon-950 hover:bg-carbon-800 border border-carbon-800 text-slate-300 hover:text-white transition-colors">
                                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    <span>Edit</span>
                                                </a>

                                                <button type="button"
                                                        @click="openDeleteModal('{{ route('roadmap-it-support.destroy', $cp) }}', '{{ addslashes($cp->title) }}')"
                                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-carbon-950 hover:bg-rose-500/20 border border-carbon-800 hover:border-rose-500/40 text-slate-400 hover:text-rose-400 transition-colors cursor-pointer">
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    <span>Hapus</span>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center rounded-xl bg-carbon-900 border border-carbon-800 space-y-3 font-mono">
                        <p class="text-slate-400 text-sm">Belum ada checkpoint kurikulum untuk IT Support.</p>
                        <a href="{{ route('roadmap-it-support.create') }}" class="inline-flex items-center gap-1.5 text-xs text-indigo-400 hover:underline">
                            <span>+ Buat Checkpoint Pertama Sekarang</span>
                        </a>
                    </div>
                @endforelse
            </div>

        </div>

        <!-- ─── Modal Delete Confirmation ────────────────────────────────────── -->
        <div x-show="deleteModalOpen" x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center p-4" role="dialog" aria-modal="true">
            <div x-show="deleteModalOpen" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-150"
                 x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="closeDeleteModal()"
                 class="fixed inset-0 bg-black/80 backdrop-blur-sm"></div>

            <div x-show="deleteModalOpen" x-transition:enter="ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95" @click.stop
                 class="relative w-full max-w-md bg-carbon-900 border border-carbon-800 rounded-xl p-6 shadow-2xl z-10 space-y-4 font-mono">
                
                <div class="flex items-center gap-3 text-rose-400">
                    <div class="w-10 h-10 rounded-full bg-rose-500/10 border border-rose-500/20 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-white">Konfirmasi Hapus Checkpoint</h4>
                        <p class="text-xs text-slate-400">Tindakan ini tidak dapat dibatalkan.</p>
                    </div>
                </div>

                <p class="text-xs text-slate-300">
                    Apakah Anda yakin ingin menghapus materi: <strong class="text-white" x-text="checkpointTitle"></strong>?
                </p>

                <div class="flex items-center justify-end gap-2 pt-2">
                    <button type="button" @click="closeDeleteModal()"
                            class="px-3 py-1.5 rounded-lg bg-carbon-950 border border-carbon-800 text-slate-300 hover:text-white text-xs">
                        Batal
                    </button>

                    <form :action="deleteAction" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-3.5 py-1.5 rounded-lg bg-rose-600 hover:bg-rose-500 text-white font-semibold text-xs transition-colors">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>

