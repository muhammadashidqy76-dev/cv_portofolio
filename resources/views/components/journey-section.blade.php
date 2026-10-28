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

<section id="journey" class="relative bg-carbon-950/60 text-slate-100 py-20 lg:py-28 overflow-hidden border-b border-carbon-800/80">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- ─── Section Header ─── -->
        <div class="mb-12 max-w-2xl">
            <span class="inline-flex items-center gap-1.5 font-mono text-[11px] font-semibold uppercase tracking-widest text-cyan-400 mb-3">
                <span class="w-3.5 h-px bg-cyan-500 rounded"></span>
                // {{ __('journey.tag') }}
            </span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white leading-tight tracking-tight">
                {{ __('journey.title') }}
            </h2>
            <p class="mt-3 text-slate-400 text-sm leading-relaxed font-normal">
                {{ __('journey.subtitle') }}
            </p>
        </div>

        <!-- ─── 3-Column Grid Layout ─── -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 items-stretch">

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
                        'certification' => __('journey.badge_certification'),
                        'diploma' => __('journey.badge_diploma'),
                        default => __('journey.badge_course'),
                    };
                    $typeBadgeClass = match($credentialType) {
                        'certification' => 'text-amber-400 bg-amber-500/10 border-amber-500/20',
                        'diploma' => 'text-emerald-400 bg-emerald-500/10 border-emerald-500/20',
                        default => 'text-sky-400 bg-sky-500/10 border-sky-500/20',
                    };
                @endphp

                <!-- Window Mockup Card for Journey Entry (Uniform 3-Column Card) -->
                <article class="group flex flex-col justify-between rounded-xl bg-carbon-900 border border-carbon-800 hover:border-carbon-700/80 transition-all duration-200 hover:-translate-y-0.5 overflow-hidden h-full">
                    
                    <div>
                        <!-- Window Mockup Header Bar (3 colored dots & badges) -->
                        <div class="flex items-center justify-between px-4 py-2.5 bg-carbon-950 border-b border-carbon-800 gap-2 select-none">
                            <div class="flex items-center gap-2">
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-rose-500/80"></span>
                                    <span class="w-2 h-2 rounded-full bg-amber-400/80"></span>
                                    <span class="w-2 h-2 rounded-full bg-emerald-400/80"></span>
                                </div>
                                <span class="font-mono text-[10px] font-semibold uppercase px-2 py-0.5 rounded border {{ $typeBadgeClass }}">
                                    {{ $typeLabel }}
                                </span>
                            </div>
                            
                            @if($completedDate)
                                <span class="font-mono text-[10px] text-vermilion-400 bg-vermilion-500/10 border border-vermilion-500/20 px-2 py-0.5 rounded shrink-0">
                                    {{ $completedDate }}
                                </span>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 flex flex-col gap-3.5">
                            <!-- Course / Credential Title -->
                            <h3 class="text-[15px] font-bold text-white group-hover:text-vermilion-400 transition-colors leading-snug">
                                {{ $entry->course_name }}
                            </h3>

                            <!-- Issuer / Provider Info Pill -->
                            <div class="flex items-center gap-3 p-3 rounded-lg bg-carbon-950 border border-carbon-800">
                                @php
                                    $logoUrl = is_object($entry) && isset($entry->issuer_logo)
                                        ? $entry->issuer_logo
                                        : asset('images/issuer-logos/' . match(strtolower(trim($entry->source ?? ''))) {
                                            'laracasts' => 'laracasts.svg',
                                            'udemy' => 'udemy.svg',
                                            'dicoding' => 'dicoding.png',
                                            'bnsp', 'badan nasional sertifikasi profesi (bnsp)', 'badan nasional sertifikasi profesi' => 'bnsp.svg',
                                            default => 'default.svg'
                                        });
                                @endphp
                                <div class="w-8 h-8 shrink-0 rounded-lg bg-carbon-900 border border-carbon-800 flex items-center justify-center overflow-hidden">
                                    <img src="{{ $logoUrl }}"
                                         alt="{{ $entry->source ?? 'Issuer' }}"
                                         class="w-full h-full object-contain"
                                         loading="lazy" />
                                </div>
                                <div class="flex flex-col min-w-0 font-mono">
                                    <span class="text-xs font-semibold text-slate-200 truncate font-sans">
                                        {{ $entry->source ?: __('journey.default_provider') }}
                                    </span>
                                    <span class="text-[10px] text-slate-400 truncate">
                                        @if($credentialType === 'certification')
                                            {{ __('journey.sub_certification') }}
                                        @elseif($credentialType === 'diploma')
                                            {{ __('journey.sub_diploma') }}
                                        @else
                                            {{ __('journey.sub_course') }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer / Actions -->
                    @if(!empty($entry->certificate_file_path) || !empty($entry->verification_url))
                        <div class="px-5 pb-5 pt-0 mt-auto flex items-center justify-between gap-2 border-t border-carbon-800 pt-3.5 flex-wrap">
                            @if(!empty($entry->certificate_file_path))
                                <a href="{{ asset($entry->certificate_file_path) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-medium text-slate-300 bg-carbon-950 border border-carbon-800 hover:border-slate-700 hover:text-white transition-colors font-mono">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span>{{ __('journey.doc') }}</span>
                                </a>
                            @endif

                            @if(!empty($entry->verification_url))
                                <a href="{{ $entry->verification_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-semibold text-vermilion-400 bg-vermilion-500/10 border border-vermilion-500/20 hover:bg-vermilion-500/20 hover:text-vermilion-300 transition-colors ml-auto font-mono">
                                    <span>{{ __('journey.verify') }}</span>
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
</section>
