<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 font-mono text-xs text-slate-400 mb-1">
                    <a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">Cms</a>
                    <span class="text-slate-600">/</span>
                    <a href="{{ route('tech-stack.index') }}" class="hover:text-white transition-colors">Tech-Stack</a>
                    <span class="text-slate-600">/</span>
                    <span class="text-vermilion-400">Edit</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold font-mono text-white tracking-tight">
                    Edit Item Tech Stack: <span class="text-vermilion-400">{{ $techStackItem->name }}</span>
                </h1>
            </div>

            <a href="{{ route('tech-stack.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg font-mono text-xs text-slate-400 hover:text-white bg-carbon-900 hover:bg-carbon-850 border border-carbon-800 transition-colors">
                <span>Kembali ke Daftar</span>
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <form method="POST" action="{{ route('tech-stack.update', $techStackItem) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-xl overflow-hidden">
                    <div class="px-6 py-4 bg-carbon-950/80 border-b border-carbon-800 flex items-center justify-between">
                        <span class="font-mono text-xs font-semibold text-white uppercase tracking-wider">
                            1 | Perbarui Properti Teknologi
                        </span>
                        <span class="text-[10px] font-mono text-slate-500">ID: #{{ $techStackItem->id }}</span>
                    </div>

                    <div class="p-6 space-y-6">
                        
                        <!-- Nama Teknologi -->
                        <div>
                            <x-input-label for="name" :value="__('Nama Teknologi *')" />
                            <x-text-input id="name" 
                                          type="text" 
                                          name="name" 
                                          :value="old('name', $techStackItem->name)" 
                                          required 
                                          placeholder="mis. Laravel, Redis, Docker, PostgreSQL" />
                            <x-input-error :messages="$errors->get('name')" />
                        </div>

                        <!-- Kategori (Preset Dropdown / Custom) -->
                        <div x-data="{ isCustom: '{{ old('category', $techStackItem->category) === '__custom' ? 'true' : 'false' }}' === 'true' }">
                            <x-input-label for="category" :value="__('Kategori Stack *')" />
                            <select id="category" 
                                    name="category" 
                                    @change="isCustom = ($event.target.value === '__custom')"
                                    class="w-full bg-carbon-950 border border-carbon-800 text-slate-100 text-sm rounded-lg focus:border-vermilion-500 focus:ring-1 focus:ring-vermilion-500/30 transition-colors shadow-sm block p-2.5 font-mono">
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat }}" {{ old('category', $techStackItem->category) === $cat ? 'selected' : '' }}>
                                        {{ $cat }}
                                    </option>
                                @endforeach
                                <option value="__custom" {{ old('category') === '__custom' ? 'selected' : '' }}>
                                    + Tambah Kategori Baru...
                                </option>
                            </select>

                            <!-- Input Kategori Baru (Conditional via Alpine.js) -->
                            <div x-show="isCustom" x-cloak class="mt-3">
                                <x-input-label for="custom_category" :value="__('Tulis Nama Kategori Baru')" />
                                <x-text-input id="custom_category" 
                                              type="text" 
                                              name="custom_category" 
                                              :value="old('custom_category')" 
                                              placeholder="mis. Cloud &amp; Infrastructure, Testing, Message Broker" />
                            </div>
                            <x-input-error :messages="$errors->get('category')" />
                        </div>

                        <!-- Status Penguasaan (Finished / In Progress / Not Started) -->
                        <div>
                            <x-input-label :value="__('Status Penguasaan / Pembelajaran *')" />
                            <p class="text-[11px] font-mono text-slate-400 mb-3">
                                Menentukan warna badge visual di bagian Tech Stack beranda portofolio.
                            </p>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                
                                <!-- 1. Finished -->
                                <label class="relative flex flex-col p-4 rounded-lg bg-carbon-950 border border-carbon-800 hover:border-emerald-500/40 cursor-pointer transition-colors has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-500/5">
                                    <div class="flex items-center justify-between mb-2">
                                        <input type="radio" 
                                               name="status" 
                                               value="finished" 
                                               {{ old('status', $techStackItem->status) === 'finished' ? 'checked' : '' }}
                                               class="w-4 h-4 text-emerald-500 bg-carbon-900 border-carbon-800 focus:ring-emerald-500/20">
                                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
                                    </div>
                                    <span class="font-mono text-xs font-bold text-white">Finished</span>
                                    <span class="text-[11px] font-mono text-emerald-400 mt-0.5">Dikuasai</span>
                                    <span class="text-[10px] text-slate-500 mt-1">Sudah mahir &amp; dipakai di proyek portofolio.</span>
                                </label>

                                <!-- 2. In Progress -->
                                <label class="relative flex flex-col p-4 rounded-lg bg-carbon-950 border border-carbon-800 hover:border-amber-500/40 cursor-pointer transition-colors has-[:checked]:border-amber-500 has-[:checked]:bg-amber-500/5">
                                    <div class="flex items-center justify-between mb-2">
                                        <input type="radio" 
                                               name="status" 
                                               value="in_progress" 
                                               {{ old('status', $techStackItem->status) === 'in_progress' ? 'checked' : '' }}
                                               class="w-4 h-4 text-amber-500 bg-carbon-900 border-carbon-800 focus:ring-amber-500/20">
                                        <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                                    </div>
                                    <span class="font-mono text-xs font-bold text-white">In Progress</span>
                                    <span class="text-[11px] font-mono text-amber-400 mt-0.5">Sedang Belajar</span>
                                    <span class="text-[10px] text-slate-500 mt-1">Sedang aktif dipelajari &amp; dieksplorasi.</span>
                                </label>

                                <!-- 3. Not Started -->
                                <label class="relative flex flex-col p-4 rounded-lg bg-carbon-950 border border-carbon-800 hover:border-rose-500/40 cursor-pointer transition-colors has-[:checked]:border-rose-500 has-[:checked]:bg-rose-500/5">
                                    <div class="flex items-center justify-between mb-2">
                                        <input type="radio" 
                                               name="status" 
                                               value="not_started" 
                                               {{ old('status', $techStackItem->status) === 'not_started' ? 'checked' : '' }}
                                               class="w-4 h-4 text-rose-500 bg-carbon-900 border-carbon-800 focus:ring-rose-500/20">
                                        <span class="w-2.5 h-2.5 rounded-full bg-rose-400"></span>
                                    </div>
                                    <span class="font-mono text-xs font-bold text-white">Not Started</span>
                                    <span class="text-[11px] font-mono text-rose-400 mt-0.5">Rencana</span>
                                    <span class="text-[10px] text-slate-500 mt-1">Target pembelajaran mendatang.</span>
                                </label>

                            </div>
                            <x-input-error :messages="$errors->get('status')" />
                        </div>

                        <!-- Display Order -->
                        <div>
                            <x-input-label for="display_order" :value="__('Urutan Tampilan (Display Order) *')" />
                            <x-text-input id="display_order" 
                                          type="number" 
                                          name="display_order" 
                                          :value="old('display_order', $techStackItem->display_order)" 
                                          min="0" 
                                          max="9999" 
                                          required />
                            <p class="text-[11px] font-mono text-slate-500 mt-1">
                                Nomor urutan tampil di dalam kategori.
                            </p>
                            <x-input-error :messages="$errors->get('display_order')" />
                        </div>

                    </div>
                </div>

                <!-- ─── CARD: Kelola Relasi Featured Projects ───────────────────────── -->
                <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-xl overflow-hidden"
                     x-data="{
                         selectAll() {
                             this.$el.querySelectorAll('input[type=checkbox]').forEach(el => el.checked = true);
                         },
                         deselectAll() {
                             this.$el.querySelectorAll('input[type=checkbox]').forEach(el => el.checked = false);
                         }
                     }">
                    <div class="px-6 py-4 bg-carbon-950/80 border-b border-carbon-800 flex items-center justify-between">
                        <div>
                            <span class="font-mono text-xs font-semibold text-white uppercase tracking-wider block">
                               2 | Hubungkan / Kelola Relasi Proyek ({{ $techStackItem->projects->count() }} Terhubung)
                            </span>
                            <span class="text-[11px] font-mono text-slate-400">
                                Centang untuk menghubungkan, hapus centang untuk mencopot relasi dari proyek.
                            </span>
                        </div>
                        <div class="flex items-center gap-2">
                            <button type="button" @click="selectAll()" class="text-[11px] font-mono text-vermilion-400 hover:text-vermilion-300">Pilih Semua</button>
                            <span class="text-slate-600 font-mono text-xs">•</span>
                            <button type="button" @click="deselectAll()" class="text-[11px] font-mono text-slate-400 hover:text-white">Batal</button>
                        </div>
                    </div>

                    <div class="p-6">
                        @if ($projects->isNotEmpty())
                            @php
                                $attachedIds = old('project_ids', $techStackItem->projects->pluck('id')->toArray());
                            @endphp
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach ($projects as $proj)
                                    @php
                                        $isChecked = in_array($proj->id, $attachedIds);
                                    @endphp
                                    <label class="flex items-start justify-between gap-3 p-3.5 rounded-lg bg-carbon-950 border border-carbon-800 hover:border-carbon-700 cursor-pointer transition-colors has-[:checked]:border-vermilion-500/50 has-[:checked]:bg-vermilion-500/5">
                                        <div class="flex items-start gap-3">
                                            <input type="checkbox" 
                                                   name="project_ids[]" 
                                                   value="{{ $proj->id }}"
                                                   {{ $isChecked ? 'checked' : '' }}
                                                   class="mt-0.5 rounded bg-carbon-900 border-carbon-700 text-vermilion-500 focus:ring-vermilion-500/20">
                                            <div class="text-xs font-mono">
                                                <div class="flex items-center gap-2 mb-0.5">
                                                    <span class="text-vermilion-400 font-bold">#0{{ $proj->complexity_order }}</span>
                                                    <span class="text-white font-medium">{{ $proj->title }}</span>
                                                </div>
                                                <span class="text-[11px] text-slate-500 block truncate max-w-[220px]">
                                                    {{ $proj->problem_statement ?? 'Proyek Portofolio' }}
                                                </span>
                                            </div>
                                        </div>

                                        <a href="{{ route('projects.edit', $proj) }}" 
                                           target="_blank"
                                           class="text-[10px] font-mono text-slate-500 hover:text-white shrink-0 self-center px-1.5 py-0.5 rounded bg-carbon-900 border border-carbon-800 transition-colors"
                                           title="Buka proyek di tab baru">
                                            ↗
                                        </a>
                                    </label>
                                @endforeach
                            </div>
                        @else
                            <p class="text-xs font-mono text-slate-500">
                                Belum ada Featured Project yang terdaftar di database.
                            </p>
                        @endif
                        <x-input-error :messages="$errors->get('project_ids')" />
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-2">
                    <a href="{{ route('tech-stack.index') }}" class="px-4 py-2 rounded-lg font-mono text-xs font-medium text-slate-400 hover:text-white transition-colors">
                        Batal &amp; Kembali
                    </a>

                    <x-primary-button>
                        {{ __('Simpan Perubahan') }}
                    </x-primary-button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>
