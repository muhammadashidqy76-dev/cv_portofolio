<section x-data="{
    showBioModal: false,
    showCvModal: false,
    copied: false,
    openBioModal() {
        this.showBioModal = true;
        document.body.classList.add('overflow-hidden');
    },
    closeBioModal() {
        this.showBioModal = false;
        document.body.classList.remove('overflow-hidden');
    },
    openCvModal() {
        this.showCvModal = true;
        document.body.classList.add('overflow-hidden');
    },
    closeCvModal() {
        this.showCvModal = false;
        document.body.classList.remove('overflow-hidden');
    },
    copyPortfolioUrl() {
        navigator.clipboard.writeText(window.location.href);
        this.copied = true;
        setTimeout(() => { this.copied = false; }, 2000);
    }
}" @keydown.escape.window="closeBioModal(); closeCvModal();"
    class="relative min-h-[90vh] flex items-center justify-center bg-carbon-950/60 text-slate-100 overflow-hidden py-20 lg:py-28 border-b border-carbon-800/80">

    <!-- Architectural Subtle Accent Line -->
    <div
        class="absolute top-0 left-1/2 -translate-x-1/2 w-3/4 h-px bg-gradient-to-r from-transparent via-vermilion-500/20 to-transparent pointer-events-none">
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-10 items-center">

            <!-- Left Column: Content & CTAs -->
            <div class="lg:col-span-7 flex flex-col items-start text-left">

                <!-- 🌟 Engineering Telemetry Identity Badge Pill -> Triggers Bio Modal -->
                <button type="button" @click="openBioModal()" title="{{ __('hero.badge_title') }}"
                    class="group inline-flex items-center gap-2.5 p-1 pr-3.5 rounded-lg bg-carbon-900/90 hover:bg-carbon-850 border border-carbon-800 hover:border-vermilion-500/50 mb-8 transition-all duration-200 cursor-pointer focus:outline-none focus:ring-2 focus:ring-vermilion-500/40">

                    <!-- Mini Avatar (28px) -->
                    <div
                        class="relative w-7 h-7 rounded-md overflow-hidden ring-1 ring-carbon-800 group-hover:ring-vermilion-500/60 transition-all shrink-0 bg-carbon-950">
                        <img src="{{ asset('images/Siakad.jpg') }}" alt="Moch Hasbi Ashidqy"
                            class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-300" />
                        <span
                            class="absolute bottom-0 right-0 w-2 h-2 rounded-full bg-emerald-400 ring-1 ring-carbon-950"
                            title="Open to Work"></span>
                    </div>

                    <!-- Identity & Role -->
                    <span class="text-xs font-semibold text-slate-200 group-hover:text-white transition-colors">
                        Moch Hasbi Ashidqy
                    </span>

                    <span class="w-1 h-1 rounded-full bg-slate-700"></span>

                    <span class="text-xs font-mono font-medium text-vermilion-400 flex items-center gap-1.5">
                        Laravel Backend Developer
                    </span>

                    <span
                        class="text-[10px] text-slate-500 group-hover:text-slate-300 font-mono pl-1 border-l border-carbon-800 transition-colors hidden sm:inline-block">
                        {{ __('hero.bio_arrow') }}
                    </span>
                </button>

                <!-- Main Headline with Strong Typographic Hierarchy -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-[1.12]">
                    Backend Developer
                    <span class="block text-vermilion-500 mt-1 font-extrabold">
                        Built with Laravel
                    </span>
                </h1>

                <!-- Subtitle with High Readability -->
                <p class="mt-6 text-base sm:text-lg text-slate-400 max-w-2xl leading-relaxed font-normal">
                    {{ __('hero.subtitle') }}
                </p>

                <!-- CTAs (View Projects & Curriculum Vitae) -->
                <div class="mt-8 flex flex-wrap items-center gap-4 sm:gap-4 w-full sm:w-auto">
                    <!-- Primary CTA: View Projects -->
                    <a href="#projects"
                        class="w-full sm:w-auto text-center bg-vermilion-600 hover:bg-vermilion-500 text-white font-semibold px-6 py-3 rounded-lg border border-vermilion-500/40 hover:border-vermilion-400 shadow-md shadow-vermilion-600/20 hover:shadow-vermilion-500/30 transition-all duration-200 flex items-center justify-center gap-2 group">
                        <span class="text-sm">{{ __('hero.view_projects') }}</span>
                        <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>

                    <!-- Secondary CTA: Curriculum Vitae -> Triggers CV Download Modal -->
                    <button type="button" @click="openCvModal()"
                        class="w-full sm:w-auto text-center text-slate-200 hover:text-white font-semibold px-5 py-3 rounded-lg border border-carbon-800 hover:border-slate-700 bg-carbon-900/90 hover:bg-carbon-850 transition-all duration-200 flex items-center justify-center gap-2.5 group cursor-pointer focus:outline-none focus:ring-2 focus:ring-slate-600 text-sm">
                        <svg class="w-4 h-4 text-vermilion-400 group-hover:scale-105 transition-transform"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>{{ __('hero.curriculum_vitae') }}</span>
                    </button>
                </div>

                <!-- Clean & Homogeneous Social Links Bar -->
                <div class="mt-10 pt-7 border-t border-carbon-800/90 flex items-center gap-3 w-full">
                    <span class="text-[11px] font-mono uppercase tracking-widest text-slate-500 font-semibold mr-1">
                        {{ __('hero.connect') }}</span>

                    <!-- GitHub -->
                    <a href="https://github.com/muhammadashidqy76-dev" target="_blank" rel="noopener noreferrer"
                        class="text-slate-400 hover:text-white p-2 rounded-lg bg-carbon-900/80 border border-carbon-800 hover:border-slate-700 hover:bg-carbon-850 transition-all"
                        aria-label="GitHub" title="GitHub Profile">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" />
                        </svg>
                    </a>

                    <!-- LinkedIn -->
                    <a href="https://www.linkedin.com/in/moch-hasbi-ashidqy-ashidqy-960157130" target="_blank"
                        rel="noopener noreferrer"
                        class="text-slate-400 hover:text-white p-2 rounded-lg bg-carbon-900/80 border border-carbon-800 hover:border-slate-700 hover:bg-carbon-850 transition-all"
                        aria-label="LinkedIn" title="LinkedIn Profile">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v8.37H9.25V10.9H6.46M7.86 6.74a1.6 1.6 0 1 0 0 3.2 1.6 1.6 0 0 0 0-3.2z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Right Column: High-Precision Code Inspector Window -->
            <div class="lg:col-span-5 w-full">
                <div class="relative">
                    <!-- IDE Window Container -->
                    <div
                        class="relative rounded-xl bg-carbon-900 border border-carbon-800 shadow-xl overflow-hidden font-mono text-xs">

                        <!-- IDE Header Bar -->
                        <div
                            class="px-4 py-2.5 bg-carbon-950 border-b border-carbon-800 flex items-center justify-between select-none">
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-rose-500/90 inline-block"></span>
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-400/90 inline-block"></span>
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400/90 inline-block"></span>
                            </div>

                            <div
                                class="flex items-center gap-1.5 text-slate-300 bg-carbon-900 px-2.5 py-0.5 rounded border border-carbon-800 text-[11px]">
                                <svg class="w-3.5 h-3.5 text-vermilion-400" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                                </svg>
                                <span class="font-medium text-slate-200">Developer.php</span>
                            </div>

                            <div
                                class="text-[10px] tracking-wider uppercase text-slate-400 font-semibold px-2 py-0.5 rounded bg-carbon-900 border border-carbon-800">
                                PHP 8.2
                            </div>
                        </div>

                        <!-- IDE Code Body -->
                        <div class="p-4 sm:p-5 overflow-x-auto text-slate-300 leading-relaxed font-mono">
                            <table class="border-collapse w-full">
                                <tbody>
                                    <tr>
                                        <td
                                            class="pr-4 text-slate-600 text-right select-none w-6 font-mono text-[11px]">
                                            1</td>
                                        <td><span class="text-vermilion-400 font-semibold">&lt;?php</span></td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="pr-4 text-slate-600 text-right select-none w-6 font-mono text-[11px]">
                                            2</td>
                                        <td><span class="text-slate-500 italic">/**</span></td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="pr-4 text-slate-600 text-right select-none w-6 font-mono text-[11px]">
                                            3</td>
                                        <td><span class="text-slate-500 italic">&nbsp;* Hi, I'm Ashidqy 👋</span></td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="pr-4 text-slate-600 text-right select-none w-6 font-mono text-[11px]">
                                            4</td>
                                        <td><span class="text-slate-500 italic">&nbsp;* Backend Developer specializing
                                                in Laravel</span></td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="pr-4 text-slate-600 text-right select-none w-6 font-mono text-[11px]">
                                            5</td>
                                        <td><span class="text-slate-500 italic">&nbsp;* Graduate of Informatics
                                                Engineering, UIN Malang</span></td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="pr-4 text-slate-600 text-right select-none w-6 font-mono text-[11px]">
                                            6</td>
                                        <td><span class="text-slate-500 italic">&nbsp;*/</span></td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="pr-4 text-slate-600 text-right select-none w-6 font-mono text-[11px]">
                                            7</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="pr-4 text-slate-600 text-right select-none w-6 font-mono text-[11px]">
                                            8</td>
                                        <td>
                                            <span class="text-vermilion-400 font-semibold">class</span>
                                            <span class="text-amber-300 font-semibold">Developer</span>
                                            <span class="text-vermilion-400 font-semibold">extends</span>
                                            <span class="text-sky-300">BackendEngineer</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="pr-4 text-slate-600 text-right select-none w-6 font-mono text-[11px]">
                                            9</td>
                                        <td>{</td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="pr-4 text-slate-600 text-right select-none w-6 font-mono text-[11px]">
                                            10</td>
                                        <td class="pl-4">
                                            <span class="text-vermilion-400 font-semibold">protected</span>
                                            <span class="text-sky-200">$stack</span>
                                            <span class="text-slate-400">=</span>
                                            [<span class="text-emerald-400">'Laravel'</span>, <span
                                                class="text-emerald-400">'MySQL'</span>, <span
                                                class="text-emerald-400">'Eloquent'</span>];
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="pr-4 text-slate-600 text-right select-none w-6 font-mono text-[11px]">
                                            11</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="pr-4 text-slate-600 text-right select-none w-6 font-mono text-[11px]">
                                            12</td>
                                        <td class="pl-4">
                                            <span class="text-vermilion-400 font-semibold">public function</span>
                                            <span class="text-amber-300 font-semibold">introduce</span>(): <span
                                                class="text-sky-300">string</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="pr-4 text-slate-600 text-right select-none w-6 font-mono text-[11px]">
                                            13</td>
                                        <td class="pl-4">{</td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="pr-4 text-slate-600 text-right select-none w-6 font-mono text-[11px]">
                                            14</td>
                                        <td class="pl-8">
                                            <span class="text-vermilion-400 font-semibold">return</span>
                                            <span class="text-emerald-400">"Building reliable backend systems, one API
                                                at a time."</span>;
                                        </td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="pr-4 text-slate-600 text-right select-none w-6 font-mono text-[11px]">
                                            15</td>
                                        <td class="pl-4">}</td>
                                    </tr>
                                    <tr>
                                        <td
                                            class="pr-4 text-slate-600 text-right select-none w-6 font-mono text-[11px]">
                                            16</td>
                                        <td>}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- ─── 1. MODAL BIO & PERKENALAN DIRI (Architectural Redesign) ─── -->
    <div x-show="showBioModal" x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 overflow-y-auto" role="dialog"
        aria-modal="true" aria-labelledby="bio-modal-title">

        <!-- Backdrop Overlay -->
        <div x-show="showBioModal" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-150"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="closeBioModal()"
            class="fixed inset-0 bg-black/85 backdrop-blur-sm transition-opacity"></div>

        <!-- Modal Dialog Card -->
        <div x-show="showBioModal" x-transition:enter="ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-98 translate-y-2"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-98 translate-y-2" @click.stop
            class="relative w-full max-w-lg bg-carbon-900 border border-carbon-800 rounded-xl shadow-2xl overflow-hidden z-10 my-8 flex flex-col max-h-[90vh]">

            <!-- Decorative Header Banner with Integrated Avatar -->
            <div class="relative bg-carbon-950 border-b border-carbon-800 px-6 pt-4 pb-0 shrink-0">
                <div class="flex justify-end">
                    <button type="button" @click="closeBioModal()" aria-label="{{ __('bio.close') }}"
                        class="rounded-lg p-1.5 text-slate-400 hover:text-white hover:bg-carbon-850 transition-colors focus:outline-none focus:ring-2 focus:ring-vermilion-500/50 cursor-pointer">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Avatar & Status Badge -->
                <div class="flex items-end justify-between translate-y-6 relative z-10">
                    <div
                        class="relative w-16 h-16 sm:w-20 sm:h-20 rounded-xl overflow-hidden ring-2 ring-carbon-800 border border-carbon-700 bg-carbon-950 shrink-0">
                        <img src="{{ asset('images/Siakad.jpg') }}" alt="Moch Hasbi Ashidqy Profile"
                            class="w-full h-full object-cover object-top" />
                    </div>

                    <span
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-mono font-medium mb-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        {{ __('bio.open_to_work') }}
                    </span>
                </div>
            </div>

            <!-- Profile Info Body -->
            <div class="px-6 pb-6 pt-9 relative flex-1 space-y-5 overflow-y-auto">

                <!-- Name & Education Badge -->
                <div>
                    <h3 id="bio-modal-title" class="text-xl sm:text-2xl font-bold text-white tracking-tight">
                        Moch Hasbi Ashidqy
                    </h3>
                    <div class="flex flex-wrap items-center gap-2 mt-1.5">
                        <span
                            class="inline-flex items-center gap-1 text-xs font-mono font-medium text-amber-300 bg-amber-500/10 border border-amber-500/20 px-2 py-0.5 rounded">
                            {{ __('bio.grad_badge') }}
                        </span>
                        <span class="text-xs text-slate-400 font-medium">
                            {{ __('bio.role') }}
                        </span>
                    </div>
                </div>

                <!-- Clean Semantic Bio Content -->
                <div
                    class="p-4 rounded-lg bg-carbon-950 border border-carbon-800 text-xs sm:text-sm text-slate-300 leading-relaxed space-y-2.5">
                    <p>{!! __('bio.intro_p1') !!}</p>
                    <p>{!! __('bio.intro_p2') !!}</p>
                    <div class="flex flex-wrap gap-1.5 pt-1">
                        <span
                            class="text-[10px] font-mono px-2 py-0.5 rounded bg-carbon-900 text-slate-300 border border-carbon-800">Laravel</span>
                        <span
                            class="text-[10px] font-mono px-2 py-0.5 rounded bg-carbon-900 text-slate-300 border border-carbon-800">PHP</span>
                        <span
                            class="text-[10px] font-mono px-2 py-0.5 rounded bg-carbon-900 text-slate-300 border border-carbon-800">MySQL</span>
                        <span
                            class="text-[10px] font-mono px-2 py-0.5 rounded bg-carbon-900 text-slate-300 border border-carbon-800">Redis</span>
                        <span
                            class="text-[10px] font-mono px-2 py-0.5 rounded bg-carbon-900 text-slate-300 border border-carbon-800">REST
                            API</span>
                    </div>
                </div>

                <!-- Compact Media Sosial Grid -->
                <div class="space-y-2 pt-1">
                    <span
                        class="text-[11px] font-mono uppercase tracking-widest text-slate-400 font-semibold flex items-center gap-1.5">
                        // {{ __('bio.social_title') }}
                    </span>

                    <div class="grid grid-cols-2 gap-2">
                        <!-- LinkedIn -->
                        <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer"
                            class="flex items-center gap-2 py-2 px-3 rounded-lg bg-carbon-950 hover:bg-carbon-850 border border-carbon-800 hover:border-slate-700 text-slate-300 hover:text-white transition-all text-xs font-semibold group">
                            <svg class="w-3.5 h-3.5 text-sky-400 group-hover:scale-105 transition-transform shrink-0"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v8.37H9.25V10.9H6.46M7.86 6.74a1.6 1.6 0 1 0 0 3.2 1.6 1.6 0 0 0 0-3.2z" />
                            </svg>
                            <span class="truncate">LinkedIn</span>
                        </a>

                        <!-- GitHub -->
                        <a href="https://github.com" target="_blank" rel="noopener noreferrer"
                            class="flex items-center gap-2 py-2 px-3 rounded-lg bg-carbon-950 hover:bg-carbon-850 border border-carbon-800 hover:border-slate-700 text-slate-300 hover:text-white transition-all text-xs font-semibold group">
                            <svg class="w-3.5 h-3.5 text-slate-400 group-hover:scale-105 transition-transform shrink-0"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" />
                            </svg>
                            <span class="truncate">GitHub</span>
                        </a>

                        <!-- Email Direct -->
                        <a href="mailto:contact@example.com"
                            class="flex items-center gap-2 py-2 px-3 rounded-lg bg-carbon-950 hover:bg-carbon-850 border border-carbon-800 hover:border-slate-700 text-slate-300 hover:text-white transition-all text-xs font-semibold group">
                            <svg class="w-3.5 h-3.5 text-emerald-400 group-hover:scale-105 transition-transform shrink-0"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="truncate">Email</span>
                        </a>

                        <!-- Instagram -->
                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer"
                            class="flex items-center gap-2 py-2 px-3 rounded-lg bg-carbon-950 hover:bg-carbon-850 border border-carbon-800 hover:border-slate-700 text-slate-300 hover:text-white transition-all text-xs font-semibold group">
                            <svg class="w-3.5 h-3.5 text-vermilion-400 group-hover:scale-105 transition-transform shrink-0"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                            <span class="truncate">Instagram</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- ─── 2. MODAL CURRICULUM VITAE (Architectural Redesign) ─── -->
    <div x-show="showCvModal" x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 overflow-y-auto" role="dialog"
        aria-modal="true" aria-labelledby="cv-modal-title">

        <!-- Backdrop Overlay -->
        <div x-show="showCvModal" x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-150"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="closeCvModal()"
            class="fixed inset-0 bg-black/85 backdrop-blur-sm transition-opacity"></div>

        <!-- Modal Dialog Card -->
        <div x-show="showCvModal" x-transition:enter="ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-98 translate-y-2"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-98 translate-y-2" @click.stop
            class="relative w-full max-w-lg bg-carbon-900 border border-carbon-800 rounded-xl shadow-2xl overflow-hidden z-10 my-8 flex flex-col">

            <!-- Decorative Header Banner with Integrated Icon -->
            <div class="relative bg-carbon-950 border-b border-carbon-800 px-6 pt-4 pb-0 shrink-0">
                <div class="flex justify-end">
                    <button type="button" @click="closeCvModal()" aria-label="{{ __('cv.close') }}"
                        class="rounded-lg p-1.5 text-slate-400 hover:text-white hover:bg-carbon-850 transition-colors focus:outline-none focus:ring-2 focus:ring-vermilion-500/50 cursor-pointer">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Header Icon & Status Badge -->
                <div class="flex items-end justify-between translate-y-6 relative z-10">
                    <div
                        class="relative w-16 h-16 sm:w-20 sm:h-20 rounded-xl ring-2 ring-carbon-800 border border-carbon-700 bg-carbon-950 flex items-center justify-center text-vermilion-400 shrink-0">
                        <svg class="w-8 h-8 sm:w-9 sm:h-9" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>

                    <span
                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-vermilion-500/10 border border-vermilion-500/20 text-vermilion-400 text-xs font-mono font-medium mb-1">
                        {{ __('cv.title') }}
                    </span>
                </div>
            </div>

            <!-- Resume Content Section -->
            <div class="px-6 pb-6 pt-9 relative flex-1 space-y-5 overflow-y-auto">

                <!-- Title & Qualifications Header -->
                <div>
                    <h3 id="cv-modal-title" class="text-xl sm:text-2xl font-bold text-white tracking-tight">
                        {{ __('cv.title') }}
                    </h3>
                    <p class="text-xs sm:text-sm font-medium text-slate-400 mt-0.5">
                        {{ __('cv.candidate_sub') }}
                    </p>
                </div>

                <!-- Quick Qualifications Checklist -->
                <div
                    class="p-4 rounded-lg bg-carbon-950 border border-carbon-800 text-xs sm:text-sm text-slate-300 space-y-2.5 font-mono">
                    <div class="flex items-start gap-2.5">
                        <span class="text-emerald-400 font-bold">✓</span>
                        <span><strong
                                class="text-white font-semibold font-sans">{{ __('cv.education_label') }}</strong>
                            {{ __('cv.education_val') }}</span>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <span class="text-emerald-400 font-bold">✓</span>
                        <span><strong
                                class="text-white font-semibold font-sans">{{ __('cv.specialization_label') }}</strong>
                            {{ __('cv.specialization_val') }}</span>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <span class="text-emerald-400 font-bold">✓</span>
                        <span><strong
                                class="text-white font-semibold font-sans">{{ __('cv.availability_label') }}</strong>
                            {{ __('cv.availability_val') }}</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-2.5 pt-1">
                    <!-- Line 1: Primary Action - Download CV -->
                    <a href="{{ asset('cv/Ashidqy_CV_Laravel_Backend.pdf') }}"
                        download="Ashidqy_CV_Laravel_Backend.pdf"
                        class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-lg bg-vermilion-600 hover:bg-vermilion-500 active:bg-vermilion-700 text-white font-semibold text-sm transition-all duration-150 shadow-md shadow-vermilion-600/20 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>{{ __('cv.download') }}</span>
                    </a>

                    <!-- Line 2: Secondary Action - Copy Portfolio Link -->
                    <button type="button" @click="copyPortfolioUrl()"
                        class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-lg bg-carbon-950 hover:bg-carbon-850 active:bg-carbon-950 text-slate-200 hover:text-white text-xs font-semibold border border-carbon-800 hover:border-slate-700 transition-colors cursor-pointer">
                        <svg x-show="!copied" class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        <svg x-show="copied" class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span
                            x-text="copied ? '{{ __('cv.copied') }}' : '{{ __('cv.copy_link') }}'">{{ __('cv.copy_link') }}</span>
                    </button>
                </div>

            </div>

        </div>

    </div>

</section>
