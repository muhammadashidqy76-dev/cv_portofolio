<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ashidqy — Laravel Backend Developer</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-web.svg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0b0f19] text-slate-100 font-sans antialiased selection:bg-red-500 selection:text-white">
    <x-navbar />
    <x-hero-section />
    <x-featured-projects />
    <x-tech-stack />
    <x-work-experience-section />

    <!-- ─── Secondary Sections (Journey & Learning Log) Collapsible Wrapper ─── -->
    <div x-data="{ expanded: false }" class="w-full">
        
        <!-- Toggle Bar between Experience and Footer -->
        <div class="py-12 bg-[#0b0f19] border-t border-slate-800/80 flex flex-col items-center justify-center relative z-20">
            <button type="button"
                    @click="expanded = !expanded"
                    class="inline-flex items-center gap-3 px-6 py-3.5 rounded-xl bg-slate-900/90 border border-slate-800 hover:border-slate-700 text-sm font-semibold text-slate-200 hover:text-white transition-all duration-200 hover:scale-[1.02] shadow-lg shadow-black/40 group cursor-pointer focus:outline-none focus:ring-2 focus:ring-red-500/40">
                <span class="w-2 h-2 rounded-full transition-colors duration-300" :class="expanded ? 'bg-amber-400' : 'bg-red-400 animate-pulse'"></span>
                <span x-text="expanded ? 'Sembunyikan Journey &amp; Learning Log' : 'Lihat Journey &amp; Learning Log'"></span>
                <span class="p-1 rounded-md bg-slate-800 text-slate-400 group-hover:text-white transition-transform duration-300"
                      :class="expanded ? 'rotate-180' : ''">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </span>
            </button>
            <p class="mt-2 text-xs text-slate-500 font-mono" x-show="!expanded" x-transition>
                Eksplorasi riwayat pembelajaran, sertifikasi, dan catatan teknis
            </p>
        </div>

        <!-- 1. Journey Section (Enters immediately on expand, leaves with delay on collapse) -->
        <div x-show="expanded"
             x-cloak
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200 delay-150 transform"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4">
            <x-journey-section />
        </div>

        <!-- 2. Learning Log Section (Enters with delay on expand, leaves immediately on collapse) -->
        <div x-show="expanded"
             x-cloak
             x-transition:enter="transition ease-out duration-300 delay-150 transform"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4">
            <x-learning-log-section />
        </div>

    </div>

    <x-footer />
</body>
</html>
