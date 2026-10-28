@props(['techStack' => null])

@php
    $itemsGrouped = $techStack;

    if (!$itemsGrouped) {
        $all = \App\Models\TechStackItem::orderBy('display_order')->get();
        if ($all->isNotEmpty()) {
            $itemsGrouped = $all->groupBy('category');
        } else {
            $itemsGrouped = collect([
                'Backend' => [
                    ['name' => 'Laravel'],
                    ['name' => 'PHP'],
                    ['name' => 'RESTful API'],
                ],
                'Database' => [
                    ['name' => 'MySQL'],
                    ['name' => 'Redis'],
                ],
                'Frontend' => [
                    ['name' => 'Blade Templating'],
                    ['name' => 'Tailwind CSS'],
                    ['name' => 'Alpine.js'],
                ],
                'Tools' => [
                    ['name' => 'Git & GitHub'],
                    ['name' => 'Composer'],
                    ['name' => 'Postman'],
                    ['name' => 'Docker'],
                ],
            ]);
        }
    }

    $preferredOrder = ['Tools', 'Database', 'Backend', 'Frontend'];
    $allCategories = $itemsGrouped->keys()->toArray();
    $desiredOrder = array_values(array_unique(array_merge(
        array_intersect($preferredOrder, $allCategories),
        $allCategories
    )));

    $categoryDisplayNames = [
        'Tools' => 'Cloud, DevOps & Tools',
        'Database' => 'Database & In-Memory Cache',
        'Backend' => 'Scripting & Application Runtime',
        'Frontend' => 'Frontend & Templating',
    ];

    $categoryMeta = [
        'Tools' => [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>',
            'color' => 'text-cyan-400',
        ],
        'Database' => [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>',
            'color' => 'text-emerald-400',
        ],
        'Backend' => [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>',
            'color' => 'text-amber-400',
        ],
        'Frontend' => [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
            'color' => 'text-sky-300',
        ],
    ];

    // Hanya path SVG (tanpa warna) — warna icon & badge ditentukan di titik render
    $techIconPaths = [
        'Laravel'          => '<path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>',
        'PHP'              => '<path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h10M7 16h10"/>',
        'RESTful API'      => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>',
        'MySQL'            => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>',
        'Redis'            => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 2l9 4.9v9.8L12 22l-9-4.9V6.9L12 2z"/>',
        'Blade Templating' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16v12H4z"/>',
        'Blade'            => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16v12H4z"/>',
        'Tailwind CSS'     => '<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
        'Alpine.js'        => '<path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/>',
        'Git & GitHub'     => '<path stroke-linecap="round" stroke-linejoin="round" d="M8 7h8M8 12h8M8 17h8"/>',
        'Composer'         => '<path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 12h14M5 16h14"/>',
        'Postman'          => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>',
        'Docker'           => '<path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>',
    ];

    // Hitung total not_started di seluruh item
    $totalNotStarted = 0;
    foreach ($itemsGrouped as $group) {
        foreach ($group as $it) {
            $st = is_array($it) ? ($it['status'] ?? 'finished') : ($it->status ?? 'finished');
            if ($st === 'not_started' || $st === \App\Models\TechStackItem::STATUS_NOT_STARTED) {
                $totalNotStarted++;
            }
        }
    }

    // Fallback path untuk tech yang belum punya icon spesifik
    $fallbackIconPath = '<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>';
@endphp

<section id="tech-stack" 
         x-data="{ showNotStarted: false }"
         class="relative bg-carbon-950/60 text-slate-100 py-20 lg:py-28 overflow-hidden border-b border-carbon-800/80">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- ─── Section Header ─── -->
        <div class="mb-12 flex flex-col sm:flex-row sm:items-end justify-between gap-6">
            <div class="max-w-2xl">
                <span class="inline-flex items-center gap-1.5 font-mono text-[11px] font-semibold uppercase tracking-widest text-cyan-400 mb-3">
                    <span class="w-3.5 h-px bg-cyan-500 rounded"></span>
                    // {{ __('tech.tag') }}
                </span>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white leading-tight tracking-tight">
                    {{ __('tech.title') }}
                </h2>
                <p class="mt-3 text-slate-400 text-sm leading-relaxed font-normal">
                    {{ __('tech.subtitle') }}
                </p>
            </div>

            @if($totalNotStarted > 0)
                <!-- ─── Toggle Filter Button (Alpine.js) ─── -->
                <div class="shrink-0">
                    <button 
                        @click="showNotStarted = !showNotStarted"
                        type="button"
                        class="inline-flex items-center gap-2.5 px-3.5 py-2 rounded-lg border text-xs font-mono transition-all duration-200 cursor-pointer select-none"
                        :class="showNotStarted 
                            ? 'bg-rose-500/10 border-rose-500/40 text-rose-300 hover:bg-rose-500/20 shadow-sm shadow-rose-950/50' 
                            : 'bg-carbon-900 border-carbon-800 text-slate-400 hover:text-slate-200 hover:border-carbon-700'"
                    >
                        <span class="relative flex h-2 w-2">
                            <span x-show="showNotStarted" class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2" :class="showNotStarted ? 'bg-rose-400' : 'bg-slate-500'"></span>
                        </span>
                        <span x-show="!showNotStarted">
                            {{ __('tech.toggle_show_roadmap', ['count' => $totalNotStarted]) }}
                        </span>
                        <span x-show="showNotStarted" x-cloak>
                            {{ __('tech.toggle_hide_roadmap', ['count' => $totalNotStarted]) }}
                        </span>
                    </button>
                </div>
            @endif
        </div>

        <!-- ─── Cards Grid ─── -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-stretch">
            @foreach($desiredOrder as $cat)
                @if(isset($itemsGrouped[$cat]) && count($itemsGrouped[$cat]) > 0)
                    @php
                        $meta = $categoryMeta[$cat] ?? [
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
                            'color' => 'text-slate-400',
                        ];
                        $totalCatCount = count($itemsGrouped[$cat]);
                        $activeCatCount = 0;
                        foreach ($itemsGrouped[$cat] as $it) {
                            $st = is_array($it) ? ($it['status'] ?? 'finished') : ($it->status ?? 'finished');
                            if ($st !== 'not_started' && $st !== \App\Models\TechStackItem::STATUS_NOT_STARTED) {
                                $activeCatCount++;
                            }
                        }
                        $notStartedCatCount = $totalCatCount - $activeCatCount;
                    @endphp

                    <div class="flex flex-col p-6 rounded-xl bg-carbon-900 border border-carbon-800 hover:border-carbon-700/80 transition-all duration-200 justify-between h-full">
                        
                        <!-- Card Top Bar: Icon + Title on left, Badge on right -->
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-2.5">
                                <svg class="w-5 h-5 {{ $meta['color'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    {!! $meta['icon'] !!}
                                </svg>
                                <h3 class="text-base font-bold text-white tracking-tight">
                                    {{ $categoryDisplayNames[$cat] ?? $cat }}
                                </h3>
                            </div>

                            <span class="font-mono text-xs text-vermilion-400 bg-carbon-950 border border-carbon-800 px-2.5 py-1 rounded-md">
                                @if($notStartedCatCount > 0)
                                    <span x-text="showNotStarted ? '{{ $totalCatCount }}' : '{{ $activeCatCount }}'">{{ $activeCatCount }}</span> {{ $totalCatCount > 1 ? __('tech.technologies') : __('tech.technology') }}
                                @else
                                    {{ $totalCatCount }} {{ $totalCatCount > 1 ? __('tech.technologies') : __('tech.technology') }}
                                @endif
                            </span>
                        </div>

                        <!-- Card Bottom: Tech Pills Horizontal Grid -->
                        <div class="flex flex-wrap gap-2.5 font-mono">
                            @if($activeCatCount === 0 && $notStartedCatCount > 0)
                                <div x-show="!showNotStarted" class="text-xs font-mono text-slate-500 py-1.5 flex items-center gap-2">
                                    <svg class="w-3.5 h-3.5 text-slate-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-[11px] leading-relaxed">{{ __('tech.roadmap_empty_state') }}</span>
                                </div>
                            @endif

                            @foreach($itemsGrouped[$cat] as $item)
                                @php
                                    $name = is_array($item) ? $item['name'] : $item->name;
                                    $status = is_array($item) ? ($item['status'] ?? 'finished') : ($item->status ?? 'finished');
                                    $isNotStarted = ($status === 'not_started' || $status === \App\Models\TechStackItem::STATUS_NOT_STARTED);

                                    $badgeClasses = ($item instanceof \App\Models\TechStackItem)
                                        ? $item->status_badge_classes
                                        : ['text' => 'text-vermilion-400', 'bg' => 'bg-carbon-950', 'border' => 'border-carbon-800'];

                                    $iconPath = $techIconPaths[$name] ?? $fallbackIconPath;
                                @endphp
                                <div 
                                    @if($isNotStarted)
                                        x-show="showNotStarted"
                                        x-cloak
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-150"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                    @endif
                                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg {{ $badgeClasses['bg'] }} border {{ $badgeClasses['border'] }} text-xs font-medium transition-colors">
                                    <span class="shrink-0">
                                        <svg class="w-3.5 h-3.5 {{ $badgeClasses['text'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            {!! $iconPath !!}
                                        </svg>
                                    </span>
                                    <span class="{{ $badgeClasses['text'] }}">{{ $name }}</span>
                                </div>
                            @endforeach
                        </div>

                    </div>
                @endif
            @endforeach
        </div>

    </div>
</section>
