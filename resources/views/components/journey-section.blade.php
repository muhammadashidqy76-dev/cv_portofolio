@props(['journeyEntries' => null])

@php
    $items = $journeyEntries;

    if ($items === null && class_exists(\App\Models\JourneyEntry::class)) {
        $items = \App\Models\JourneyEntry::published()->with('appliedProject')->chronological()->get();
    }

    if (!$items || $items->isEmpty()) {
        $items = collect([
            (object)[
                'course_name' => 'Laravel Database Transactions & Concurrency Handling',
                'credential_type' => 'course',
                'source' => 'Laracasts',
                'has_narrative' => true,
                'learned' => 'Mempelajari penggunaan DB::transaction(), pessimistic locking (lockForUpdate), dan mitigasi race condition pada query database.',
                'appliedProject' => (object)['title' => 'StockGuard — E-Commerce Checkout Engine'],
                'result' => 'Mencegah terjadinya stok minus / overselling pada saat checkout produk e-commerce berkategori high demand.',
                'certificate_file_path' => null,
                'verification_url' => null,
                'completed_at' => \Carbon\Carbon::parse('2026-02-15'),
            ],
            (object)[
                'course_name' => 'Mastering RESTful API Architecture & Sanctum Authentication',
                'credential_type' => 'course',
                'source' => 'Udemy',
                'has_narrative' => true,
                'learned' => 'Mempelajari standar desain RESTful API, Eloquent API Resources, JWT/Sanctum bearer token authentication, dan rate-limiting middleware.',
                'appliedProject' => (object)['title' => 'OrderSync API — Multi-Channel Order Aggregator'],
                'result' => 'Membangun API headless backend modular dengan struktur respon JSON standar (data, meta, error handling) dan proteksi endpoint terautentikasi.',
                'certificate_file_path' => null,
                'verification_url' => null,
                'completed_at' => \Carbon\Carbon::parse('2026-05-10'),
            ],
            (object)[
                'course_name' => 'Sertifikasi BNSP Pemrograman Web (Junior Web Developer)',
                'credential_type' => 'certification',
                'source' => 'Badan Nasional Sertifikasi Profesi (BNSP)',
                'has_narrative' => false,
                'learned' => null,
                'appliedProject' => null,
                'result' => null,
                'certificate_file_path' => 'certificates/sertifikat-bnsp-web.pdf',
                'verification_url' => 'https://bnsp.go.id',
                'completed_at' => \Carbon\Carbon::parse('2026-06-12'),
            ],
            (object)[
                'course_name' => 'Laravel Breeze Scaffolding & Dynamic CMS Data Architecture',
                'credential_type' => 'course',
                'source' => 'Official Documentation',
                'has_narrative' => true,
                'learned' => 'Mempelajari otentikasi Breeze, pengelolaan relasi Eloquent komplek, scope query (scopePublished), serta penanganan data-driven content.',
                'appliedProject' => (object)['title' => 'Modular Portfolio CMS'],
                'result' => 'Mengubah situs portfolio statis menjadi CMS berbasis database yang fleksibel untuk manajemen konten jangka panjang.',
                'certificate_file_path' => null,
                'verification_url' => null,
                'completed_at' => \Carbon\Carbon::parse('2026-08-20'),
            ],
        ]);
    }
@endphp

<section id="journey" class="relative bg-[#0b0f19] text-slate-100 pt-8 pb-12 lg:pt-10 lg:pb-16 overflow-hidden border-t border-slate-800/60">
    <!-- Ambient Background Lighting -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-red-600/5 rounded-full blur-[100px] pointer-events-none -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-500/5 rounded-full blur-[100px] pointer-events-none translate-y-1/2 -translate-x-1/3"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- ─── Section Header ─── -->
        <div class="mb-10 max-w-2xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 border border-slate-800 text-xs font-mono text-slate-400 mb-4">
                <span class="w-2 h-2 rounded-full bg-red-400 animate-pulse"></span>
                <span>Section 01 &bull; Learning Journey &amp; Credentials</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white leading-tight tracking-tight">
                Timeline Pembelajaran &amp; Kredensial
            </h2>
            <p class="mt-2 text-sm sm:text-base text-slate-400 leading-relaxed">
                Pengganti pengalaman kerja formal &mdash; pembuktian kompetensi melalui siklus belajar terstruktur, sertifikasi resmi, aplikasi project nyata, dan hasil terukur.
            </p>
        </div>

        <!-- ─── Collapsible Accordion Wrapper (Alpine.js) ─── -->
        <div x-data="{ open: false }" class="w-full">

            <!-- Accordion Trigger Button -->
            <button type="button"
                    @click="open = !open"
                    class="w-full flex items-center justify-between p-4 sm:p-5 rounded-xl bg-[#0f1422]/90 border border-slate-800/80 hover:border-slate-700/80 transition-all duration-200 group text-left cursor-pointer focus:outline-none focus:ring-2 focus:ring-red-500/40">
                <div class="flex items-center gap-4 sm:gap-5 min-w-0 pr-4">
                    <div class="w-10 h-10 shrink-0 rounded-lg bg-red-500/10 border border-red-500/20 flex items-center justify-center text-red-400 group-hover:scale-105 transition-transform">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div class="flex flex-col gap-1 min-w-0">
                        <span class="text-sm sm:text-base font-bold text-white block group-hover:text-red-400 transition-colors truncate">
                            Timeline &amp; Credential History
                        </span>
                        <span class="text-xs text-slate-400 leading-normal">
                            <span x-text="open ? 'Sembunyikan detail timeline' : 'Tampilkan {{ count($items) }} riwayat pembelajaran & kredensial'"></span>
                        </span>
                    </div>
                </div>

                <div class="flex items-center gap-3 shrink-0">
                    <span class="font-mono text-xs text-rose-300/80 bg-slate-800/60 border border-slate-700/50 px-2.5 py-1 rounded-md">
                        {{ count($items) }} {{ count($items) > 1 ? 'entries' : 'entry' }}
                    </span>
                    <span class="p-1.5 rounded-lg bg-slate-800/80 text-slate-400 group-hover:text-white transition-colors">
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </div>
            </button>

            <!-- Collapsible Content (3-Column Grid Layout) -->
            <div x-show="open"
                 x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($items as $entry)
                    @php
                        $completedDate = null;
                        if (!empty($entry->completed_at)) {
                            $completedDate = is_string($entry->completed_at)
                                ? \Carbon\Carbon::parse($entry->completed_at)->format('M Y')
                                : $entry->completed_at->format('M Y');
                        }

                        $credentialType = $entry->credential_type ?? 'course';
                        $typeLabel = match($credentialType) {
                            'certification' => 'Certification',
                            'diploma' => 'Diploma',
                            default => 'Course',
                        };
                        $typeBadgeClass = match($credentialType) {
                            'certification' => 'text-amber-400 bg-amber-500/10 border-amber-500/20',
                            'diploma' => 'text-emerald-400 bg-emerald-500/10 border-emerald-500/20',
                            default => 'text-sky-400 bg-sky-500/10 border-sky-500/20',
                        };
                        $iconBoxClass = match($credentialType) {
                            'certification' => 'bg-amber-500/10 border-amber-500/20 text-amber-400',
                            'diploma' => 'bg-emerald-500/10 border-emerald-500/20 text-emerald-400',
                            default => 'bg-sky-500/10 border-sky-500/20 text-sky-400',
                        };
                    @endphp

                    <!-- Window Mockup Card for Journey Entry (Uniform 3-Column Card) -->
                    <article class="group flex flex-col justify-between rounded-xl bg-slate-900/70 border border-slate-800 hover:border-slate-700/80 transition-all duration-200 hover:-translate-y-0.5 overflow-hidden h-full">
                        
                        <div>
                            <!-- Window Mockup Header Bar (3 colored dots & badges) -->
                            <div class="flex items-center justify-between px-4 py-3 bg-slate-900 border-b border-slate-800/60 gap-2">
                                <div class="flex items-center gap-2">
                                    <div class="flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-rose-500/70"></span>
                                        <span class="w-2 h-2 rounded-full bg-amber-400/70"></span>
                                        <span class="w-2 h-2 rounded-full bg-emerald-400/70"></span>
                                    </div>
                                    <span class="font-mono text-[10px] font-semibold uppercase px-2 py-0.5 rounded border {{ $typeBadgeClass }}">
                                        {{ $typeLabel }}
                                    </span>
                                </div>
                                
                                @if($completedDate)
                                    <span class="font-mono text-[10px] text-rose-300/80 bg-red-500/10 border border-red-500/20 px-2 py-0.5 rounded shrink-0">
                                        {{ $completedDate }}
                                    </span>
                                @endif
                            </div>

                            <!-- Card Body -->
                            <div class="p-5 flex flex-col gap-3.5">
                                <!-- Course / Credential Title -->
                                <h3 class="text-[15px] font-bold text-white group-hover:text-red-400 transition-colors leading-snug">
                                    {{ $entry->course_name }}
                                </h3>

                                <!-- Issuer / Provider Info Pill -->
                                <div class="flex items-center gap-3 p-3 rounded-lg bg-[#080d14] border border-slate-800/80">
                                    @php
                                        $logoUrl = is_object($entry) && isset($entry->issuer_logo)
                                            ? $entry->issuer_logo
                                            : asset('images/issuer-logos/' . match(strtolower(trim($entry->source ?? ''))) {
                                                'laracasts' => 'laracasts.svg',
                                                'udemy' => 'udemy.svg',
                                                'bnsp', 'badan nasional sertifikasi profesi (bnsp)', 'badan nasional sertifikasi profesi' => 'bnsp.svg',
                                                default => 'default.svg'
                                            });
                                    @endphp
                                    <div class="w-8 h-8 shrink-0 rounded-lg bg-slate-950 border border-slate-800/80 flex items-center justify-center p-1.5 overflow-hidden">
                                        <img src="{{ $logoUrl }}"
                                             alt="{{ $entry->source ?? 'Issuer' }}"
                                             class="w-full h-full object-contain"
                                             loading="lazy" />
                                    </div>
                                    <div class="flex flex-col min-w-0">
                                        <span class="text-xs font-semibold text-slate-200 truncate">
                                            {{ $entry->source ?: 'Official Learning Provider' }}
                                        </span>
                                        <span class="text-[10px] text-slate-400 truncate">
                                            @if($credentialType === 'certification')
                                                Sertifikasi Profesi
                                            @elseif($credentialType === 'diploma')
                                                Kredensial Akademik
                                            @else
                                                Self-Directed Course
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer / Actions -->
                        @if(!empty($entry->certificate_file_path) || !empty($entry->verification_url))
                            <div class="px-5 pb-5 pt-0 mt-auto flex items-center justify-between gap-2 border-t border-slate-800/60 pt-3.5 flex-wrap">
                                @if(!empty($entry->certificate_file_path))
                                    <a href="{{ asset($entry->certificate_file_path) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-medium text-slate-300 bg-slate-900 border border-slate-800 hover:border-slate-700 hover:text-white transition-colors">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        <span>Dokumen</span>
                                    </a>
                                @endif

                                @if(!empty($entry->verification_url))
                                    <a href="{{ $entry->verification_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-semibold text-red-400 bg-red-500/10 border border-red-500/20 hover:bg-red-500/20 hover:text-red-300 transition-colors ml-auto">
                                        <span>Verifikasi</span>
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        @endif

                    </article>
                @endforeach

            </div>

            </div>
        </div>

    </div>
</section>
