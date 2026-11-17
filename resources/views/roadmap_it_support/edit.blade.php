<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 font-mono text-xs text-slate-400 mb-1">
                    <a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">CMS</a>
                    <span class="text-slate-600">/</span>
                    <a href="{{ route('roadmap-it-support.index') }}" class="hover:text-white transition-colors">Roadmap IT Support</a>
                    <span class="text-slate-600">/</span>
                    <span class="text-indigo-400">Edit Checkpoint</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold font-mono text-white tracking-tight">
                    Edit: {{ $checkpoint->title }}
                </h1>
            </div>

            <a href="{{ route('roadmap-it-support.index') }}"
               class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-carbon-900 border border-carbon-800 text-slate-300 hover:text-white font-mono text-xs transition-colors">
                &larr; Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('roadmap-it-support.update', $checkpoint) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Form Card -->
            <div class="p-6 rounded-2xl bg-carbon-900 border border-carbon-800 space-y-6 shadow-xl font-mono">

                <!-- 1. Fase / Modul -->
                <div>
                    <label for="phase_name" class="block text-xs uppercase tracking-wider text-slate-300 mb-2 font-semibold">
                        Modul / Fase Kurikulum <span class="text-rose-400">*</span>
                    </label>
                    <input type="text" name="phase_name" id="phase_name" list="existing-phases"
                           value="{{ old('phase_name', $checkpoint->phase_name) }}"
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
                    <input type="text" name="title" id="title" value="{{ old('title', $checkpoint->title) }}"
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
                              class="w-full bg-carbon-950 border border-carbon-800 rounded-lg px-4 py-2.5 text-xs text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30">{{ old('description', $checkpoint->description) }}</textarea>
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
                            <input type="radio" name="status" value="finished" {{ old('status', $checkpoint->status) === 'finished' ? 'checked' : '' }} class="text-emerald-500 focus:ring-emerald-500/30">
                            <span class="text-xs text-emerald-400 font-semibold">✓ Clear (Selesai Dikuasai)</span>
                        </label>
                        <label class="flex items-center gap-2 p-3 rounded-xl bg-carbon-950 border border-carbon-800 cursor-pointer hover:border-amber-500/50">
                            <input type="radio" name="status" value="in_progress" {{ old('status', $checkpoint->status) === 'in_progress' ? 'checked' : '' }} class="text-amber-500 focus:ring-amber-500/30">
                            <span class="text-xs text-amber-400 font-semibold">⏳ In Progress (Sedang Belajar)</span>
                        </label>
                        <label class="flex items-center gap-2 p-3 rounded-xl bg-carbon-950 border border-carbon-800 cursor-pointer hover:border-slate-600">
                            <input type="radio" name="status" value="not_started" {{ old('status', $checkpoint->status) === 'not_started' ? 'checked' : '' }} class="text-slate-500 focus:ring-slate-500/30">
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
                    <input type="text" name="source_reference" id="source_reference" value="{{ old('source_reference', $checkpoint->source_reference) }}"
                           placeholder="Contoh: Cisco Networking Academy (CCNA Free Intro) / Buku Jaringan"
                           class="w-full bg-carbon-950 border border-carbon-800 rounded-lg px-4 py-2.5 text-xs text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30">
                    @error('source_reference')
                        <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 6. Link External Resources (Jika belum ada Note internal) -->
                <div class="p-4 rounded-xl bg-carbon-950 border border-carbon-800/80 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-200 uppercase tracking-wider">
                            Tautan Sumber / Blog Eksternal (Opsional)
                        </span>
                        <span class="text-[10px] text-slate-500">Dipakai jika belum ada artikel catatan teknis sendiri</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="external_url_title" class="block text-[11px] text-slate-400 mb-1">Nama Sumber / Blog</label>
                            <input type="text" name="external_url_title" id="external_url_title" value="{{ old('external_url_title', $checkpoint->external_url_title) }}"
                                   placeholder="Contoh: Cloudflare Learning / Cisco Doc"
                                   class="w-full bg-carbon-900 border border-carbon-800 rounded-lg px-3 py-2 text-xs text-white focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="external_url" class="block text-[11px] text-slate-400 mb-1">URL Sumber Lengkap</label>
                            <input type="url" name="external_url" id="external_url" value="{{ old('external_url', $checkpoint->external_url) }}"
                                   placeholder="https://www.cloudflare.com/learning/..."
                                   class="w-full bg-carbon-900 border border-carbon-800 rounded-lg px-3 py-2 text-xs text-white focus:border-indigo-500">
                        </div>
                    </div>
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
                                <option value="{{ $n->id }}" {{ old('learning_log_entry_id', $checkpoint->learning_log_entry_id) == $n->id ? 'selected' : '' }}>
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
                                <option value="{{ $p->id }}" {{ old('project_id', $checkpoint->project_id) == $p->id ? 'selected' : '' }}>
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
                    <input type="number" name="display_order" id="display_order" value="{{ old('display_order', $checkpoint->display_order) }}" min="0"
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
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

