<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ashidqy — Aspiring Cloud & Infrastructure Engineer</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-web.svg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800|jetbrains-mono:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-carbon-950 text-slate-100 font-sans antialiased selection:bg-rose-500 selection:text-white relative min-h-screen">
    <!-- Global Seamless Engineering Matrix Grid Background -->
    <div class="fixed inset-0 bg-[linear-gradient(to_right,#1f293d18_2px,transparent_2px),linear-gradient(to_bottom,#1f293d18_2px,transparent_2px)] bg-[size:3.5rem_3.5rem] pointer-events-none z-0"></div>

    <div class="relative z-10">
        <x-navbar />
        <x-hero-section />
        <x-featured-projects />
        <x-tech-stack />
        <x-work-experience-section />

    <!-- ─── Progressive Collapsible Secondary Sections (Learning Journey & Learning Log) ─── -->
    <div x-data="{
        stage: 0,
        nextStage() {
            if (this.stage < 2) {
                this.stage++;
            } else {
                this.stage = 0;
            }
        }
    }" class="relative bg-carbon-950">

        <!-- Section 1: Learning Journey & Credentials (Shown when stage >= 1) -->
        <div x-show="stage >= 1"
             x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4">
            <x-journey-section />
        </div>

        <!-- Section 2: Learning Log & Technical Notes (Shown when stage >= 2) -->
        <div x-show="stage >= 2"
             x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4">
            <x-learning-log-section />
        </div>

        <!-- Horizontal Centered Trigger Bar (Positioned dynamically beneath the last active section) -->
        <div class="relative py-12 flex items-center justify-center border-t border-carbon-800/80">
            <div class="relative flex justify-center z-10">
                <button type="button"
                        @click="nextStage()"
                        class="inline-flex items-center gap-3 px-6 py-3 rounded-lg bg-carbon-900 hover:bg-carbon-850 border border-carbon-800 hover:border-slate-700 text-slate-300 hover:text-white transition-all duration-200 shadow-xl hover:-translate-y-0.5 group focus:outline-none focus:ring-2 focus:ring-vermilion-500/40 cursor-pointer font-mono text-xs">
                    
                    <span class="w-2 h-2 rounded-full bg-vermilion-500/80 group-hover:bg-vermilion-400"
                          :class="stage === 2 ? 'bg-amber-400' : 'animate-pulse'"></span>
                    
                    <span class="font-semibold tracking-wide"
                          x-text="stage === 0 
                                    ? '{{ __('stage.show_journey') }}' 
                                    : (stage === 1 
                                        ? '{{ __('stage.show_log') }}' 
                                        : '{{ __('stage.close_all') }}')">
                    </span>

                    <div class="w-5 h-5 rounded bg-carbon-950 border border-carbon-800 flex items-center justify-center text-slate-400 group-hover:text-white transition-transform duration-300"
                         :class="stage === 2 ? 'rotate-180 bg-vermilion-500/20 text-vermilion-400 border-vermilion-500/30' : ''">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </button>
            </div>
        </div>

    </div>

        <x-footer />
    </div>
</body>
</html>
