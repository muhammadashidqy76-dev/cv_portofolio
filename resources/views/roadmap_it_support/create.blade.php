<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 font-mono text-xs text-slate-400 mb-1">
                    <a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">CMS</a>
                    <span class="text-slate-600">/</span>
                    <a href="{{ route('roadmap-it-support.index') }}" class="hover:text-white transition-colors">Roadmap IT Support</a>
                    <span class="text-slate-600">/</span>
                    <span class="text-indigo-400">Tambah</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold font-mono text-white tracking-tight">
                    Tambah Materi / Checkpoint Baru
                </h1>
            </div>

            <a href="{{ route('roadmap-it-support.index') }}"
               class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-carbon-900 border border-carbon-800 text-slate-300 hover:text-white font-mono text-xs transition-colors">
                &larr; Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('roadmap-it-support.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Form Card -->
            <div class="p-6 rounded-2xl bg-white dark:bg-carbon-900 border border-slate-200 dark:border-carbon-800 space-y-6 shadow-sm dark:shadow-xl font-mono">

                <!-- 0. Pilih Jalur Spesialisasi (Role Track) -->
                <div>
                    <label for="roadmap_role_id" class="block text-xs uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2 font-semibold">
                        Jalur Spesialisasi (Track) <span class="text-rose-500">*</span>
                    </label>
                    <select name="roadmap_role_id" id="roadmap_role_id"
                            class="w-full bg-slate-50 dark:bg-carbon-950 border border-slate-300 dark:border-carbon-800 rounded-lg px-4 py-2.5 text-xs text-slate-900 dark:text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30" required>
                        @foreach ($allRoles as $r)
                            <option value="{{ $r->id }}" {{ old('roadmap_role_id', $role->id) == $r->id ? 'selected' : '' }}>
                                {{ $r->name }} ({{ $r->slug }})
                            </option>
                        @endforeach
                    </select>
                    @error('roadmap_role_id')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 1. Fase / Modul -->
                <div>
                    <label for="phase_name" class="block text-xs uppercase tracking-wider text-slate-300 mb-2 font-semibold">
                        Modul / Fase Kurikulum <span class="text-rose-400">*</span>
                    </label>
                    <input type="text" name="phase_name" id="phase_name" list="existing-phases"
                           value="{{ old('phase_name', '01 // What are Networks & Basic Terminology') }}"
                           placeholder="Contoh: 01 // What are Networks & Basic Terminology"
                           class="w-full bg-carbon-950 border border-carbon-800 rounded-lg px-4 py-2.5 text-xs text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30" required>
                    <datalist id="existing-phases">
                        @foreach ($existingPhases as $ep)
                            <option value="{{ $ep }}"></option>
                        @endforeach
                    </datalist>
                    @error('phase_name')
                        <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 2. Judul Topik -->
                <div>
                    <label for="title" class="block text-xs uppercase tracking-wider text-slate-300 mb-2 font-semibold">
                        Judul Materi / Topik <span class="text-rose-400">*</span>
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                           placeholder="Contoh: DNS (Domain Name System) & Record Hierarchy"
                           class="w-full bg-carbon-950 border border-carbon-800 rounded-lg px-4 py-2.5 text-xs text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30" required>
                    @error('title')
                        <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 3. Deskripsi Materi -->
                <div>
                    <label for="description" class="block text-xs uppercase tracking-wider text-slate-300 mb-2 font-semibold">
                        Penjelasan Detail Materi / Studi Kasus
                    </label>
                    <textarea name="description" id="description" rows="4"
                              placeholder="Tuliskan rangkuman materi, pemahaman teknis, atau langkah pemecahan masalah..."
                              class="w-full bg-carbon-950 border border-carbon-800 rounded-lg px-4 py-2.5 text-xs text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 4. Status Penguasaan -->
                <div>
                    <span class="block text-xs uppercase tracking-wider text-slate-300 mb-2 font-semibold">
                        Status Penguasaan <span class="text-rose-400">*</span>
                    </span>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <label class="flex items-center gap-2 p-3 rounded-xl bg-carbon-950 border border-carbon-800 cursor-pointer hover:border-emerald-500/50">
                            <input type="radio" name="status" value="finished" {{ old('status', 'finished') === 'finished' ? 'checked' : '' }} class="text-emerald-500 focus:ring-emerald-500/30">
                            <span class="text-xs text-emerald-400 font-semibold">✓ Clear (Selesai Dikuasai)</span>
                        </label>
                        <label class="flex items-center gap-2 p-3 rounded-xl bg-carbon-950 border border-carbon-800 cursor-pointer hover:border-amber-500/50">
                            <input type="radio" name="status" value="in_progress" {{ old('status') === 'in_progress' ? 'checked' : '' }} class="text-amber-500 focus:ring-amber-500/30">
                            <span class="text-xs text-amber-400 font-semibold">⏳ In Progress (Sedang Belajar)</span>
                        </label>
                        <label class="flex items-center gap-2 p-3 rounded-xl bg-carbon-950 border border-carbon-800 cursor-pointer hover:border-slate-600">
                            <input type="radio" name="status" value="not_started" {{ old('status') === 'not_started' ? 'checked' : '' }} class="text-slate-500 focus:ring-slate-500/30">
                            <span class="text-xs text-slate-400 font-semibold">○ Planned (Target Nanti)</span>
                        </label>
                    </div>
                    @error('status')
                        <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 5. Sumber Referensi Text -->
                <div>
                    <label for="source_reference" class="block text-xs uppercase tracking-wider text-slate-300 mb-2 font-semibold">
                        Label Sumber / Modul Belajar
                    </label>
                    <input type="text" name="source_reference" id="source_reference" value="{{ old('source_reference') }}"
                           placeholder="Contoh: Cisco Networking Academy (CCNA Free Intro) / Buku Jaringan"
                           class="w-full bg-carbon-950 border border-carbon-800 rounded-lg px-4 py-2.5 text-xs text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30">
                    @error('source_reference')
                        <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 6. Tautan Sumber & Bahan Bacaan (Mendukung Banyak Sumber / Internet & Catatan Sendiri) -->
                <div class="p-4 sm:p-5 rounded-xl bg-carbon-950 border border-carbon-800/80 space-y-4"
                     x-data="{
                         resources: {{ Js::from(old('external_resources', [['title' => old('external_url_title', ''), 'url' => old('external_url', '')]])) }},
                         addResource() {
                             this.resources.push({ title: '', url: '' });
                         },
                         removeResource(index) {
                             if (this.resources.length > 1) {
                                 this.resources.splice(index, 1);
                             } else {
                                 this.resources = [{ title: '', url: '' }];
                             }
                         }
                     }">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-carbon-800 pb-3">
                        <div>
                            <span class="text-xs font-bold text-slate-200 uppercase tracking-wider block">
                                Tautan Sumber Bacaan &amp; Referensi Eksternal
                            </span>
                            <span class="text-[11px] text-slate-500 font-sans">
                                Cantumkan beberapa sumber bacaan internet (Cisco Docs, Cloudflare, Web) atau referensi catatan materi.
                            </span>
                        </div>
                        <button type="button" @click="addResource()"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-indigo-500/10 hover:bg-indigo-500/20 border border-indigo-500/30 text-indigo-300 font-mono text-xs transition-colors cursor-pointer self-start sm:self-auto shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>+ Tambah Sumber</span>
                        </button>
                    </div>

                    <!-- Dynamic Resources Repeater -->
                    <div class="space-y-3">
                        <template x-for="(res, index) in resources" :key="index">
                            <div class="p-3 rounded-lg bg-carbon-900 border border-carbon-800 space-y-2">
                                <div class="flex items-center justify-between text-[11px] font-mono text-slate-400">
                                    <span class="text-indigo-400 font-semibold" x-text="`Sumber #${index + 1}`"></span>
                                    <button type="button" @click="removeResource(index)"
                                            class="text-rose-400 hover:text-rose-300 text-[11px] transition-colors flex items-center gap-1 cursor-pointer">
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span>Hapus</span>
                                    </button>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-[11px] text-slate-400 mb-1">Nama Sumber / Judul Bacaan</label>
                                        <input type="text" :name="`external_resources[${index}][title]`" x-model="res.title"
                                               placeholder="Contoh: Cisco Networking Academy / Cloudflare DNS"
                                               class="w-full bg-carbon-950 border border-carbon-800 rounded-lg px-3 py-2 text-xs text-white focus:border-indigo-500">
                                    </div>
                                    <div>
                                        <label class="block text-[11px] text-slate-400 mb-1">URL Sumber Lengkap</label>
                                        <input type="url" :name="`external_resources[${index}][url]`" x-model="res.url"
                                               placeholder="https://..."
                                               class="w-full bg-carbon-950 border border-carbon-800 rounded-lg px-3 py-2 text-xs text-white focus:border-indigo-500">
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    @error('external_resources.*.url')
                        <p class="text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 7. Integrasi Catatan Teknis (Note Internal) & Proyek -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="learning_log_entry_id" class="block text-xs uppercase tracking-wider text-slate-300 mb-2 font-semibold">
                            Tautkan ke Catatan Teknis (Notes)
                        </label>
                        <select name="learning_log_entry_id" id="learning_log_entry_id"
                                class="w-full bg-carbon-950 border border-carbon-800 rounded-lg px-3 py-2.5 text-xs text-white focus:border-indigo-500">
                            <option value="">-- Tidak Ada / Belum Ditautkan --</option>
                            @foreach ($notes as $n)
                                <option value="{{ $n->id }}" {{ old('learning_log_entry_id') == $n->id ? 'selected' : '' }}>
                                    [{{ strtoupper($n->category) }}] {{ $n->title }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-[10px] text-slate-500 mt-1 block">Prioritas utama: akan memunculkan tombol baca artikel di drawer.</span>
                    </div>

                    <div>
                        <label for="project_id" class="block text-xs uppercase tracking-wider text-slate-300 mb-2 font-semibold">
                            Tautkan ke Featured Project
                        </label>
                        <select name="project_id" id="project_id"
                                class="w-full bg-carbon-950 border border-carbon-800 rounded-lg px-3 py-2.5 text-xs text-white focus:border-indigo-500">
                            <option value="">-- Tidak Ada --</option>
                            @foreach ($projects as $p)
                                <option value="{{ $p->id }}" {{ old('project_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- 8. Display Order -->
                <div>
                    <label for="display_order" class="block text-xs uppercase tracking-wider text-slate-300 mb-2 font-semibold">
                        Urutan Tampilan (Display Order) <span class="text-rose-400">*</span>
                    </label>
                    <input type="number" name="display_order" id="display_order" value="{{ old('display_order', 1) }}" min="0"
                           class="w-32 bg-carbon-950 border border-carbon-800 rounded-lg px-4 py-2 text-xs text-white focus:border-indigo-500" required>
                </div>

            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end gap-3 font-mono">
                <a href="{{ route('roadmap-it-support.index') }}"
                   class="px-4 py-2.5 rounded-lg bg-carbon-950 border border-carbon-800 text-slate-400 hover:text-white text-xs">
                    Batal
                </a>
                <button type="submit"
                        class="px-5 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-500 font-semibold text-white text-xs shadow-lg shadow-indigo-600/20 transition-all cursor-pointer">
                    Simpan Checkpoint Baru
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

