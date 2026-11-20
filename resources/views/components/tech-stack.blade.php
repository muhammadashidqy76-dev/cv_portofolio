@props(['techStack' => null])

@php
    $itemsGrouped = $techStack;

    if (!$itemsGrouped) {
        $all = \App\Models\TechStackItem::finished()->orderBy('display_order')->get();
        if ($all->isNotEmpty()) {
            $itemsGrouped = $all->groupBy('category');
        } else {
            $itemsGrouped = collect([]);
        }
    } else {
        // Jika data di-pass manual, filter khusus status 'finished'
        if ($itemsGrouped instanceof \Illuminate\Support\Collection) {
            $itemsGrouped = $itemsGrouped->map(function ($items) {
                return collect($items)->filter(function ($item) {
                    if ($item instanceof \App\Models\TechStackItem) {
                        return $item->status === \App\Models\TechStackItem::STATUS_FINISHED;
                    }
                    if (is_array($item)) {
                        return ($item['status'] ?? null) === \App\Models\TechStackItem::STATUS_FINISHED;
                    }
                    return false;
                });
            })->filter(fn ($items) => count($items) > 0);
        }
    }

    $desiredOrder = ['Backend', 'Database', 'Networking & Simulation', 'Tools', 'Frontend'];
    $otherCategories = collect(array_keys($itemsGrouped ? $itemsGrouped->toArray() : []))
        ->diff($desiredOrder)
        ->values()
        ->all();
    $categoriesToDisplay = array_merge(
        array_filter($desiredOrder, fn($cat) => isset($itemsGrouped[$cat]) && count($itemsGrouped[$cat]) > 0),
        $otherCategories
    );

    $categoryMeta = [
        'Backend' => [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"/>',
            'color' => 'text-vermilion-400',
        ],
        'Database' => [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>',
            'color' => 'text-emerald-400',
        ],
        'Networking & Simulation' => [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 21a2 2 0 100-4 2 2 0 000 4zM5 9a2 2 0 100-4 2 2 0 000 4zM19 9a2 2 0 100-4 2 2 0 000 4zM12 17v-4m-7-6l5 4m9-4l-5 4"/>',
            'color' => 'text-indigo-400',
        ],
        'Frontend' => [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
            'color' => 'text-sky-300',
        ],
        'Tools' => [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>',
            'color' => 'text-amber-400',
        ],
    ];

    // Hanya path SVG (tanpa warna) — warna icon & badge ditentukan di titik render
    $techIconPaths = [
        'Laravel'             => '<path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>',
        'PHP'                 => '<path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h10M7 16h10"/>',
        'RESTful API'         => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>',
        'MySQL'               => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>',
        'Redis'               => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 2l9 4.9v9.8L12 22l-9-4.9V6.9L12 2z"/>',
        'Blade Templating'    => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16v12H4z"/>',
        'Blade'               => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16v12H4z"/>',
        'Tailwind CSS'        => '<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
        'Alpine.js'           => '<path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/>',
        'Git & GitHub'        => '<path stroke-linecap="round" stroke-linejoin="round" d="M8 7h8M8 12h8M8 17h8"/>',
        'Composer'            => '<path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 12h14M5 16h14"/>',
        'Postman'             => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>',
        'Docker'              => '<path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>',
        'Cisco Packet Tracer' => '<path stroke-linecap="round" stroke-linejoin="round" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
        'GNS3'                => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 21a2 2 0 100-4 2 2 0 000 4zM5 9a2 2 0 100-4 2 2 0 000 4zM19 9a2 2 0 100-4 2 2 0 000 4zM12 17v-4m-7-6l5 4m9-4l-5 4"/>',
        'Wireshark'           => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25"/>',
    ];

    // Fallback path untuk tech yang belum punya icon spesifik
    $fallbackIconPath = '<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>';
@endphp

<section id="tech-stack" class="relative bg-carbon-950/60 text-slate-100 py-20 lg:py-28 overflow-hidden border-b border-carbon-800/80">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- ─── Section Header ─── -->
        <div class="mb-12 max-w-2xl">
            <span class="inline-flex items-center gap-1.5 font-mono text-[11px] font-semibold uppercase tracking-widest text-vermilion-400 mb-3">
                <span class="w-3.5 h-px bg-vermilion-500 rounded"></span>
                {{ __('tech.tag') }}
            </span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white leading-tight tracking-tight">
                {{ __('tech.title') }}
            </h2>
            <p class="mt-3 text-slate-400 text-sm leading-relaxed font-normal">
                {{ __('tech.subtitle') }}
            </p>
        </div>

        <!-- ─── Cards Grid ─── -->
        @if(count($categoriesToDisplay) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-stretch">
                @foreach($categoriesToDisplay as $cat)
                    @if(isset($itemsGrouped[$cat]) && count($itemsGrouped[$cat]) > 0)
                        @php
                            $meta = $categoryMeta[$cat] ?? [
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
                                'color' => 'text-slate-400',
                            ];
                            $count = count($itemsGrouped[$cat]);
                        @endphp

                        <div class="flex flex-col p-6 rounded-xl bg-carbon-900 border border-carbon-800 hover:border-carbon-700/80 transition-all duration-200 justify-between h-full">
                            
                            <!-- Card Top Bar: Icon + Title on left, Badge on right -->
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-2.5">
                                    <svg class="w-5 h-5 {{ $meta['color'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        {!! $meta['icon'] !!}
                                    </svg>
                                    <h3 class="text-base font-bold text-white tracking-tight">
                                        {{ $cat }}
                                    </h3>
                                </div>

                                <span class="font-mono text-xs text-vermilion-400 bg-carbon-950 border border-carbon-800 px-2.5 py-1 rounded-md">
                                    {{ $count }} {{ $count > 1 ? __('tech.technologies') : __('tech.technology') }}
                                </span>
                            </div>

                            <!-- Card Bottom: Tech Pills Horizontal Grid -->
                            <div class="flex flex-wrap gap-2.5 font-mono">
                                @foreach($itemsGrouped[$cat] as $item)
                                    @php
                                        $name = is_array($item) ? $item['name'] : $item->name;

                                        $badgeClasses = ($item instanceof \App\Models\TechStackItem)
                                            ? $item->status_badge_classes
                                            : ['text' => 'text-emerald-400', 'bg' => 'bg-emerald-400/10', 'border' => 'border-emerald-400/20'];

                                        $iconPath = $techIconPaths[$name] ?? $fallbackIconPath;
                                        $techSlug = \Illuminate\Support\Str::slug($name);
                                    @endphp
                                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg {{ $badgeClasses['bg'] }} border {{ $badgeClasses['border'] }} text-xs font-medium select-none shadow-sm">
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

            <!-- Footer indicator bar -->
            <div class="mt-8 flex items-center gap-2 p-4 rounded-xl bg-carbon-900/60 border border-carbon-800 text-xs font-mono text-slate-400">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Menampilkan teknologi terverifikasi dengan status <strong class="text-emerald-400 font-semibold">Finished</strong> (siap diterapkan di lingkungan produksi).</span>
            </div>
        @else
            <div class="p-10 rounded-xl bg-carbon-900 border border-carbon-800 text-center space-y-3">
                <div class="w-10 h-10 rounded-full bg-carbon-950 border border-carbon-800 mx-auto flex items-center justify-center text-slate-500">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <p class="font-mono text-xs text-slate-300">Belum ada teknologi dengan status <span class="text-emerald-400 font-semibold">Finished</span>.</p>
            </div>
        @endif

    </div>
</section>
