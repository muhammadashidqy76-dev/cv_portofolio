<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 font-mono text-xs text-slate-400 mb-1">
                    <a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">Cms</a>
                    <span class="text-slate-600">/</span>
                    <a href="{{ route('learning-log.index') }}" class="hover:text-white transition-colors">Notes</a>
                    <span class="text-slate-600">/</span>
                    <span class="text-vermilion-400">Edit</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold font-mono text-white tracking-tight">
                    Edit Catatan: <span class="text-vermilion-400">{{ $learningLogEntry->title }}</span>
                </h1>
            </div>

            <div class="flex items-center gap-2">
                @if ($learningLogEntry->status === 'published')
                    <a href="{{ route('notes.show', $learningLogEntry->slug) }}" 
                    target="_blank" 
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg font-mono text-xs text-vermilion-400 hover:text-vermilion-300 bg-carbon-900 hover:bg-carbon-850 border border-carbon-800 transition-colors">
                        <span>Lihat Publik</span>
                        <svg class="w-3.5 h-3.5 text-vermilion-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </a>
                @endif

                <a href="{{ route('learning-log.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg font-mono text-xs text-slate-400 hover:text-white bg-carbon-900 hover:bg-carbon-850 border border-carbon-800 transition-colors">
                    <span>Kembali ke Daftar</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <form method="POST" action="{{ route('learning-log.update', $learningLogEntry) }}" class="space-y-6"
                  x-data="{
                      title: '{{ addslashes(old('title', $learningLogEntry->title)) }}',
                      slug: '{{ addslashes(old('slug', $learningLogEntry->slug)) }}',
                      autoSlug: false,
                      bodyText: `{{ addslashes(old('body', $learningLogEntry->body ?? '')) }}`,
                      wordCount: 0,
                      readingTime: '1 min read',
                      init() {
                          this.updateMetrics();
                      },
                      generateSlug() {
                          if (this.autoSlug) {
                              this.slug = this.title.toLowerCase()
                                  .replace(/[^a-z0-9 -]/g, '')
                                  .replace(/\s+/g, '-')
                                  .replace(/-+/g, '-');
                          }
                      },
                      updateMetrics() {
                          const words = this.bodyText.trim() ? this.bodyText.trim().split(/\s+/).length : 0;
                          this.wordCount = words;
                          const mins = Math.max(1, Math.ceil(words / 180));
                          this.readingTime = `${mins} min read`;
                      },
                      insertMarkdown(syntax, placeholder = '') {
                          const textarea = this.$refs.bodyEditor;
                          const start = textarea.selectionStart;
                          const end = textarea.selectionEnd;
                          const selected = textarea.value.substring(start, end) || placeholder;
                          let replacement = '';
                          if (syntax === 'h2') replacement = `\n## ${selected}\n`;
                          else if (syntax === 'h3') replacement = `\n### ${selected}\n`;
                          else if (syntax === 'bold') replacement = `**${selected}**`;
                          else if (syntax === 'code') replacement = `\n\`\`\`php\n${selected}\n\`\`\`\n`;
                          else if (syntax === 'list') replacement = `\n- ${selected}\n`;
                          else if (syntax === 'quote') replacement = `\n> ${selected}\n`;
                          
                          textarea.setRangeText(replacement, start, end, 'end');
                          this.bodyText = textarea.value;
                          this.updateMetrics();
                          textarea.focus();
                      }
                  }">
                @csrf
                @method('PUT')

                <!-- ─── CARD 1: Judul & Slug URL ──────────────────────────────────── -->
                <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-xl overflow-hidden">
                    <div class="px-6 py-4 bg-carbon-950/80 border-b border-carbon-800 flex items-center justify-between">
                        <span class="font-mono text-xs font-semibold text-white uppercase tracking-wider">
                            1 | Identitas Catatan &amp; URL Slug
                        </span>
                        <span class="text-[10px] font-mono text-slate-500">ID: #{{ $learningLogEntry->id }}</span>
                    </div>

                    <div class="p-6 space-y-5">
                        
                        <!-- Judul -->
                        <div>
                            <x-input-label for="title" :value="__('Judul Artikel Catatan Teknis *')" />
                            <x-text-input id="title" 
                                          type="text" 
                                          name="title" 
                                          x-model="title"
                                          @input="generateSlug()"
                                          required 
                                          placeholder="mis. Arsitektur Redis Caching &amp; Invalidation Pattern di Laravel" />
                            <x-input-error :messages="$errors->get('title')" />
                        </div>

                        <!-- Slug URL -->
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <x-input-label for="slug" :value="__('Slug URL *')" class="mb-0" />
                                <label class="flex items-center gap-1.5 text-[11px] font-mono text-slate-400 cursor-pointer select-none">
                                    <input type="checkbox" x-model="autoSlug" class="rounded bg-carbon-950 border-carbon-700 text-vermilion-500 focus:ring-vermilion-500/20 w-3 h-3">
                                    <span>Sinkronkan Otomatis dengan Judul</span>
                                </label>
                            </div>
                            <div class="flex rounded-lg shadow-sm font-mono text-xs">
                                <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-carbon-800 bg-carbon-950 text-slate-500">
                                    /notes/
                                </span>
                                <input id="slug" 
                                       type="text" 
                                       name="slug" 
                                       x-model="slug"
                                       @input="autoSlug = false"
                                       required
                                       placeholder="arsitektur-redis-caching-laravel" 
                                       class="block w-full rounded-none rounded-r-lg bg-carbon-950 border-carbon-800 text-slate-100 focus:border-vermilion-500 focus:ring-1 focus:ring-vermilion-500/30 text-xs font-mono" />
                            </div>
                            <x-input-error :messages="$errors->get('slug')" />
                        </div>

                    </div>
                </div>

                <!-- ─── CARD 2: Pilar Kategori & Status Kesiapan ───────────────────── -->
                <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-xl overflow-hidden">
                    <div class="px-6 py-4 bg-carbon-950/80 border-b border-carbon-800 flex items-center justify-between">
                        <span class="font-mono text-xs font-semibold text-white uppercase tracking-wider">
                            2 | Klasifikasi Pilar &amp; Tingkat Kesiapan
                        </span>
                        <span class="text-[10px] font-mono text-slate-500">TAXONOMY</span>
                    </div>

                    <div class="p-6 space-y-6">
                        
                        <!-- Pilar Kategori -->
                        <div>
                            <x-input-label :value="__('Pilar Utama (Category) *')" />
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-1.5">
                                
                                <!-- Laravel Backend -->
                                <label class="flex items-start gap-3 p-3.5 rounded-lg bg-carbon-950 border border-carbon-800 hover:border-vermilion-500/40 cursor-pointer transition-colors has-[:checked]:border-vermilion-500 has-[:checked]:bg-vermilion-500/5">
                                    <input type="radio" 
                                           name="category" 
                                           value="laravel" 
                                           {{ old('category', $learningLogEntry->category) === 'laravel' ? 'checked' : '' }}
                                           class="mt-0.5 text-vermilion-500 bg-carbon-900 border-carbon-800 focus:ring-vermilion-500/20">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-mono text-xs font-bold text-white">Laravel Backend</span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-vermilion-400"></span>
                                        </div>
                                        <span class="text-[11px] font-mono text-slate-400 block mt-0.5">
                                            Membahas Eloquent, Form Requests, Sanctum, Queue, dan Service Container.
                                        </span>
                                    </div>
                                </label>

                                <!-- Cloud Engineering & DevOps -->
                                <label class="flex items-start gap-3 p-3.5 rounded-lg bg-carbon-950 border border-carbon-800 hover:border-cyan-500/40 cursor-pointer transition-colors has-[:checked]:border-cyan-500 has-[:checked]:bg-cyan-500/5">
                                    <input type="radio" 
                                           name="category" 
                                           value="cloud_engineering" 
                                           {{ old('category', $learningLogEntry->category) === 'cloud_engineering' ? 'checked' : '' }}
                                           class="mt-0.5 text-cyan-500 bg-carbon-900 border-carbon-800 focus:ring-cyan-500/20">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-mono text-xs font-bold text-white">Cloud &amp; DevOps</span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
                                        </div>
                                        <span class="text-[11px] font-mono text-slate-400 block mt-0.5">
                                            Membahas Docker multi-stage, Linux Server, CI/CD, Nginx, dan AWS.
                                        </span>
                                    </div>
                                </label>

                            </div>
                            <x-input-error :messages="$errors->get('category')" />
                        </div>

                        <!-- Tag Kesiapan (Production-Ready vs Exploring) -->
                        <div>
                            <x-input-label :value="__('Status Kesiapan / Tag *')" />
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-1.5">
                                
                                <!-- Production-Ready -->
                                <label class="flex items-start gap-3 p-3.5 rounded-lg bg-carbon-950 border border-carbon-800 hover:border-emerald-500/40 cursor-pointer transition-colors has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-500/5">
                                    <input type="radio" 
                                           name="tag" 
                                           value="production_ready" 
                                           {{ old('tag', $learningLogEntry->tag) === 'production_ready' ? 'checked' : '' }}
                                           class="mt-0.5 text-emerald-500 bg-carbon-900 border-carbon-800 focus:ring-emerald-500/20">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-mono text-xs font-bold text-white">Production-Ready</span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                        </div>
                                        <span class="text-[11px] font-mono text-slate-400 block mt-0.5">
                                            Solusi teruji dan siap diimplementasikan langsung ke lingkungan production.
                                        </span>
                                    </div>
                                </label>

                                <!-- Exploring -->
                                <label class="flex items-start gap-3 p-3.5 rounded-lg bg-carbon-950 border border-carbon-800 hover:border-amber-500/40 cursor-pointer transition-colors has-[:checked]:border-amber-500 has-[:checked]:bg-amber-500/5">
                                    <input type="radio" 
                                           name="tag" 
                                           value="exploring" 
                                           {{ old('tag', $learningLogEntry->tag) === 'exploring' ? 'checked' : '' }}
                                           class="mt-0.5 text-amber-500 bg-carbon-900 border-carbon-800 focus:ring-amber-500/20">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-mono text-xs font-bold text-white">Exploring</span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                        </div>
                                        <span class="text-[11px] font-mono text-slate-400 block mt-0.5">
                                            Eksperimen teknis, riset konsep, benchmark, atau pengujian arsitektur baru.
                                        </span>
                                    </div>
                                </label>

                            </div>
                            <x-input-error :messages="$errors->get('tag')" />
                        </div>

                    </div>
                </div>

                <!-- ─── CARD 3: Metadata Terbit & Keterhubungan Proyek ─────────────── -->
                <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-xl overflow-hidden">
                    <div class="px-6 py-4 bg-carbon-950/80 border-b border-carbon-800 flex items-center justify-between">
                        <span class="font-mono text-xs font-semibold text-white uppercase tracking-wider">
                            3 | Penerbitan &amp; Relasi Proyek Portofolio
                        </span>
                        <span class="text-[10px] font-mono text-slate-500">PUBLISHING_META</span>
                    </div>

                    <div class="p-6 space-y-5">
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Keterhubungan ke Featured Project -->
                            <div>
                                <x-input-label for="related_project_id" :value="__('Hubungkan ke Featured Project (Opsional)')" />
                                <select id="related_project_id" 
                                        name="related_project_id" 
                                        class="w-full bg-carbon-950 border border-carbon-800 text-slate-100 text-xs font-mono rounded-lg focus:border-vermilion-500 focus:ring-1 focus:ring-vermilion-500/30 transition-colors shadow-sm block p-2.5">
                                    <option value="">-- Tidak Terhubung ke Proyek Tertentu --</option>
                                    @foreach ($projects as $proj)
                                        <option value="{{ $proj->id }}" {{ old('related_project_id', $learningLogEntry->related_project_id) == $proj->id ? 'selected' : '' }}>
                                            #0{{ $proj->complexity_order }} &bull; {{ $proj->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="text-[11px] font-mono text-slate-500 mt-1">
                                    Menampilkan badge proyek portofolio terkait di header artikel catatan.
                                </p>
                                <x-input-error :messages="$errors->get('related_project_id')" />
                            </div>

                            <!-- Tanggal Publikasi -->
                            <div>
                                <x-input-label for="published_at" :value="__('Tanggal Publikasi')" />
                                <x-text-input id="published_at" 
                                              type="date" 
                                              name="published_at" 
                                              :value="old('published_at', optional($learningLogEntry->published_at)->format('Y-m-d'))" />
                                <p class="text-[11px] font-mono text-slate-500 mt-1">
                                    Tanggal yang tertera pada metadata artikel pembaca.
                                </p>
                                <x-input-error :messages="$errors->get('published_at')" />
                            </div>
                        </div>

                        <!-- Status Publikasi -->
                        <div>
                            <x-input-label :value="__('Status Publikasi *')" />
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-1.5">
                                
                                <!-- Published -->
                                <label class="flex items-start gap-3 p-3.5 rounded-lg bg-carbon-950 border border-carbon-800 hover:border-emerald-500/40 cursor-pointer transition-colors has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-500/5">
                                    <input type="radio" 
                                           name="status" 
                                           value="published" 
                                           {{ old('status', $learningLogEntry->status) === 'published' ? 'checked' : '' }}
                                           class="mt-0.5 text-emerald-500 bg-carbon-900 border-carbon-800 focus:ring-emerald-500/20">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-mono text-xs font-bold text-white">Published</span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                        </div>
                                        <span class="text-[11px] font-mono text-slate-400 block mt-0.5">
                                            Tayang di katalog publik (/notes) dan dapat dibaca oleh recruiter.
                                        </span>
                                    </div>
                                </label>

                                <!-- Draft -->
                                <label class="flex items-start gap-3 p-3.5 rounded-lg bg-carbon-950 border border-carbon-800 hover:border-carbon-700 cursor-pointer transition-colors has-[:checked]:border-carbon-600 has-[:checked]:bg-carbon-850">
                                    <input type="radio" 
                                           name="status" 
                                           value="draft" 
                                           {{ old('status', $learningLogEntry->status) === 'draft' ? 'checked' : '' }}
                                           class="mt-0.5 text-slate-400 bg-carbon-900 border-carbon-800 focus:ring-slate-500/20">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-mono text-xs font-bold text-white">Draft</span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span>
                                        </div>
                                        <span class="text-[11px] font-mono text-slate-400 block mt-0.5">
                                            Disimpan hanya di panel CMS admin tanpa akses publik.
                                        </span>
                                    </div>
                                </label>

                            </div>
                            <x-input-error :messages="$errors->get('status')" />
                        </div>

                    </div>
                </div>

                <!-- ─── CARD 4: Excerpt Cuplikan Singkat ───────────────────────────── -->
                <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-xl overflow-hidden">
                    <div class="px-6 py-4 bg-carbon-950/80 border-b border-carbon-800 flex items-center justify-between">
                        <div>
                            <span class="font-mono text-xs font-semibold text-white uppercase tracking-wider block">
                                4 | Ringkasan Cuplikan (Excerpt)
                            </span>
                            <span class="text-[11px] font-mono text-slate-400">
                                Ditampilkan pada card preview beranda dan katalog daftar catatan.
                            </span>
                        </div>
                        <span class="text-[10px] font-mono text-slate-500">OPSIONAL / AUTO-EXCERPT</span>
                    </div>

                    <div class="p-6">
                        <textarea id="content" 
                                  name="content" 
                                  rows="3" 
                                  placeholder="Tulis ringkasan singkat artikel dalam 1-2 kalimat..."
                                  class="w-full bg-carbon-950 border border-carbon-800 text-slate-100 text-xs font-sans rounded-lg focus:border-vermilion-500 focus:ring-1 focus:ring-vermilion-500/30 transition-colors shadow-sm block p-3 leading-relaxed">{{ old('content', $learningLogEntry->content) }}</textarea>
                        <x-input-error :messages="$errors->get('content')" />
                    </div>
                </div>

                <!-- ─── CARD 5: Editor Markdown Artikel Penuh ──────────────────────── -->
                <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-xl overflow-hidden">
                    <!-- Editor Toolbar Header -->
                    <div class="px-4 py-3 bg-carbon-950/90 border-b border-carbon-800 flex items-center justify-between flex-wrap gap-2">
                        <div class="flex items-center gap-1.5 flex-wrap">
                            <span class="font-mono text-xs font-semibold text-white uppercase tracking-wider mr-2 hidden sm:inline">
                                5 | Isi Artikel Penuh (Markdown)
                            </span>

                            <!-- Toolbar Quick Buttons -->
                            <button type="button" @click="insertMarkdown('h2', 'Sub-Judul')" class="px-2 py-1 rounded bg-carbon-900 hover:bg-carbon-800 text-slate-300 hover:text-white border border-carbon-800 text-xs font-mono transition-colors" title="Heading 2">
                                H2
                            </button>
                            <button type="button" @click="insertMarkdown('h3', 'Topik')" class="px-2 py-1 rounded bg-carbon-900 hover:bg-carbon-800 text-slate-300 hover:text-white border border-carbon-800 text-xs font-mono transition-colors" title="Heading 3">
                                H3
                            </button>
                            <button type="button" @click="insertMarkdown('bold', 'teks tebal')" class="px-2 py-1 rounded bg-carbon-900 hover:bg-carbon-800 text-slate-300 hover:text-white border border-carbon-800 text-xs font-mono font-bold transition-colors" title="Bold">
                                B
                            </button>
                            <button type="button" @click="insertMarkdown('code', '// PHP snippet code')" class="px-2 py-1 rounded bg-carbon-900 hover:bg-carbon-800 text-vermilion-400 hover:text-vermilion-300 border border-carbon-800 text-xs font-mono transition-colors" title="Code Block">
                                &lt;/&gt; Code
                            </button>
                            <button type="button" @click="insertMarkdown('list', 'Poin')" class="px-2 py-1 rounded bg-carbon-900 hover:bg-carbon-800 text-slate-300 hover:text-white border border-carbon-800 text-xs font-mono transition-colors" title="List Item">
                                &bull; List
                            </button>
                            <button type="button" @click="insertMarkdown('quote', 'Kutipan penting')" class="px-2 py-1 rounded bg-carbon-900 hover:bg-carbon-800 text-slate-300 hover:text-white border border-carbon-800 text-xs font-mono transition-colors" title="Blockquote">
                                &ldquo; Quote
                            </button>
                        </div>

                        <!-- Live Metrics Counter -->
                        <div class="flex items-center gap-3 font-mono text-[11px] text-slate-400">
                            <span><strong class="text-white" x-text="wordCount"></strong> kata</span>
                            <span class="text-slate-600">&bull;</span>
                            <span class="text-vermilion-400 font-semibold" x-text="readingTime"></span>
                        </div>
                    </div>

                    <div class="p-4 sm:p-6">
                        <textarea id="body" 
                                  name="body" 
                                  x-ref="bodyEditor"
                                  x-model="bodyText"
                                  @input="updateMetrics()"
                                  rows="18" 
                                  placeholder="# Judul Artikel&#10;&#10;Tuliskan penjelasan teknis Anda menggunakan format Markdown...&#10;&#10;## Mengapa Hal Ini Penting?&#10;&#10;Jelaskan konteks masalah dan solusinya...&#10;&#10;```php&#10;public function handle()&#10;{&#10;    // Kode implementasi&#10;}&#10;```"
                                  class="w-full bg-carbon-950 border border-carbon-800 text-slate-100 text-xs font-mono rounded-lg focus:border-vermilion-500 focus:ring-1 focus:ring-vermilion-500/30 transition-colors shadow-sm block p-4 leading-relaxed font-mono resize-y"></textarea>
                        <x-input-error :messages="$errors->get('body')" />
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-2">
                    <a href="{{ route('learning-log.index') }}" class="px-4 py-2 rounded-lg font-mono text-xs font-medium text-slate-400 hover:text-white transition-colors">
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
