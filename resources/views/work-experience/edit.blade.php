<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 font-mono text-xs text-slate-400 mb-1">
                    <a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">Cms</a>
                    <span class="text-slate-600">/</span>
                    <a href="{{ route('work-experience.index') }}" class="hover:text-white transition-colors">Work-Experience</a>
                    <span class="text-slate-600">/</span>
                    <span class="text-vermilion-400">Edit</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold font-mono text-white tracking-tight">
                    Edit Pengalaman: <span class="text-vermilion-400">{{ $workExperience->position }}</span>
                </h1>
            </div>

            <a href="{{ route('work-experience.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg font-mono text-xs text-slate-400 hover:text-white bg-carbon-900 hover:bg-carbon-850 border border-carbon-800 transition-colors">
                <span>Kembali ke Daftar</span>
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <form method="POST" action="{{ route('work-experience.update', $workExperience) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- ─── CARD 1: Informasi Pokok Posisi & Perusahaan ────────────────── -->
                <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-xl overflow-hidden">
                    <div class="px-6 py-4 bg-carbon-950/80 border-b border-carbon-800 flex items-center justify-between">
                        <span class="font-mono text-xs font-semibold text-white uppercase tracking-wider">
                            1 | Informasi Posisi &amp; Perusahaan
                        </span>
                        <span class="text-[10px] font-mono text-slate-500">ID: #{{ $workExperience->id }}</span>
                    </div>

                    <div class="p-6 space-y-6">
                        
                        <!-- Grid Perusahaan & Posisi -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Posisi -->
                            <div>
                                <x-input-label for="position" :value="__('Posisi / Jabatan *')" />
                                <x-text-input id="position" 
                                              type="text" 
                                              name="position" 
                                              :value="old('position', $workExperience->position)" 
                                              required 
                                              placeholder="mis. Backend Developer Intern, Junior Software Engineer" />
                                <x-input-error :messages="$errors->get('position')" />
                            </div>

                            <!-- Nama Perusahaan -->
                            <div>
                                <x-input-label for="company_name" :value="__('Nama Perusahaan / Institusi *')" />
                                <x-text-input id="company_name" 
                                              type="text" 
                                              name="company_name" 
                                              :value="old('company_name', $workExperience->company_name)" 
                                              required 
                                              placeholder="mis. PT Teknologi Inovasi Nusantara" />
                                <x-input-error :messages="$errors->get('company_name')" />
                            </div>
                        </div>

                        <!-- Tipe Pekerjaan (Employment Type) -->
                        <div>
                            <x-input-label :value="__('Tipe Pekerjaan (Employment Type) *')" />
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-1.5">
                                
                                <!-- 1. Internship -->
                                <label class="flex flex-col p-3 rounded-lg bg-carbon-950 border border-carbon-800 hover:border-sky-500/40 cursor-pointer transition-colors has-[:checked]:border-sky-500 has-[:checked]:bg-sky-500/5">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <input type="radio" 
                                               name="employment_type" 
                                               value="internship" 
                                               {{ old('employment_type', $workExperience->employment_type) === 'internship' ? 'checked' : '' }}
                                               class="w-3.5 h-3.5 text-sky-500 bg-carbon-900 border-carbon-800 focus:ring-sky-500/20">
                                        <span class="w-2 h-2 rounded-full bg-sky-400"></span>
                                    </div>
                                    <span class="font-mono text-xs font-bold text-white">Internship</span>
                                    <span class="text-[10px] text-slate-400 mt-0.5">Magang industri</span>
                                </label>

                                <!-- 2. Full-time -->
                                <label class="flex flex-col p-3 rounded-lg bg-carbon-950 border border-carbon-800 hover:border-emerald-500/40 cursor-pointer transition-colors has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-500/5">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <input type="radio" 
                                               name="employment_type" 
                                               value="full_time" 
                                               {{ old('employment_type', $workExperience->employment_type) === 'full_time' ? 'checked' : '' }}
                                               class="w-3.5 h-3.5 text-emerald-500 bg-carbon-900 border-carbon-800 focus:ring-emerald-500/20">
                                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                    </div>
                                    <span class="font-mono text-xs font-bold text-white">Full-time</span>
                                    <span class="text-[10px] text-slate-400 mt-0.5">Purna waktu</span>
                                </label>

                                <!-- 3. Part-time -->
                                <label class="flex flex-col p-3 rounded-lg bg-carbon-950 border border-carbon-800 hover:border-amber-500/40 cursor-pointer transition-colors has-[:checked]:border-amber-500 has-[:checked]:bg-amber-500/5">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <input type="radio" 
                                               name="employment_type" 
                                               value="part_time" 
                                               {{ old('employment_type', $workExperience->employment_type) === 'part_time' ? 'checked' : '' }}
                                               class="w-3.5 h-3.5 text-amber-500 bg-carbon-900 border-carbon-800 focus:ring-amber-500/20">
                                        <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                                    </div>
                                    <span class="font-mono text-xs font-bold text-white">Part-time</span>
                                    <span class="text-[10px] text-slate-400 mt-0.5">Paruh waktu</span>
                                </label>

                                <!-- 4. Freelance -->
                                <label class="flex flex-col p-3 rounded-lg bg-carbon-950 border border-carbon-800 hover:border-purple-500/40 cursor-pointer transition-colors has-[:checked]:border-purple-500 has-[:checked]:bg-purple-500/5">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <input type="radio" 
                                               name="employment_type" 
                                               value="freelance" 
                                               {{ old('employment_type', $workExperience->employment_type) === 'freelance' ? 'checked' : '' }}
                                               class="w-3.5 h-3.5 text-purple-500 bg-carbon-900 border-carbon-800 focus:ring-purple-500/20">
                                        <span class="w-2 h-2 rounded-full bg-purple-400"></span>
                                    </div>
                                    <span class="font-mono text-xs font-bold text-white">Freelance</span>
                                    <span class="text-[10px] text-slate-400 mt-0.5">Proyek mandiri / kontrak</span>
                                </label>

                            </div>
                            <x-input-error :messages="$errors->get('employment_type')" />
                        </div>

                        <!-- Lokasi Kerja -->
                        <div>
                            <x-input-label for="location" :value="__('Lokasi Kerja (Opsional)')" />
                            <x-text-input id="location" 
                                          type="text" 
                                          name="location" 
                                          :value="old('location', $workExperience->location)" 
                                          placeholder="mis. Remote, Jakarta (Hybrid), Bandung" />
                            <x-input-error :messages="$errors->get('location')" />
                        </div>

                    </div>
                </div>

                <!-- ─── CARD 2: Periode Waktu & Durasi Kerja ────────────────────────── -->
                <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-xl overflow-hidden"
                     x-data="{ isCurrent: {{ old('is_current', $workExperience->is_current) ? 'true' : 'false' }} }">
                    <div class="px-6 py-4 bg-carbon-950/80 border-b border-carbon-800 flex items-center justify-between">
                        <span class="font-mono text-xs font-semibold text-white uppercase tracking-wider">
                           2 | Periode Waktu &amp; Status Kerja
                        </span>
                        <span class="text-[10px] font-mono text-slate-500">TIMELINE_SPAN</span>
                    </div>

                    <div class="p-6 space-y-5">
                        
                        <!-- Checkbox Masih Bekerja (is_current) -->
                        <div class="p-3.5 rounded-lg bg-carbon-950 border border-carbon-800">
                            <label class="flex items-center gap-3 cursor-pointer select-none">
                                <input type="checkbox" 
                                       name="is_current" 
                                       value="1" 
                                       x-model="isCurrent"
                                       class="rounded bg-carbon-900 border-carbon-700 text-emerald-500 focus:ring-emerald-500/20 w-4 h-4">
                                <div>
                                    <span class="font-mono text-xs font-semibold text-white block">
                                        Masih aktif bekerja di sini saat ini (Present)
                                    </span>
                                    <span class="text-[11px] font-mono text-slate-400 block mt-0.5">
                                        Otomatis menandai durasi sebagai "[Bulan Mulai] - Present" di portfolio.
                                    </span>
                                </div>
                            </label>
                        </div>

                        <!-- Grid Tanggal Mulai & Selesai -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Start Date -->
                            <div>
                                <x-input-label for="start_date" :value="__('Tanggal Mulai Bekerja *')" />
                                <x-text-input id="start_date" 
                                              type="date" 
                                              name="start_date" 
                                              :value="old('start_date', optional($workExperience->start_date)->format('Y-m-d'))" 
                                              required />
                                <x-input-error :messages="$errors->get('start_date')" />
                            </div>

                            <!-- End Date (Conditional via Alpine.js) -->
                            <div x-show="!isCurrent" x-cloak>
                                <x-input-label for="end_date" :value="__('Tanggal Selesai Bekerja *')" />
                                <x-text-input id="end_date" 
                                              type="date" 
                                              name="end_date" 
                                              :value="old('end_date', optional($workExperience->end_date)->format('Y-m-d'))" 
                                              ::required="!isCurrent" />
                                <x-input-error :messages="$errors->get('end_date')" />
                            </div>

                            <div x-show="isCurrent" class="flex items-center gap-2 p-3 rounded-lg bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-mono">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                <span>Posisi ini aktif berjalan hingga saat ini (Present).</span>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ─── CARD 3: Deskripsi & Poin Pencapaian ────────────────────────── -->
                <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-xl overflow-hidden">
                    <div class="px-6 py-4 bg-carbon-950/80 border-b border-carbon-800 flex items-center justify-between">
                        <span class="font-mono text-xs font-semibold text-white uppercase tracking-wider">
                          3 | Tanggung Jawab &amp; Poin Pencapaian
                        </span>
                        <span class="text-[10px] font-mono text-slate-500">ACHIEVEMENT_POINTS</span>
                    </div>

                    <div class="p-6 space-y-4">
                        <div>
                            <x-input-label for="description" :value="__('Deskripsi Tugas &amp; Dampak Posisi')" />
                            <p class="text-[11px] font-mono text-slate-400 mb-2">
                                Tuliskan tanggung jawab utama dan teknologi yang diterapkan. Mendukung baris baru / bullet points.
                            </p>
                            <textarea id="description" 
                                      name="description" 
                                      rows="5" 
                                      placeholder="Contoh:&#10;• Mengembangkan RESTful API modul pembayaran menggunakan Laravel Sanctum.&#10;• Mengoptimalkan query Eloquent dengan eager loading, mengurangi response time hingga 35%.&#10;• Berkolaborasi dalam tim agile dan melakukan code review berkala."
                                      class="w-full bg-carbon-950 border border-carbon-800 text-slate-100 text-xs font-mono rounded-lg focus:border-vermilion-500 focus:ring-1 focus:ring-vermilion-500/30 transition-colors shadow-sm block p-3 leading-relaxed">{{ old('description', $workExperience->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" />
                        </div>
                    </div>
                </div>

                <!-- ─── CARD 4: Pengaturan Tampilan & Publikasi ─────────────────────── -->
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
                                          :value="old('display_order', $workExperience->display_order)" 
                                          min="0" 
                                          max="9999" 
                                          required />
                            <p class="text-[11px] font-mono text-slate-500 mt-1">
                                Semakin kecil angkanya, semakin awal muncul jika berada pada periode waktu yang sama.
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
                                           {{ old('status', $workExperience->status) === 'published' ? 'checked' : '' }}
                                           class="mt-0.5 text-emerald-500 bg-carbon-900 border-carbon-800 focus:ring-emerald-500/20">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-mono text-xs font-bold text-white">Published</span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                        </div>
                                        <span class="text-[11px] font-mono text-slate-400 block mt-0.5">
                                            Tampil langsung di section Work Experience publik website.
                                        </span>
                                    </div>
                                </label>

                                <!-- Draft -->
                                <label class="flex items-start gap-3 p-3.5 rounded-lg bg-carbon-950 border border-carbon-800 hover:border-carbon-700 cursor-pointer transition-colors has-[:checked]:border-carbon-600 has-[:checked]:bg-carbon-850">
                                    <input type="radio" 
                                           name="status" 
                                           value="draft" 
                                           {{ old('status', $workExperience->status) === 'draft' ? 'checked' : '' }}
                                           class="mt-0.5 text-slate-400 bg-carbon-900 border-carbon-800 focus:ring-slate-500/20">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-mono text-xs font-bold text-white">Draft</span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span>
                                        </div>
                                        <span class="text-[11px] font-mono text-slate-400 block mt-0.5">
                                            Simpan di database tanpa menampilkannya ke pengunjung publik.
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
                    <a href="{{ route('work-experience.index') }}" class="px-4 py-2 rounded-lg font-mono text-xs font-medium text-slate-400 hover:text-white transition-colors">
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
