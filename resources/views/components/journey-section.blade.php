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
                'learned' => 'Mempelajari standar desain RESTful API, Eloquent API Resources, JWT/Sanctum bearer token authentication, dan rate-limiting middleware.',
                'appliedProject' => (object)['title' => 'OrderSync API — Multi-Channel Order Aggregator'],
                'result' => 'Membangun API headless backend modular dengan struktur respon JSON standar (data, meta, error handling) dan proteksi endpoint terautentikasi.',
                'certificate_file_path' => null,
                'verification_url' => null,
                'completed_at' => \Carbon\Carbon::parse('2026-05-10'),
            ],
            (object)[
                'course_name' => 'Laravel Breeze Scaffolding & Dynamic CMS Data Architecture',
                'credential_type' => 'course',
                'source' => 'Official Documentation',
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

<section id="journey" class="relative bg-[#0b0f19] text-slate-100 py-20 lg:py-28 overflow-hidden border-t border-slate-800/60">
    <!-- Ambient Background Lighting -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-red-600/5 rounded-full blur-[100px] pointer-events-none -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-500/5 rounded-full blur-[100px] pointer-events-none translate-y-1/2 -translate-x-1/3"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- ─── Section Header ─── -->
        <div class="mb-12 max-w-2xl">
            <span class="inline-flex items-center gap-1.5 text-[11px] font-semibold uppercase tracking-widest text-red-400 mb-3">
                <span class="w-4 h-px bg-red-400/80 rounded"></span>
                Learning Journey &amp; Credentials
            </span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white leading-tight tracking-tight">
                Timeline Pembelajaran &amp; Kredensial
            </h2>
            <p class="mt-3 text-slate-400 text-sm leading-relaxed">
                Pengganti pengalaman kerja formal &mdash; pembuktian kemampuan melalui siklus belajar terstruktur (learned &rarr; applied &rarr; result) serta sertifikasi kompetensi terverifikasi.
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

            <!-- Collapsible Content -->
            <div x-show="open"
                 x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 class="mt-8 space-y-6">

                @foreach($items as $entry)
                    @php
                        $completedDate = null;
                        if (!empty($entry->completed_at)) {
                            $completedDate = is_string($entry->completed_at)
                                ? \Carbon\Carbon::parse($entry->completed_at)->format('M Y')
                                : $entry->completed_at->format('M Y');
                        }
                        $appliedProjectName = is_object($entry->appliedProject)
                            ? $entry->appliedProject->title
                            : null;
                        $credentialType = $entry->credential_type ?? 'course';
                    @endphp

                    <!-- Window Mockup Card for Journey / Credential Entry -->
                    <article class="group flex flex-col rounded-xl bg-slate-900/70 border border-slate-800 hover:border-slate-700/80 transition-all duration-200 hover:-translate-y-0.5 overflow-hidden">
                        
                        <!-- Window Mockup Header Bar (3 colored dots + tags) -->
                        <div class="flex items-center justify-between px-4 py-3 bg-slate-900 border-b border-slate-800/60">
                            <div class="flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-rose-500/70"></span>
                                <span class="w-2 h-2 rounded-full bg-amber-400/70"></span>
                                <span class="w-2 h-2 rounded-full bg-emerald-400/70"></span>
                            </div>
                            
                            <div class="flex items-center gap-2 flex-wrap justify-end">
                                @if($credentialType === 'certification')
                                    <span class="font-mono text-[10px] font-semibold text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2.5 py-0.5 rounded">
                                        Certification
                                    </span>
                                @elseif($credentialType === 'diploma')
                                    <span class="font-mono text-[10px] font-semibold text-indigo-400 bg-indigo-500/10 border border-indigo-500/20 px-2.5 py-0.5 rounded">
                                        Diploma
                                    </span>
                                @else
                                    <span class="font-mono text-[10px] font-semibold text-sky-400 bg-sky-500/10 border border-sky-500/20 px-2.5 py-0.5 rounded">
                                        Course
                                    </span>
                                @endif

                                @if(!empty($entry->source))
                                    <span class="font-mono text-[10px] text-slate-400 bg-slate-950/60 px-2.5 py-0.5 rounded border border-slate-800 truncate max-w-[180px]">
                                        {{ $entry->source }}
                                    </span>
                                @endif
                                @if($completedDate)
                                    <span class="font-mono text-[10px] text-rose-300/80 bg-red-500/10 border border-red-500/20 px-2.5 py-0.5 rounded">
                                        {{ $completedDate }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 flex flex-col gap-4">
                            <!-- Course / Credential Title -->
                            <h3 class="text-base font-bold text-white group-hover:text-red-400 transition-colors leading-snug">
                                {{ $entry->course_name }}
                            </h3>

                            @if($credentialType === 'course')
                                <!-- Structured 3-Pillar List (Learned -> Applied -> Result) -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-3.5 pt-1">
                                    
                                    <!-- Pillar 1: Learned -->
                                    <div class="flex flex-col p-4 rounded-lg bg-[#080d14] border border-slate-800/80 gap-2.5">
                                        <div class="flex items-center gap-2">
                                            <span class="text-[10px] font-mono font-bold uppercase text-sky-400 bg-sky-500/10 border border-sky-500/20 px-2 py-0.5 rounded">
                                                1. Learned
                                            </span>
                                        </div>
                                        <p class="text-xs text-slate-300 leading-relaxed">
                                            {{ $entry->learned }}
                                        </p>
                                    </div>

                                    <!-- Pillar 2: Applied -->
                                    <div class="flex flex-col p-4 rounded-lg bg-[#080d14] border border-slate-800/80 gap-2.5">
                                        <div class="flex items-center gap-2">
                                            <span class="text-[10px] font-mono font-bold uppercase text-amber-400 bg-amber-500/10 border border-amber-500/20 px-2 py-0.5 rounded">
                                                2. Applied
                                            </span>
                                        </div>
                                        <p class="text-xs text-slate-300 leading-relaxed">
                                            @if($appliedProjectName)
                                                Diimplementasikan pada <span class="font-semibold text-white">{{ $appliedProjectName }}</span>
                                            @else
                                                Diaplikasikan langsung pada eksperimen fitur backend.
                                            @endif
                                        </p>
                                    </div>

                                    <!-- Pillar 3: Result -->
                                    <div class="flex flex-col p-4 rounded-lg bg-[#080d14] border border-slate-800/80 gap-2.5">
                                        <div class="flex items-center gap-2">
                                            <span class="text-[10px] font-mono font-bold uppercase text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2 py-0.5 rounded">
                                                3. Result
                                            </span>
                                        </div>
                                        <p class="text-xs text-slate-300 leading-relaxed">
                                            {{ $entry->result }}
                                        </p>
                                    </div>

                                </div>
                            @else
                                <!-- Compact Credential Details (Certification / Diploma) -->
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-1 p-4 rounded-lg bg-[#080d14] border border-slate-800/80">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-lg {{ $credentialType === 'certification' ? 'bg-emerald-500/10 border-emerald-500/20 text-emerald-400' : 'bg-indigo-500/10 border-indigo-500/20 text-indigo-400' }} border flex items-center justify-center shrink-0">
                                            @if($credentialType === 'certification')
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-xs font-semibold text-slate-200">
                                                {{ $credentialType === 'certification' ? 'Sertifikasi Terverifikasi' : 'Ijazah / Kredensial Akademik' }}
                                            </span>
                                            <span class="text-[11px] text-slate-400 font-mono">
                                                {{ $entry->source ?? 'Institusi Terakreditasi' }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2 flex-wrap">
                                        @if(!empty($entry->certificate_file_path))
                                            <a href="{{ asset($entry->certificate_file_path) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-200 bg-slate-800 hover:bg-slate-700 hover:text-white px-3 py-1.5 rounded-lg border border-slate-700 transition-colors">
                                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                <span>Lihat Dokumen</span>
                                            </a>
                                        @endif

                                        @if(!empty($entry->verification_url))
                                            <a href="{{ $entry->verification_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs font-medium text-red-400 hover:text-red-300 bg-red-500/10 hover:bg-red-500/20 px-3 py-1.5 rounded-lg border border-red-500/20 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                </svg>
                                                <span>Verifikasi Kredensial</span>
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                @if(!empty($entry->learned) || !empty($entry->result))
                                    <!-- Optional Narrative for Cert/Diploma if filled -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5 pt-1">
                                        @if(!empty($entry->learned))
                                            <div class="flex flex-col p-3.5 rounded-lg bg-[#080d14] border border-slate-800/80 gap-1.5">
                                                <span class="text-[10px] font-mono font-bold uppercase text-sky-400">Kompetensi</span>
                                                <p class="text-xs text-slate-300 leading-relaxed">{{ $entry->learned }}</p>
                                            </div>
                                        @endif
                                        @if(!empty($entry->result))
                                            <div class="flex flex-col p-3.5 rounded-lg bg-[#080d14] border border-slate-800/80 gap-1.5">
                                                <span class="text-[10px] font-mono font-bold uppercase text-emerald-400">Penerapan / Hasil</span>
                                                <p class="text-xs text-slate-300 leading-relaxed">{{ $entry->result }}</p>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            @endif

                        </div>
                    </article>
                @endforeach

            </div>
        </div>

    </div>
</section>

