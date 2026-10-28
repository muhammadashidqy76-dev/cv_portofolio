<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 font-mono text-xs text-slate-400 mb-1">
                    <a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">cms</a>
                    <span class="text-slate-600">/</span>
                    <a href="{{ route('projects.index') }}" class="hover:text-white transition-colors">projects</a>
                    <span class="text-slate-600">/</span>
                    <span class="text-vermilion-400">create</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold font-mono text-white tracking-tight">
                    Tambah Featured Project Baru
                </h1>
            </div>

            <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg font-mono text-xs text-slate-400 hover:text-white bg-carbon-900 hover:bg-carbon-850 border border-carbon-800 transition-colors">
                <span>Kembali ke Daftar</span>
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- ─── CARD 1: Identitas & Konfigurasi Utama ────────────────────────── -->
                <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-xl overflow-hidden">
                    <div class="px-6 py-4 bg-carbon-950/80 border-b border-carbon-800 flex items-center justify-between">
                        <span class="font-mono text-xs font-semibold text-white uppercase tracking-wider">
                            01 | Identitas &amp; Pengurutan Proyek
                        </span>
                        <span class="text-[10px] font-mono text-slate-500">REQUIRED_FIELDS</span>
                    </div>

                    <div class="p-6 space-y-5">
                        
                        <!-- Grid Judul ID & EN -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <x-input-label for="title_id" :value="__('Judul Proyek (Bahasa Indonesia) *')" />
                                <x-text-input id="title_id" 
                                              type="text" 
                                              name="title_id" 
                                              :value="old('title_id')" 
                                              required 
                                              autofocus 
                                              placeholder="mis. StockGuard — E-Commerce Checkout Engine"
                                              oninput="if(!document.getElementById('slug').value || document.getElementById('slug').dataset.auto !== 'false') { document.getElementById('slug').value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, ''); }" />
                                <x-input-error :messages="$errors->get('title_id')" />
                            </div>

                            <div>
                                <x-input-label for="title_en" :value="__('Judul Proyek (Bahasa Inggris - Opsional)')" />
                                <x-text-input id="title_en" 
                                              type="text" 
                                              name="title_en" 
                                              :value="old('title_en')" 
                                              placeholder="mis. StockGuard — High-Throughput Checkout Engine" />
                                <x-input-error :messages="$errors->get('title_en')" />
                            </div>
                        </div>

                        <!-- Slug URL & Complexity Order -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div class="md:col-span-2">
                                <x-input-label for="slug" :value="__('Slug URL (Unique Identifier) *')" />
                                <div class="relative">
                                    <x-text-input id="slug" 
                                                  type="text" 
                                                  name="slug" 
                                                  :value="old('slug')" 
                                                  required 
                                                  onchange="this.dataset.auto = 'false';"
                                                  placeholder="stockguard-ecommerce-checkout-engine" />
                                </div>
                                <p class="text-[11px] font-mono text-slate-500 mt-1">
                                    Digunakan untuk penamaan URL dan pengaitan catatan log pembelajaran.
                                </p>
                                <x-input-error :messages="$errors->get('slug')" />
                            </div>

                            <div>
                                <x-input-label for="complexity_order" :value="__('Complexity Order (Tier) *')" />
                                <x-text-input id="complexity_order" 
                                              type="number" 
                                              name="complexity_order" 
                                              :value="old('complexity_order', $nextOrder)" 
                                              min="1" 
                                              max="100" 
                                              required />
                                <p class="text-[11px] font-mono text-slate-500 mt-1">
                                    #1 E-Commerce &bull; #2 API &bull; #3 CMS
                                </p>
                                <x-input-error :messages="$errors->get('complexity_order')" />
                            </div>
                        </div>

                        <!-- Status Publikasi -->
                        <div>
                            <x-input-label :value="__('Status Publikasi *')" />
                            <div class="flex items-center gap-4 mt-2">
                                <label class="flex items-center gap-2 cursor-pointer select-none">
                                    <input type="radio" 
                                           name="status" 
                                           value="published" 
                                           {{ old('status', 'published') === 'published' ? 'checked' : '' }}
                                           class="w-4 h-4 text-vermilion-500 bg-carbon-950 border-carbon-800 focus:ring-vermilion-500/20">
                                    <span class="text-xs font-mono text-slate-200">Published (Tampil di Website Publik)</span>
                                </label>

                                <label class="flex items-center gap-2 cursor-pointer select-none">
                                    <input type="radio" 
                                           name="status" 
                                           value="draft" 
                                           {{ old('status') === 'draft' ? 'checked' : '' }}
                                           class="w-4 h-4 text-vermilion-500 bg-carbon-950 border-carbon-800 focus:ring-vermilion-500/20">
                                    <span class="text-xs font-mono text-slate-400">Draft (Tersimpan sebagai arsip internal)</span>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('status')" />
                        </div>

                    </div>
                </div>

                <!-- ─── CARD 2: Problem Statement & Arsitektur ───────────────────────── -->
                <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-xl overflow-hidden">
                    <div class="px-6 py-4 bg-carbon-950/80 border-b border-carbon-800 flex items-center justify-between">
                        <span class="font-mono text-xs font-semibold text-white uppercase tracking-wider">
                            02 | Problem Statement &amp; Narasi Teknis
                        </span>
                        <span class="text-[10px] font-mono text-slate-500">ENGINEERING_DETAILS</span>
                    </div>

                    <div class="p-6 space-y-5">
                        
                        <!-- Problem Statement ID -->
                        <div>
                            <x-input-label for="problem_statement_id" :value="__('Problem Statement (Bahasa Indonesia) *')" />
                            <textarea id="problem_statement_id" 
                                      name="problem_statement_id" 
                                      rows="3" 
                                      required
                                      class="w-full bg-carbon-950 border border-carbon-800 text-slate-100 placeholder-slate-500 text-sm rounded-lg focus:border-vermilion-500 focus:ring-1 focus:ring-vermilion-500/30 transition-colors shadow-sm block p-3"
                                      placeholder="Jelaskan masalah teknis spesifik yang diselesaikan oleh proyek ini (mis. race condition stok saat flash sale).">{{ old('problem_statement_id') }}</textarea>
                            <x-input-error :messages="$errors->get('problem_statement_id')" />
                        </div>

                        <!-- Problem Statement EN (Opsional) -->
                        <div>
                            <x-input-label for="problem_statement_en" :value="__('Problem Statement (Bahasa Inggris - Opsional)')" />
                            <textarea id="problem_statement_en" 
                                      name="problem_statement_en" 
                                      rows="2" 
                                      class="w-full bg-carbon-950 border border-carbon-800 text-slate-100 placeholder-slate-500 text-sm rounded-lg focus:border-vermilion-500 focus:ring-1 focus:ring-vermilion-500/30 transition-colors shadow-sm block p-3"
                                      placeholder="Problem statement in English...">{{ old('problem_statement_en') }}</textarea>
                            <x-input-error :messages="$errors->get('problem_statement_en')" />
                        </div>

                        <!-- Architecture Details ID -->
                        <div>
                            <x-input-label for="architecture_details_id" :value="__('Keputusan Arsitektur & Detail Teknis (Bahasa Indonesia)')" />
                            <textarea id="architecture_details_id" 
                                      name="architecture_details_id" 
                                      rows="4" 
                                      class="w-full bg-carbon-950 border border-carbon-800 text-slate-100 placeholder-slate-500 text-sm rounded-lg focus:border-vermilion-500 focus:ring-1 focus:ring-vermilion-500/30 transition-colors shadow-sm block p-3 font-mono text-xs leading-relaxed"
                                      placeholder="1. Pessimistic Locking dengan lockForUpdate()&#10;2. Async Job Queue menggunakan Redis&#10;3. Service Layer Pattern untuk pemisahan logika bisnis">{{ old('architecture_details_id') }}</textarea>
                            <p class="text-[11px] font-mono text-slate-500 mt-1">
                                Tulis poin-poin keputusan teknis (database locking, queue, cache, arsitektur API).
                            </p>
                            <x-input-error :messages="$errors->get('architecture_details_id')" />
                        </div>

                        <!-- Architecture Details EN (Opsional) -->
                        <div>
                            <x-input-label for="architecture_details_en" :value="__('Keputusan Arsitektur (Bahasa Inggris - Opsional)')" />
                            <textarea id="architecture_details_en" 
                                      name="architecture_details_en" 
                                      rows="3" 
                                      class="w-full bg-carbon-950 border border-carbon-800 text-slate-100 placeholder-slate-500 text-sm rounded-lg focus:border-vermilion-500 focus:ring-1 focus:ring-vermilion-500/30 transition-colors shadow-sm block p-3 font-mono text-xs leading-relaxed"
                                      placeholder="Technical architectural decisions in English...">{{ old('architecture_details_en') }}</textarea>
                            <x-input-error :messages="$errors->get('architecture_details_en')" />
                        </div>

                        <!-- Impact Metric -->
                        <div>
                            <x-input-label for="impact_metric" :value="__('Metrik Dampak / Key Performance Indicator (KPI)')" />
                            <x-text-input id="impact_metric" 
                                          type="text" 
                                          name="impact_metric" 
                                          :value="old('impact_metric')" 
                                          placeholder="mis. 300+ checkout simultan tanpa overselling, response time <150ms" />
                            <p class="text-[11px] font-mono text-slate-500 mt-1">
                                Rekruter menyukai bukti terukur (throughput, latency, atau efisiensi query).
                            </p>
                            <x-input-error :messages="$errors->get('impact_metric')" />
                        </div>

                    </div>
                </div>

                <!-- ─── CARD 3: Media & Tautan Live Demo ─────────────────────────────── -->
                <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-xl overflow-hidden">
                    <div class="px-6 py-4 bg-carbon-950/80 border-b border-carbon-800 flex items-center justify-between">
                        <span class="font-mono text-xs font-semibold text-white uppercase tracking-wider">
                            03 | Media Thumbnail &amp; Live Demo URL
                        </span>
                        <span class="text-[10px] font-mono text-slate-500">MEDIA_LINKS</span>
                    </div>

                    <div class="p-6 space-y-5">
                        
                        <!-- Demo URL -->
                        <div>
                            <x-input-label for="demo_url" :value="__('Demo URL (Tautan Live Proyek / Swagger Docs)')" />
                            <x-text-input id="demo_url" 
                                          type="url" 
                                          name="demo_url" 
                                          :value="old('demo_url')" 
                                          placeholder="https:|stockguard-demo.example.com" />
                            <p class="text-[11px] font-mono text-slate-500 mt-1">
                                Tautan eksternal yang dapat diuji langsung oleh recruiter.
                            </p>
                            <x-input-error :messages="$errors->get('demo_url')" />
                        </div>

                        <!-- Thumbnail Image Upload & Path -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-2 border-t border-carbon-800/80">
                            <div>
                                <x-input-label for="preview_image" :value="__('Upload File Thumbnail (Gambar)')" />
                                <input id="preview_image" 
                                       type="file" 
                                       name="preview_image" 
                                       accept="image/png,image/jpeg,image/webp,image/svg+xml"
                                       class="w-full text-xs font-mono text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-mono file:bg-carbon-800 file:text-slate-200 hover:file:bg-carbon-750 file:cursor-pointer cursor-pointer bg-carbon-950 border border-carbon-800 rounded-lg p-2" />
                                <p class="text-[11px] font-mono text-slate-500 mt-1">
                                    Format: PNG, JPG, WebP, SVG (Maksimal 4MB).
                                </p>
                                <x-input-error :messages="$errors->get('preview_image')" />
                            </div>

                            <div>
                                <x-input-label for="preview_image_path" :value="__('Atau Masukkan URL / Path Gambar Langsung')" />
                                <x-text-input id="preview_image_path" 
                                              type="text" 
                                              name="preview_image_path" 
                                              :value="old('preview_image_path')" 
                                              placeholder="https:|placehold.co/800x450/0f0f23/6366f1?text=StockGuard" />
                                <p class="text-[11px] font-mono text-slate-500 mt-1">
                                    Dapat diisi URL eksternal atau dikosongkan untuk mockup API otomatis.
                                </p>
                                <x-input-error :messages="$errors->get('preview_image_path')" />
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ─── CARD 4: Hubungkan Tech Stack (Pivot Table) ────────────────────── -->
                <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-xl overflow-hidden">
                    <div class="px-6 py-4 bg-carbon-950/80 border-b border-carbon-800 flex items-center justify-between">
                        <span class="font-mono text-xs font-semibold text-white uppercase tracking-wider">
                            04 | Hubungkan Tech Stack (Relasi Pivot)
                        </span>
                        <span class="text-[10px] font-mono text-slate-500">TECH_STACK_ITEMS</span>
                    </div>

                    <div class="p-6 space-y-6">
                        <p class="text-xs font-mono text-slate-400">
                            Pilih teknologi yang digunakan pada proyek ini. Badge tech stack akan otomatis tampil pada kartu proyek.
                        </p>

                        @foreach ($techStackItems as $category => $items)
                            <div class="space-y-3">
                                <div class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-vermilion-400"></span>
                                    <h4 class="font-mono text-xs font-bold text-slate-300 uppercase tracking-wider">
                                        {{ $category }}
                                    </h4>
                                    <span class="text-[10px] font-mono text-slate-600">({{ count($items) }} items)</span>
                                </div>

                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2.5">
                                    @foreach ($items as $tech)
                                        <label class="flex items-center gap-2.5 p-2 rounded-lg bg-carbon-950 border border-carbon-800 hover:border-carbon-700 cursor-pointer select-none transition-colors">
                                            <input type="checkbox" 
                                                   name="tech_stack_items[]" 
                                                   value="{{ $tech->id }}"
                                                   {{ in_array($tech->id, old('tech_stack_items', [])) ? 'checked' : '' }}
                                                   class="w-4 h-4 rounded border-carbon-800 bg-carbon-900 text-vermilion-500 focus:ring-vermilion-500/20">
                                            <div class="min-w-0">
                                                <span class="block text-xs font-mono text-slate-200 truncate">{{ $tech->name }}</span>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        <x-input-error :messages="$errors->get('tech_stack_items')" />
                    </div>
                </div>

                <!-- ─── Action Buttons ────────────────────────────────────────────────── -->
                <div class="flex items-center justify-between pt-4 border-t border-carbon-800">
                    <a href="{{ route('projects.index') }}" class="px-4 py-2 rounded-lg font-mono text-xs font-medium text-slate-400 hover:text-white transition-colors">
                        Batal &amp; Kembali
                    </a>

                    <div class="flex items-center gap-3">
                        <x-primary-button>
                            {{ __('Simpan Proyek Baru') }}
                        </x-primary-button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>
