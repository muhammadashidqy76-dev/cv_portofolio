<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 font-mono text-xs text-slate-400 mb-1">
                    <a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">Cms</a>
                    <span class="text-slate-600">/</span>
                    <a href="{{ route('journey.index') }}" class="hover:text-white transition-colors">Journey</a>
                    <span class="text-slate-600">/</span>
                    <span class="text-vermilion-400">Create</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold font-mono text-white tracking-tight">
                    Tambah Entri Journey &amp; Kredensial
                </h1>
            </div>

            <a href="{{ route('journey.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg font-mono text-xs text-slate-400 hover:text-white bg-carbon-900 hover:bg-carbon-850 border border-carbon-800 transition-colors">
                <span>Kembali ke Daftar</span>
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <form method="POST" action="{{ route('journey.store') }}" enctype="multipart/form-data" class="space-y-6"
                  x-data="{ credType: '{{ old('credential_type', 'course') }}' }">
                @csrf

                <!-- ─── CARD 1: Jenis Kredensial & Identitas Kursus ────────────────── -->
                <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-xl overflow-hidden">
                    <div class="px-6 py-4 bg-carbon-950/80 border-b border-carbon-800 flex items-center justify-between">
                        <span class="font-mono text-xs font-semibold text-white uppercase tracking-wider">
                            1 | Jenis Kredensial &amp; Platform Penerbit
                        </span>
                        <span class="text-[10px] font-mono text-slate-500">CREDENTIAL_PROPERTIES</span>
                    </div>

                    <div class="p-6 space-y-6">
                        
                        <!-- Pilihan Tipe Kredensial (Radio Cards) -->
                        <div>
                            <x-input-label :value="__('Jenis Kredensial *')" />
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mt-1.5">
                                
                                <!-- 1. Course -->
                                <label class="flex flex-col p-3.5 rounded-lg bg-carbon-950 border border-carbon-800 hover:border-sky-500/40 cursor-pointer transition-colors has-[:checked]:border-sky-500 has-[:checked]:bg-sky-500/5">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <input type="radio" 
                                               name="credential_type" 
                                               value="course" 
                                               x-model="credType"
                                               class="w-3.5 h-3.5 text-sky-500 bg-carbon-900 border-carbon-800 focus:ring-sky-500/20">
                                        <span class="w-2 h-2 rounded-full bg-sky-400"></span>
                                    </div>
                                    <span class="font-mono text-xs font-bold text-white">Course (Kursus)</span>
                                    <span class="text-[10px] text-slate-400 mt-0.5">Belajar mandiri (Laracasts, Udemy, dll)</span>
                                </label>

                                <!-- 2. Certification -->
                                <label class="flex flex-col p-3.5 rounded-lg bg-carbon-950 border border-carbon-800 hover:border-amber-500/40 cursor-pointer transition-colors has-[:checked]:border-amber-500 has-[:checked]:bg-amber-500/5">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <input type="radio" 
                                               name="credential_type" 
                                               value="certification" 
                                               x-model="credType"
                                               class="w-3.5 h-3.5 text-amber-500 bg-carbon-900 border-carbon-800 focus:ring-amber-500/20">
                                        <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                                    </div>
                                    <span class="font-mono text-xs font-bold text-white">Sertifikasi Profesi</span>
                                    <span class="text-[10px] text-slate-400 mt-0.5">Lembaga sertifikasi (BNSP, AWS, dll)</span>
                                </label>

                                <!-- 3. Diploma -->
                                <label class="flex flex-col p-3.5 rounded-lg bg-carbon-950 border border-carbon-800 hover:border-emerald-500/40 cursor-pointer transition-colors has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-500/5">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <input type="radio" 
                                               name="credential_type" 
                                               value="diploma" 
                                               x-model="credType"
                                               class="w-3.5 h-3.5 text-emerald-500 bg-carbon-900 border-carbon-800 focus:ring-emerald-500/20">
                                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                    </div>
                                    <span class="font-mono text-xs font-bold text-white">Ijazah / Gelar</span>
                                    <span class="text-[10px] text-slate-400 mt-0.5">Pendidikan tinggi / perguruan tinggi</span>
                                </label>

                            </div>
                            <x-input-error :messages="$errors->get('credential_type')" />
                        </div>

                        <!-- Nama Kursus / Sertifikasi -->
                        <div>
                            <x-input-label for="course_name" :value="__('Nama Kursus / Sertifikasi / Kredensial *')" />
                            <x-text-input id="course_name" 
                                          type="text" 
                                          name="course_name" 
                                          :value="old('course_name')" 
                                          required 
                                          autofocus 
                                          placeholder="mis. Mastering RESTful API Architecture &amp; Sanctum, Sertifikasi BNSP Web" />
                            <x-input-error :messages="$errors->get('course_name')" />
                        </div>

                        <!-- Grid Platform Penerbit & Tanggal Selesai -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Platform / Penerbit (source) -->
                            <div>
                                <x-input-label for="source" :value="__('Platform / Lembaga Penerbit')" />
                                <x-text-input id="source" 
                                              type="text" 
                                              name="source" 
                                              list="sources_list"
                                              :value="old('source')" 
                                              placeholder="mis. Laracasts, Udemy, BNSP, Dicoding" />
                                <datalist id="sources_list">
                                    <option value="Laracasts">
                                    <option value="Udemy">
                                    <option value="Badan Nasional Sertifikasi Profesi (BNSP)">
                                    <option value="LSP Telematika">
                                    <option value="Official Documentation">
                                    <option value="Coursera">
                                </datalist>
                                <x-input-error :messages="$errors->get('source')" />
                            </div>

                            <!-- Tanggal Selesai (completed_at) -->
                            <div>
                                <x-input-label for="completed_at" :value="__('Tanggal Selesai / Penerbitan')" />
                                <x-text-input id="completed_at" 
                                              type="date" 
                                              name="completed_at" 
                                              :value="old('completed_at')" />
                                <x-input-error :messages="$errors->get('completed_at')" />
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ─── CARD 2: Narasi 3-Langkah (Learned -> Applied -> Result) ────── -->
                <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-xl overflow-hidden">
                    <div class="px-6 py-4 bg-carbon-950/80 border-b border-carbon-800 flex items-center justify-between">
                        <div>
                            <span class="font-mono text-xs font-semibold text-white uppercase tracking-wider block">
                              2 | Narasi Pembelajaran (Learned &rarr; Applied &rarr; Result)
                            </span>
                            <span class="text-[11px] font-mono text-slate-400">
                                Menjelaskan proses pembelajaran hingga pembuktian hasil nyata di Featured Project.
                            </span>
                        </div>
                        <span class="text-[10px] font-mono text-vermilion-400 bg-vermilion-500/10 border border-vermilion-500/20 px-2 py-0.5 rounded">
                            PORTFOLIO_NARRATIVE
                        </span>
                    </div>

                    <div class="p-6 space-y-5">
                        
                        <!-- 1. Learned -->
                        <div>
                            <x-input-label for="learned" :value="__('1. Learned (Apa konsep yang dipelajari?)')" />
                            <p class="text-[11px] font-mono text-slate-400 mb-2">
                                Jelaskan konsep arsitektur, teknik backend, atau problem solving yang dikuasai.
                            </p>
                            <textarea id="learned" 
                                      name="learned" 
                                      rows="3" 
                                      placeholder="mis. Mempelajari penggunaan DB::transaction(), pessimistic locking (lockForUpdate), dan penanganan race condition pada query database."
                                      class="w-full bg-carbon-950 border border-carbon-800 text-slate-100 text-xs font-mono rounded-lg focus:border-vermilion-500 focus:ring-1 focus:ring-vermilion-500/30 transition-colors shadow-sm block p-3 leading-relaxed">{{ old('learned') }}</textarea>
                            <x-input-error :messages="$errors->get('learned')" />
                        </div>

                        <!-- 2. Applied Project -->
                        <div>
                            <x-input-label for="applied_project_id" :value="__('2. Applied (Diterapkan pada Featured Project yang mana?)')" />
                            <select id="applied_project_id" 
                                    name="applied_project_id" 
                                    class="w-full bg-carbon-950 border border-carbon-800 text-slate-100 text-xs font-mono rounded-lg focus:border-vermilion-500 focus:ring-1 focus:ring-vermilion-500/30 transition-colors shadow-sm block p-2.5">
                                <option value="">-- Tidak Terhubung ke Proyek Tertentu --</option>
                                @foreach ($projects as $proj)
                                    <option value="{{ $proj->id }}" {{ old('applied_project_id') == $proj->id ? 'selected' : '' }}>
                                        #0{{ $proj->complexity_order }} &bull; {{ $proj->title }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-[11px] font-mono text-slate-500 mt-1">
                                Menautkan bukti nyata proyek di mana Anda mempraktikkan ilmu dari kursus ini.
                            </p>
                            <x-input-error :messages="$errors->get('applied_project_id')" />
                        </div>

                        <!-- 3. Result / Impact -->
                        <div>
                            <x-input-label for="result" :value="__('3. Result / Impact (Apa hasil terukur yang dicapai?)')" />
                            <p class="text-[11px] font-mono text-slate-400 mb-2">
                                Hasil konkret atau metrik pencegahan masalah yang berhasil diselesaikan di proyek.
                            </p>
                            <textarea id="result" 
                                      name="result" 
                                      rows="3" 
                                      placeholder="mis. Mencegah terjadinya stok minus / overselling pada saat checkout produk e-commerce berkategori high demand."
                                      class="w-full bg-carbon-950 border border-carbon-800 text-slate-100 text-xs font-mono rounded-lg focus:border-vermilion-500 focus:ring-1 focus:ring-vermilion-500/30 transition-colors shadow-sm block p-3 leading-relaxed">{{ old('result') }}</textarea>
                            <x-input-error :messages="$errors->get('result')" />
                        </div>

                    </div>
                </div>

                <!-- ─── CARD 3: Dokumen & Verifikasi Kredensial ─────────────────────── -->
                <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-xl overflow-hidden">
                    <div class="px-6 py-4 bg-carbon-950/80 border-b border-carbon-800 flex items-center justify-between">
                        <span class="font-mono text-xs font-semibold text-white uppercase tracking-wider">
                            3 | Dokumen Sertifikat &amp; Tautan Verifikasi
                        </span>
                        <span class="text-[10px] font-mono text-slate-500">CREDENTIAL_PROOF</span>
                    </div>

                    <div class="p-6 space-y-5">
                        
                        <!-- Upload File Sertifikat -->
                        <div>
                            <x-input-label for="certificate_file" :value="__('Unggah Berkas Sertifikat / Ijazah (PDF / Gambar)')" />
                            <input id="certificate_file" 
                                   type="file" 
                                   name="certificate_file" 
                                   accept=".pdf,.jpg,.jpeg,.png"
                                   class="mt-1 block w-full text-xs font-mono text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-mono file:bg-carbon-950 file:text-slate-200 hover:file:bg-carbon-850 file:border file:border-carbon-800 cursor-pointer" />
                            <p class="text-[11px] font-mono text-slate-500 mt-1">
                                Format didukung: PDF, JPG, PNG (Maksimal 5MB). Otomatis disimpan ke folder storage publik.
                            </p>
                            <x-input-error :messages="$errors->get('certificate_file')" />
                        </div>

                        <!-- Atau Input Manual Path -->
                        <div>
                            <x-input-label for="certificate_file_path" :value="__('Atau Gunakan Path Berkas Manual (Opsional)')" />
                            <x-text-input id="certificate_file_path" 
                                          type="text" 
                                          name="certificate_file_path" 
                                          :value="old('certificate_file_path')" 
                                          placeholder="mis. certificates/sertifikat-bnsp-web.pdf" />
                            <x-input-error :messages="$errors->get('certificate_file_path')" />
                        </div>

                        <!-- Link Verifikasi Online -->
                        <div>
                            <x-input-label for="verification_url" :value="__('Tautan Verifikasi Online (URL Resmi Penerbit)')" />
                            <x-text-input id="verification_url" 
                                          type="url" 
                                          name="verification_url" 
                                          :value="old('verification_url')" 
                                          placeholder="https://bnsp.go.id/verifikasi/..." />
                            <p class="text-[11px] font-mono text-slate-500 mt-1">
                                Tautan resmi untuk melihat sertifikat digital atau memvalidasi kredensial.
                            </p>
                            <x-input-error :messages="$errors->get('verification_url')" />
                        </div>

                    </div>
                </div>

                <!-- ─── CARD 4: Urutan & Status Publikasi ───────────────────────────── -->
                <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-xl overflow-hidden">
                    <div class="px-6 py-4 bg-carbon-950/80 border-b border-carbon-800 flex items-center justify-between">
                        <span class="font-mono text-xs font-semibold text-white uppercase tracking-wider">
                            4 | Pengaturan Tampilan &amp; Status Publikasi
                        </span>
                        <span class="text-[10px] font-mono text-slate-500">CMS_PUBLISHING</span>
                    </div>

                    <div class="p-6 space-y-5">
                        
                        <!-- Display Order -->
                        <div>
                            <x-input-label for="display_order" :value="__('Urutan Tampilan (Display Order) *')" />
                            <x-text-input id="display_order" 
                                          type="number" 
                                          name="display_order" 
                                          :value="old('display_order', $nextOrder)" 
                                          min="0" 
                                          max="9999" 
                                          required />
                            <p class="text-[11px] font-mono text-slate-500 mt-1">
                                Urutan card di timeline Journey.
                            </p>
                            <x-input-error :messages="$errors->get('display_order')" />
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
                                           {{ old('status', 'published') === 'published' ? 'checked' : '' }}
                                           class="mt-0.5 text-emerald-500 bg-carbon-900 border-carbon-800 focus:ring-emerald-500/20">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-mono text-xs font-bold text-white">Published</span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                        </div>
                                        <span class="text-[11px] font-mono text-slate-400 block mt-0.5">
                                            Tampil di section Journey &amp; Kredensial publik website.
                                        </span>
                                    </div>
                                </label>

                                <!-- Draft -->
                                <label class="flex items-start gap-3 p-3.5 rounded-lg bg-carbon-950 border border-carbon-800 hover:border-carbon-700 cursor-pointer transition-colors has-[:checked]:border-carbon-600 has-[:checked]:bg-carbon-850">
                                    <input type="radio" 
                                           name="status" 
                                           value="draft" 
                                           {{ old('status') === 'draft' ? 'checked' : '' }}
                                           class="mt-0.5 text-slate-400 bg-carbon-900 border-carbon-800 focus:ring-slate-500/20">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-mono text-xs font-bold text-white">Draft</span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span>
                                        </div>
                                        <span class="text-[11px] font-mono text-slate-400 block mt-0.5">
                                            Simpan sementara di database tanpa menampilkannya ke publik.
                                        </span>
                                    </div>
                                </label>

                            </div>
                            <x-input-error :messages="$errors->get('status')" />
                        </div>

                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-2">
                    <a href="{{ route('journey.index') }}" class="px-4 py-2 rounded-lg font-mono text-xs font-medium text-slate-400 hover:text-white transition-colors">
                        Batal &amp; Kembali
                    </a>

                    <x-primary-button>
                        {{ __('Simpan Entri Journey') }}
                    </x-primary-button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>
