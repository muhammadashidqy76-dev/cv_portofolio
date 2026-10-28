@props(['projects' => null])

@php
    $items = $projects;

    if ($items === null && class_exists(\App\Models\Project::class)) {
        $items = \App\Models\Project::published()
            ->with('techStackItems')
            ->orderedByComplexity()
            ->get();
    }

    if (!$items || (is_countable($items) && count($items) === 0)) {
        $items = collect([
            (object)[
                'title' => 'StockGuard — E-Commerce Checkout Engine',
                'slug' => 'stockguard-ecommerce-checkout-engine',
                'complexity_order' => 1,
                'problem_statement' => 'Mengatasi masalah race condition pada stok produk saat lonjakan checkout simultan (promo/flash sale) yang berpotensi menyebabkan overselling (stok minus) akibat transaksi membaca stok secara bersamaan sebelum pembaruan database.',
                'architecture_decision_summary' => "1. Pessimistic Locking & Database Transactions: Mengombinasikan DB::transaction() dengan lockForUpdate() pada stok produk.\n2. Async Job Processing: Memanfaatkan Laravel Queue berbasis Redis untuk proses berat.\n3. Service Layer Pattern: Enkapsulasi logika bisnis checkout terpisah dari Controller.",
                'architecture_details' => "1. Pessimistic Locking & Database Transactions: Mengombinasikan DB::transaction() dengan lockForUpdate() pada stok produk.\n2. Async Job Processing: Memanfaatkan Laravel Queue berbasis Redis untuk proses berat.\n3. Service Layer Pattern: Enkapsulasi logika bisnis checkout terpisah dari Controller.",
                'impact_metric' => '300+ checkout simultan tanpa overselling, response time <150ms',
                'preview_image_path' => 'https://placehold.co/800x450/090c12/ff334b?text=StockGuard+Engine',
                'preview_image' => 'https://placehold.co/800x450/090c12/ff334b?text=StockGuard+Engine',
                'techStackItems' => collect([
                    (object)['name' => 'Laravel', 'category' => 'Backend', 'status' => 'finished'],
                    (object)['name' => 'PHP', 'category' => 'Language', 'status' => 'finished'],
                    (object)['name' => 'MySQL', 'category' => 'Database', 'status' => 'finished'],
                    (object)['name' => 'Redis', 'category' => 'Cache & Queue', 'status' => 'finished'],
                    (object)['name' => 'Tailwind CSS', 'category' => 'Styling', 'status' => 'finished'],
                ]),
                'demo_url' => 'https://example.com/demo/stockguard',
                'repository_url' => 'https://github.com',
            ],
            (object)[
                'title' => 'OrderSync API — Multi-Channel Order Aggregator',
                'slug' => 'ordersync-api-multi-channel-order-aggregator',
                'complexity_order' => 2,
                'problem_statement' => 'Menyatukan data pesanan dari beberapa channel penjualan (marketplace, POS, website) ke dalam satu sumber data terpusat tanpa duplikasi atau konflik status order.',
                'architecture_decision_summary' => "1. Laravel API Resource untuk konsistensi respon JSON.\n2. Sanctum token-based authentication untuk otorisasi akses client.\n3. Webhook Dispatcher untuk notifikasi real-time antar sistem.",
                'architecture_details' => "1. Laravel API Resource untuk konsistensi respon JSON.\n2. Sanctum token-based authentication untuk otorisasi akses client.\n3. Webhook Dispatcher untuk notifikasi real-time antar sistem.",
                'impact_metric' => 'Menyatukan 3 channel penjualan ke 1 API terpusat, response time rata-rata <200ms',
                'preview_image_path' => null,
                'preview_image' => null,
                'techStackItems' => collect([
                    (object)['name' => 'Laravel', 'category' => 'Backend', 'status' => 'finished'],
                    (object)['name' => 'PHP', 'category' => 'Language', 'status' => 'finished'],
                    (object)['name' => 'RESTful API', 'category' => 'Architecture', 'status' => 'finished'],
                    (object)['name' => 'MySQL', 'category' => 'Database', 'status' => 'finished'],
                    (object)['name' => 'Redis', 'category' => 'Cache & Queue', 'status' => 'finished'],
                ]),
                'demo_url' => 'https://example.com/demo/ordersync',
                'repository_url' => 'https://github.com',
            ],
            (object)[
                'title' => 'Modular Portfolio CMS & Learning Tracker',
                'slug' => 'modular-portfolio-cms',
                'complexity_order' => 3,
                'problem_statement' => 'Merancang sistem CMS khusus portfolio dev yang memungkinkan pembaruan konten dinamis (Projects, Tech Stack, Journey Timeline, dan Learning Log) tanpa hardcode view.',
                'architecture_decision_summary' => "1. Laravel Breeze auth scaffolding untuk keamanan CMS.\n2. Relasi Eloquent dan scope query khusus untuk publikasi konten dinamis.\n3. Component-driven Blade UI dengan Dark Mode Tailwind CSS.",
                'architecture_details' => "1. Laravel Breeze auth scaffolding untuk keamanan CMS.\n2. Relasi Eloquent dan scope query khusus untuk publikasi konten dinamis.\n3. Component-driven Blade UI dengan Dark Mode Tailwind CSS.",
                'impact_metric' => 'Memangkas waktu publikasi update portfolio dari 30 menit menjadi <2 menit via CMS.',
                'preview_image_path' => 'projects/portfolio-cms.jpg',
                'preview_image' => 'projects/portfolio-cms.jpg',
                'techStackItems' => collect([
                    (object)['name' => 'Laravel', 'category' => 'Backend', 'status' => 'finished'],
                    (object)['name' => 'PHP', 'category' => 'Language', 'status' => 'finished'],
                    (object)['name' => 'MySQL', 'category' => 'Database', 'status' => 'finished'],
                    (object)['name' => 'Tailwind CSS', 'category' => 'Styling', 'status' => 'finished'],
                    (object)['name' => 'Alpine.js', 'category' => 'Frontend', 'status' => 'finished'],
                    (object)['name' => 'Git & GitHub', 'category' => 'DevOps', 'status' => 'finished'],
                ]),
                'demo_url' => 'https://example.com/demo/portfolio-cms',
                'repository_url' => 'https://github.com',
            ],
        ]);
    }

    $projects = $items;
@endphp

<section id="projects" 
         x-data="{
             activeModal: null,
             openModal(slug) {
                 this.activeModal = slug;
                 document.body.classList.add('overflow-hidden');
             },
             closeModal() {
                 this.activeModal = null;
                 document.body.classList.remove('overflow-hidden');
             }
         }"
         @keydown.escape.window="closeModal()"
         class="relative bg-carbon-950/60 text-slate-100 py-20 lg:py-28 overflow-hidden border-b border-carbon-800/80">

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Section Header with Engineering Identity -->
        <div class="mb-12 max-w-2xl">
            <span class="inline-flex items-center gap-1.5 font-mono text-[11px] font-semibold uppercase tracking-widest text-cyan-400 mb-3">
                <span class="w-3.5 h-px bg-cyan-500 rounded"></span>
                // {{ __('projects.title') }}
            </span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white leading-tight tracking-tight">
                {{ __('projects.headline') }}
            </h2>
            <p class="mt-3 text-slate-400 text-sm leading-relaxed font-normal">
                {{ __('projects.subtitle') }}
            </p>
        </div>

        <!-- ─── 2. TAMPILAN MINI CARD (GRID ITEM) ─── -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 items-stretch">
            @foreach($projects as $project)
                @php
                    $title = is_array($project) ? ($project['title'] ?? '') : $project->title;
                    $slug = is_array($project) ? ($project['slug'] ?? '') : $project->slug;
                    $order = is_array($project) ? ($project['complexity_order'] ?? $loop->iteration) : ($project->complexity_order ?? $loop->iteration);
                    $impact = is_array($project) ? ($project['impact_metric'] ?? '') : ($project->impact_metric ?? '');
                    $previewImage = is_array($project) ? ($project['preview_image'] ?? $project['preview_image_path'] ?? null) : ($project->preview_image ?? $project->preview_image_path ?? null);
                    $demoUrl = is_array($project) ? ($project['demo_url'] ?? null) : ($project->demo_url ?? null);

                    // Formatted index (#01, #02, dst.)
                    $badgeIndex = sprintf('#%02d', $order);

                    // Main Title & Subtitle parsing
                    $mainTitle = $title;
                    $subtitle = '';
                    if (str_contains($title, '—')) {
                        [$mainTitle, $subtitle] = array_map('trim', explode('—', $title, 2));
                    } elseif (str_contains($title, ' - ')) {
                        [$mainTitle, $subtitle] = array_map('trim', explode(' - ', $title, 2));
                    }

                    // Tech Stack Items Collection
                    $allTechItems = collect([]);
                    if ($project instanceof \App\Models\Project && $project->relationLoaded('techStackItems')) {
                        $allTechItems = $project->techStackItems;
                    } elseif (is_array($project) && isset($project['techStackItems'])) {
                        $allTechItems = collect($project['techStackItems']);
                    } elseif (isset($project->techStackItems)) {
                        $allTechItems = collect($project->techStackItems);
                    } elseif ($project instanceof \App\Models\Project) {
                        $allTechItems = $project->techStackItems;
                    }

                    // Tech Stack Ringkas (max 3 items, calculate remainder)
                    $maxVisibleTags = 3;
                    $visibleTechItems = $allTechItems->take($maxVisibleTags);
                    $remainingCount = max(0, $allTechItems->count() - $maxVisibleTags);

                    // API Mockup Flag
                    $isApiMockup = ($order == 2) || (empty($previewImage) && (str_contains(strtolower($title), 'api') || $order == 2));
                    $browserUrl = $slug ? ($slug . '.local') : 'app.local';
                @endphp

                <article class="group flex flex-col rounded-xl bg-carbon-900 border border-carbon-800 hover:border-carbon-700/80 transition-all duration-200 hover:-translate-y-1 hover:shadow-xl hover:shadow-black/50 overflow-hidden h-full">

                    <!-- Preview Image / Frame Mockup -->
                    <div class="relative flex-none bg-carbon-950 border-b border-carbon-800">
                        @if(!$isApiMockup)
                            <!-- Browser Frame Header -->
                            <div class="flex items-center gap-2 px-3 py-2 bg-carbon-950 border-b border-carbon-800 select-none">
                                <div class="flex gap-1.5 items-center">
                                    <span class="w-2 h-2 rounded-full bg-rose-500/80"></span>
                                    <span class="w-2 h-2 rounded-full bg-amber-400/80"></span>
                                    <span class="w-2 h-2 rounded-full bg-emerald-400/80"></span>
                                </div>
                                <span class="flex-1 text-center font-mono text-[10px] text-slate-400 bg-carbon-900 px-2 py-0.5 rounded border border-carbon-800 truncate max-w-[170px] mx-auto">
                                    {{ $browserUrl }}
                                </span>
                            </div>

                            <!-- Browser Frame Mockup Image / Placeholder -->
                            <div class="h-32 overflow-hidden relative bg-carbon-950">
                                @if(!empty($previewImage))
                                    @php
                                        $imageSrc = \Illuminate\Support\Str::startsWith($previewImage, ['http://', 'https://'])
                                            ? $previewImage
                                            : asset($previewImage);
                                    @endphp
                                    <img src="{{ $imageSrc }}"
                                         alt="{{ $title }}"
                                         class="w-full h-full object-cover opacity-90 group-hover:scale-105 transition-transform duration-300"
                                         loading="lazy"
                                         onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');" />
                                    <div class="hidden w-full h-full flex flex-col items-center justify-center bg-carbon-950 p-4 text-center">
                                        <div class="w-7 h-7 rounded-md bg-vermilion-500/10 border border-vermilion-500/20 flex items-center justify-center text-vermilion-400 mb-1.5">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <span class="text-xs font-mono text-slate-300 font-medium">{{ $mainTitle }}</span>
                                    </div>
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center bg-carbon-950 p-4 text-center">
                                        <div class="w-7 h-7 rounded-md bg-vermilion-500/10 border border-vermilion-500/20 flex items-center justify-center text-vermilion-400 mb-1.5">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                        </div>
                                        <span class="text-xs font-mono text-slate-300 font-medium">{{ $mainTitle }}</span>
                                    </div>
                                @endif
                            </div>
                        @else
                            <!-- Terminal / API Frame Mockup -->
                            <div class="flex items-center justify-between px-3 py-2 bg-carbon-950 border-b border-carbon-800 select-none">
                                <div class="flex gap-1.5 items-center">
                                    <span class="w-2 h-2 rounded-full bg-rose-500/80"></span>
                                    <span class="w-2 h-2 rounded-full bg-amber-400/80"></span>
                                    <span class="w-2 h-2 rounded-full bg-emerald-400/80"></span>
                                </div>
                                <span class="text-[10px] text-emerald-400 font-mono bg-emerald-500/10 border border-emerald-500/20 px-2 py-0.5 rounded">
                                    GET /api/v1/orders
                                </span>
                            </div>
                            <div class="h-32 p-3 text-[11px] leading-relaxed text-emerald-400 bg-carbon-950 overflow-hidden font-mono select-none">
                                <pre class="font-mono"><code>{
  "status": "success",
  "code": 200,
  "data": { "sync": "multi_channel", "latency": "&lt;200ms" }
}</code></pre>
                            </div>
                        @endif
                    </div>

                    <!-- Mini Card Body -->
                    <div class="flex flex-col flex-1 p-5 gap-3">
                        
                        <!-- Title & Badge Index -->
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-2">
                                <span class="text-[10px] font-mono font-semibold tracking-wider uppercase text-vermilion-400 bg-vermilion-500/10 border border-vermilion-500/20 px-2 py-0.5 rounded">
                                    {{ $badgeIndex }}
                                </span>
                            </div>
                            <h3 class="text-base font-bold text-white leading-snug group-hover:text-vermilion-400 transition-colors">
                                {{ $mainTitle }}
                            </h3>
                            @if(!empty($subtitle))
                                <span class="block text-xs font-normal text-slate-400 mt-1 line-clamp-1">{{ $subtitle }}</span>
                            @endif
                        </div>

                        <!-- Tech Stack Ringkas (Max 3 items + Remainder Indicator) -->
                        @if($allTechItems->isNotEmpty())
                            <div class="flex flex-wrap items-center gap-1.5 mt-1 font-mono">
                                @foreach($visibleTechItems as $item)
                                    @php
                                        $itemName = is_string($item) ? $item : ($item->name ?? '');
                                    @endphp
                                    <span class="text-[11px] font-medium px-2 py-0.5 rounded bg-carbon-950 text-slate-300 border border-carbon-800">
                                        {{ $itemName }}
                                    </span>
                                @endforeach

                                @if($remainingCount > 0)
                                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded bg-carbon-950 text-vermilion-400 border border-vermilion-500/30">
                                        +{{ $remainingCount }} {{ __('projects.more_tech') }}
                                    </span>
                                @endif
                            </div>
                        @endif

                    </div>

                    <!-- Mini Card Footer -->
                    <div class="px-5 pb-5 flex flex-col gap-3.5 mt-auto">
                        
                        <!-- Key Metric Highlight with Technical Monospace -->
                        @if(!empty($impact))
                            <div class="text-[11px] font-mono text-amber-300 bg-amber-500/10 border border-amber-500/20 px-2.5 py-1.5 rounded-lg flex items-center gap-2">
                                <span class="text-xs leading-none shrink-0 select-none">⚡</span>
                                <span class="font-medium truncate">{{ $impact }}</span>
                            </div>
                        @endif

                        <div class="border-t border-carbon-800"></div>

                        <!-- Action Buttons -->
                        <div class="flex items-center gap-2">
                            <!-- Detail Button (Primary -> Opens Modal) -->
                            <button type="button"
                                    @click="openModal('{{ $slug }}')"
                                    class="flex-1 flex items-center justify-center gap-1.5 py-2 px-3 rounded-lg bg-vermilion-600 hover:bg-vermilion-500 active:bg-vermilion-700 text-white text-xs font-semibold transition-all duration-150 shadow-sm shadow-vermilion-600/20 focus:outline-none focus:ring-2 focus:ring-vermilion-500/50 cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{ __('projects.detail') }}</span>
                            </button>

                            <!-- Live Demo Button (Secondary -> External Link only) -->
                            @if(!empty($demoUrl) && $demoUrl !== '#')
                                <a href="{{ $demoUrl }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="flex-1 flex items-center justify-center gap-1.5 py-2 px-3 rounded-lg bg-carbon-950 hover:bg-carbon-850 active:bg-carbon-950 text-slate-200 hover:text-white text-xs font-semibold border border-carbon-800 hover:border-slate-700 transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-slate-600">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    <span>{{ __('projects.live_demo') }}</span>
                                </a>
                            @else
                                <span class="flex-1 flex items-center justify-center gap-1.5 py-2 px-3 rounded-lg bg-carbon-950/60 text-slate-600 text-xs font-semibold border border-carbon-800/60 cursor-not-allowed select-none">
                                    <svg class="w-3.5 h-3.5 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    <span>{{ __('projects.live_demo') }}</span>
                                </span>
                            @endif
                        </div>

                    </div>

                </article>
            @endforeach
        </div>

    </div>

    <!-- ─── 3. TAMPILAN MODAL POP-UP (DETAIL LENGKAP) ─── -->
    @foreach($projects as $project)
        @php
            $title = is_array($project) ? ($project['title'] ?? '') : $project->title;
            $slug = is_array($project) ? ($project['slug'] ?? '') : $project->slug;
            $order = is_array($project) ? ($project['complexity_order'] ?? $loop->iteration) : ($project->complexity_order ?? $loop->iteration);
            $problem = is_array($project) ? ($project['problem_statement'] ?? '') : ($project->problem_statement ?? '');
            $archDetails = is_array($project)
                ? ($project['architecture_details'] ?? $project['architecture_decision_summary'] ?? '')
                : ($project->architecture_details ?? $project->architecture_decision_summary ?? '');
            $impact = is_array($project) ? ($project['impact_metric'] ?? '') : ($project->impact_metric ?? '');
            $demoUrl = is_array($project) ? ($project['demo_url'] ?? null) : ($project->demo_url ?? null);
            $repoUrl = is_array($project) ? ($project['repository_url'] ?? null) : ($project->repository_url ?? null);
            $previewImage = is_array($project) ? ($project['preview_image'] ?? $project['preview_image_path'] ?? null) : ($project->preview_image ?? $project->preview_image_path ?? null);

            $badgeIndex = sprintf('#%02d', $order);

            // Title splitting
            $mainTitle = $title;
            $subtitle = '';
            if (str_contains($title, '—')) {
                [$mainTitle, $subtitle] = array_map('trim', explode('—', $title, 2));
            } elseif (str_contains($title, ' - ')) {
                [$mainTitle, $subtitle] = array_map('trim', explode(' - ', $title, 2));
            }

            // Tech Stack Items Collection
            $allTechItems = collect([]);
            if ($project instanceof \App\Models\Project && $project->relationLoaded('techStackItems')) {
                $allTechItems = $project->techStackItems;
            } elseif (is_array($project) && isset($project['techStackItems'])) {
                $allTechItems = collect($project['techStackItems']);
            } elseif (isset($project->techStackItems)) {
                $allTechItems = collect($project->techStackItems);
            } elseif ($project instanceof \App\Models\Project) {
                $allTechItems = $project->techStackItems;
            }

            // Architecture details line parser for clean rendering
            $archLines = [];
            if (!empty($archDetails)) {
                $lines = preg_split('/\r\n|\r|\n/', trim($archDetails));
                foreach ($lines as $line) {
                    $trimmed = trim($line);
                    if (!empty($trimmed)) {
                        $archLines[] = $trimmed;
                    }
                }
            }
        @endphp

        <!-- Modal Container (Overlay + Dialog Card) -->
        <div id="modal-{{ $slug }}"
             x-show="activeModal === '{{ $slug }}'"
             x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 overflow-y-auto"
             role="dialog"
             aria-modal="true"
             aria-labelledby="modal-title-{{ $slug }}">

            <!-- Backdrop Blur & Overlay -->
            <div x-show="activeModal === '{{ $slug }}'"
                 x-transition:enter="ease-out duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-150"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="closeModal()"
                 class="fixed inset-0 bg-black/85 backdrop-blur-sm transition-opacity"></div>

            <!-- Modal Content Card -->
            <div x-show="activeModal === '{{ $slug }}'"
                 x-transition:enter="ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-98 translate-y-2"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-98 translate-y-2"
                 @click.stop
                 class="relative w-full max-w-2xl bg-carbon-900 border border-carbon-800 rounded-xl shadow-2xl overflow-hidden z-10 my-8 flex flex-col max-h-[85vh]">

                <!-- 1. Header: Title, Subtitle, Badge, & Close Button -->
                <div class="flex items-start justify-between gap-4 p-5 sm:p-6 bg-carbon-950 border-b border-carbon-800 sticky top-0 z-20">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1.5">
                            <span class="text-[10px] font-mono font-semibold uppercase tracking-wider text-vermilion-400 bg-vermilion-500/10 border border-vermilion-500/20 px-2 py-0.5 rounded">
                                {{ $badgeIndex }} &bull; {{ __('projects.modal_detail_badge') }}
                            </span>
                        </div>
                        <h3 id="modal-title-{{ $slug }}" class="text-lg sm:text-xl font-bold text-white leading-snug">
                            {{ $mainTitle }}
                        </h3>
                        @if(!empty($subtitle))
                            <p class="text-xs sm:text-sm text-slate-400 mt-0.5 font-medium">
                                {{ $subtitle }}
                            </p>
                        @endif
                    </div>

                    <!-- Close Button (X) -->
                    <button type="button"
                            @click="closeModal()"
                            aria-label="{{ __('projects.close') }}"
                            class="rounded-lg p-2 text-slate-400 hover:text-white hover:bg-carbon-850 transition-colors focus:outline-none focus:ring-2 focus:ring-vermilion-500/50 shrink-0 cursor-pointer">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Modal Body (Scrollable) -->
                <div class="p-5 sm:p-6 overflow-y-auto space-y-6 text-slate-300">

                    <!-- Section Problem Statement -->
                    <div class="space-y-2">
                        <div class="flex items-center gap-2 text-xs font-mono font-semibold uppercase tracking-wider text-vermilion-400">
                            <div class="w-1.5 h-1.5 rounded-full bg-vermilion-400"></div>
                            <h4>// {{ __('projects.problem_statement') }}</h4>
                        </div>
                        <div class="p-4 rounded-lg bg-carbon-950 border border-carbon-800 text-xs sm:text-sm leading-relaxed text-slate-300">
                            {{ $problem }}
                        </div>
                    </div>

                    <!-- Section Architecture Details -->
                    <div class="space-y-2.5">
                        <div class="flex items-center gap-2 text-xs font-mono font-semibold uppercase tracking-wider text-sky-400">
                            <div class="w-1.5 h-1.5 rounded-full bg-sky-400"></div>
                            <h4>// {{ __('projects.architecture') }}</h4>
                        </div>
                        
                        @if(count($archLines) > 0)
                            <div class="space-y-2">
                                @foreach($archLines as $line)
                                    <div class="p-3.5 rounded-lg bg-carbon-950 border border-carbon-800 text-xs sm:text-sm leading-relaxed text-slate-300 flex items-start gap-3">
                                        <div class="w-4 h-4 rounded bg-sky-500/10 border border-sky-500/20 flex items-center justify-center text-sky-400 shrink-0 mt-0.5 text-xs font-bold">
                                            ✓
                                        </div>
                                        <div class="flex-1 whitespace-pre-line font-mono text-xs sm:text-sm">
                                            {{ $line }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-4 rounded-lg bg-carbon-950 border border-carbon-800 text-xs sm:text-sm leading-relaxed text-slate-400">
                                {{ $archDetails ?: __('projects.no_architecture') }}
                            </div>
                        @endif
                    </div>

                    <!-- Section Tech Stack Lengkap -->
                    <div class="space-y-2.5">
                        <div class="flex items-center gap-2 text-xs font-mono font-semibold uppercase tracking-wider text-emerald-400">
                            <div class="w-1.5 h-1.5 rounded-full bg-emerald-400"></div>
                            <h4>// {{ __('projects.tech_stack') }}</h4>
                        </div>
                        
                        @if($allTechItems->isNotEmpty())
                            <div class="flex flex-wrap gap-2 font-mono">
                                @foreach($allTechItems as $item)
                                    @php
                                        $itemName = is_string($item) ? $item : ($item->name ?? '');
                                        $category = is_object($item) ? ($item->category ?? null) : (is_array($item) ? ($item['category'] ?? null) : null);
                                    @endphp
                                    <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md bg-carbon-950 border border-carbon-800 text-xs font-medium text-slate-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                        <span>{{ $itemName }}</span>
                                        @if(!empty($category))
                                            <span class="text-[10px] text-slate-400">({{ $category }})</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-xs text-slate-400 font-mono">{{ __('projects.no_tech_stack') }}</p>
                        @endif
                    </div>

                </div>

                <!-- 4. Section Metric & Action Links (Footer Sticky) -->
                <div class="p-5 sm:p-6 bg-carbon-950 border-t border-carbon-800 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 sticky bottom-0 z-20">
                    
                    <!-- Key Metric with ⚡ -->
                    @if(!empty($impact))
                        <div class="flex items-center gap-2 text-xs font-mono text-amber-300 bg-amber-500/10 border border-amber-500/20 px-3 py-2 rounded-lg">
                            <span class="text-xs select-none">⚡</span>
                            <span class="font-semibold">{{ $impact }}</span>
                        </div>
                    @else
                        <div></div>
                    @endif

                    <!-- Action Links / Buttons -->
                    <div class="flex items-center gap-2.5 justify-end">
                        @if(!empty($demoUrl) && $demoUrl !== '#')
                            <a href="{{ $demoUrl }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="flex items-center justify-center gap-1.5 py-2 px-4 rounded-lg bg-vermilion-600 hover:bg-vermilion-500 active:bg-vermilion-700 text-white text-xs font-semibold transition-all duration-150 shadow-sm shadow-vermilion-600/20">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                <span>{{ __('projects.view_demo') }}</span>
                            </a>
                        @endif

                        @if(!empty($repoUrl) && $repoUrl !== '#')
                            <a href="{{ $repoUrl }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="flex items-center justify-center gap-1.5 py-2 px-4 rounded-lg bg-carbon-900 hover:bg-carbon-850 active:bg-carbon-900 text-slate-200 hover:text-white text-xs font-semibold border border-carbon-800 hover:border-slate-700 transition-all duration-150">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" />
                                </svg>
                                <span>{{ __('projects.view_repo') }}</span>
                            </a>
                        @endif

                        <button type="button"
                                @click="closeModal()"
                                class="py-2 px-4 rounded-lg bg-carbon-900 hover:bg-carbon-850 text-slate-300 hover:text-white text-xs font-semibold border border-carbon-800 hover:border-slate-700 transition-colors cursor-pointer">
                            {{ __('projects.close') }}
                        </button>
                    </div>

                </div>

            </div>

        </div>
    @endforeach

</section>
