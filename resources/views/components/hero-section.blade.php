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
         }"
         @keydown.escape.window="closeBioModal(); closeCvModal();"
         class="relative min-h-[90vh] flex items-center justify-center bg-carbon-950/60 text-slate-100 overflow-hidden py-20 lg:py-28 border-b border-carbon-800/80">

    <!-- ─── Atmospheric Cloud Assets & Background Layers ─── -->
    <!-- 1. Cinematic Cloud Asset Background -->
    <div class="absolute inset-0 pointer-events-none select-none overflow-hidden z-0">
        <img src="{{ asset('images/hero-cloud-bg.jpg') }}"
             alt="Cloud Infrastructure Atmosphere"
             class="w-full h-full object-cover object-center opacity-40 mix-blend-screen scale-105 filter contrast-125 brightness-90 animate-pulse duration-[10000ms]" />
        <!-- Radial Atmospheric Core Glow -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_35%,rgba(6,182,212,0.18),transparent_65%)]"></div>
        <!-- Top and Bottom Seamless Vignette Blends -->
        <div class="absolute inset-x-0 top-0 h-40 bg-gradient-to-b from-carbon-950 via-carbon-950/80 to-transparent"></div>
        <div class="absolute inset-x-0 bottom-0 h-48 bg-gradient-to-t from-carbon-950 via-carbon-950/90 to-transparent"></div>
    </div>

    <!-- 2. Decorative Floating SVG Cloud Nodes (Left & Right Flanks) -->
    <div class="absolute inset-0 pointer-events-none select-none overflow-hidden z-0 hidden md:block">
        <!-- Floating Cloud Vector Left -->
        <div class="absolute -left-12 top-1/4 opacity-20 text-cyan-400 blur-[1px] transform -rotate-6">
            <svg class="w-80 h-48" viewBox="0 0 24 24" fill="currentColor">
                <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96z"/>
            </svg>
        </div>
        <!-- Floating Cloud Vector Right -->
        <div class="absolute -right-16 top-1/3 opacity-15 text-sky-400 blur-[1px] transform rotate-12">
            <svg class="w-96 h-56" viewBox="0 0 24 24" fill="currentColor">
                <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96z"/>
            </svg>
        </div>
    </div>

    <!-- Architectural Subtle Accent Line -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-3/4 h-px bg-gradient-to-r from-transparent via-cyan-500/30 to-transparent pointer-events-none z-10"></div>

    <!-- ─── Main Centered Hero Content (Base.org Inspired) ─── -->
    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10 flex flex-col items-center text-center">
        
        <!-- 🌟 Engineering Telemetry Identity Badge Pill -> Triggers Bio Modal -->
        <button type="button"
                @click="openBioModal()"
                title="{{ __('hero.badge_title') }}"
                class="group inline-flex items-center gap-2.5 p-1.5 pr-4 rounded-full bg-carbon-900/90 hover:bg-carbon-850 border border-carbon-800/90 hover:border-cyan-500/50 mb-8 sm:mb-10 transition-all duration-200 cursor-pointer focus:outline-none focus:ring-2 focus:ring-cyan-500/40 shadow-lg shadow-black/40 hover:shadow-cyan-500/10 backdrop-blur-md">
            
            <!-- Mini Avatar (30px) -->
            <div class="relative w-7 h-7 sm:w-8 sm:h-8 rounded-full overflow-hidden ring-1 ring-carbon-700 group-hover:ring-cyan-400 transition-all shrink-0 bg-carbon-950">
                <img src="{{ asset('images/Siakad.jpg') }}"
                     alt="Moch Hasbi Ashidqy"
                     class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-300" />
                <span class="absolute bottom-0 right-0 w-2 h-2 rounded-full bg-emerald-400 ring-1 ring-carbon-950" title="Open to Work"></span>
            </div>

            <!-- Identity & Role -->
            <span class="text-xs sm:text-sm font-semibold text-slate-200 group-hover:text-white transition-colors">
                Moch Hasbi Ashidqy
            </span>
            
            <span class="w-1 h-1 rounded-full bg-slate-700"></span>

            <span class="text-xs font-mono font-medium text-cyan-400 flex items-center gap-1.5 bg-cyan-500/10 border border-cyan-500/20 px-2 py-0.5 rounded-full">
                Aspiring Cloud Engineer
            </span>

            <span class="text-[11px] text-slate-400 group-hover:text-cyan-300 font-mono pl-1 border-l border-carbon-800 transition-colors hidden sm:inline-block">
                {{ __('hero.bio_arrow') }}
            </span>
        </button>

        <!-- Main Headline with Base.org Large Typography & Gradient Glow -->
        <h1 class="text-4xl sm:text-6xl md:text-7xl lg:text-[76px] font-extrabold tracking-tight text-white leading-[1.08] max-w-4xl mx-auto">
            Cloud &amp; Infrastructure
            <span class="block bg-gradient-to-r from-cyan-300 via-sky-400 to-blue-500 bg-clip-text text-transparent mt-2 sm:mt-3">
                Hands-on with Linux &amp; Docker
            </span>
        </h1>

        <!-- Subtitle with High Readability & Generous Width -->
        <p class="mt-6 sm:mt-8 text-base sm:text-lg md:text-xl text-slate-300 max-w-2xl mx-auto leading-relaxed font-normal">
            {{ __('hero.subtitle') }}
        </p>

        <!-- CTAs (Base.org Rounded Pill Buttons with Drop Glow) -->
        <div class="mt-8 sm:mt-10 flex flex-wrap items-center justify-center gap-3.5 sm:gap-4 w-full sm:w-auto">
            <!-- Primary CTA: View Projects -->
            <a href="#projects" 
               class="w-full sm:w-auto text-center bg-cyan-500 hover:bg-cyan-400 text-carbon-950 font-bold px-7 py-3.5 rounded-full border border-cyan-400/50 shadow-lg shadow-cyan-500/25 hover:shadow-cyan-500/40 transition-all duration-200 flex items-center justify-center gap-2 group cursor-pointer text-sm">
                <span>{{ __('hero.view_projects') }}</span>
                <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                </svg>
            </a>
            
            <!-- Secondary CTA: Curriculum Vitae -> Triggers CV Download Modal -->
            <button type="button"
                    @click="openCvModal()"
                    class="w-full sm:w-auto text-center text-slate-200 hover:text-white font-semibold px-6 py-3.5 rounded-full border border-carbon-800 hover:border-slate-600 bg-carbon-900/90 hover:bg-carbon-850 transition-all duration-200 flex items-center justify-center gap-2.5 group cursor-pointer focus:outline-none focus:ring-2 focus:ring-slate-600 text-sm backdrop-blur-sm">
                <svg class="w-4 h-4 text-cyan-400 group-hover:scale-105 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>{{ __('hero.curriculum_vitae') }}</span>
            </button>
        </div>

        <!-- ☁️ Cloud & Infrastructure Capability Micro-Pills -->
        <div class="mt-8 flex flex-wrap items-center justify-center gap-2 sm:gap-2.5 max-w-xl mx-auto font-mono text-[11px] text-slate-400">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-carbon-900/80 border border-carbon-800 backdrop-blur-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
                Linux Systems
            </span>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-carbon-900/80 border border-carbon-800 backdrop-blur-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
                Docker Multi-Stage
            </span>
        </div>

        <!-- Clean Social Links Bar Centered -->
        <div class="mt-10 pt-7 border-t border-carbon-800/80 flex items-center justify-center gap-3 w-full max-w-xs mx-auto">
            <span class="text-[11px] font-mono uppercase tracking-widest text-slate-500 font-semibold mr-1">// {{ __('hero.connect') }}</span>

            <!-- GitHub -->
            <a href="https://github.com/muhammadashidqy76-dev" 
               target="_blank" 
               rel="noopener noreferrer" 
               class="text-slate-400 hover:text-white p-2 rounded-full bg-carbon-900/80 border border-carbon-800 hover:border-slate-700 hover:bg-carbon-850 transition-all" 
               aria-label="GitHub" 
               title="GitHub Profile">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" />
                </svg>
            </a>

            <!-- LinkedIn -->
            <a href="https://www.linkedin.com/in/moch-hasbi-ashidqy-ashidqy-960157130" 
               target="_blank" 
               rel="noopener noreferrer" 
               class="text-slate-400 hover:text-white p-2 rounded-full bg-carbon-900/80 border border-carbon-800 hover:border-slate-700 hover:bg-carbon-850 transition-all" 
               aria-label="LinkedIn" 
               title="LinkedIn Profile">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v8.37H9.25V10.9H6.46M7.86 6.74a1.6 1.6 0 1 0 0 3.2 1.6 1.6 0 0 0 0-3.2z" />
                </svg>
            </a>

            <!-- Email -->
            <a href="mailto:contact@example.com" 
               class="text-slate-400 hover:text-white p-2 rounded-full bg-carbon-900/80 border border-carbon-800 hover:border-slate-700 hover:bg-carbon-850 transition-all" 
               aria-label="Email" 
               title="Kirim Email">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </a>
        </div>

    </div>

    <!-- ─── 1. MODAL BIO & PERKENALAN DIRI (Architectural Redesign) ─── -->
    <div x-show="showBioModal"
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 overflow-y-auto"
         role="dialog"
         aria-modal="true"
         aria-labelledby="bio-modal-title">

        <!-- Backdrop Overlay -->
        <div x-show="showBioModal"
             x-transition:enter="ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="closeBioModal()"
             class="fixed inset-0 bg-black/85 backdrop-blur-sm transition-opacity"></div>

        <!-- Modal Dialog Card -->
        <div x-show="showBioModal"
             x-transition:enter="ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-98 translate-y-2"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-98 translate-y-2"
             @click.stop
             class="relative w-full max-w-lg bg-carbon-900 border border-carbon-800 rounded-xl shadow-2xl overflow-hidden z-10 my-8 flex flex-col max-h-[90vh]">

            <!-- Decorative Header Banner with Integrated Avatar -->
            <div class="relative bg-carbon-950 border-b border-carbon-800 px-6 pt-4 pb-0 shrink-0">
                <div class="flex justify-end">
                    <button type="button"
                            @click="closeBioModal()"
                            aria-label="{{ __('bio.close') }}"
                            class="rounded-lg p-1.5 text-slate-400 hover:text-white hover:bg-carbon-850 transition-colors focus:outline-none focus:ring-2 focus:ring-vermilion-500/50 cursor-pointer">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Avatar & Status Badge -->
                <div class="flex items-end justify-between translate-y-6 relative z-10">
                    <div class="relative w-16 h-16 sm:w-20 sm:h-20 rounded-xl overflow-hidden ring-2 ring-carbon-800 border border-carbon-700 bg-carbon-950 shrink-0">
                        <img src="{{ asset('images/Siakad.jpg') }}"
                             alt="Moch Hasbi Ashidqy Profile"
                             class="w-full h-full object-cover object-top" />
                    </div>

                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-mono font-medium mb-1">
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
                        <span class="inline-flex items-center gap-1 text-xs font-mono font-medium text-amber-300 bg-amber-500/10 border border-amber-500/20 px-2 py-0.5 rounded">
                            {{ __('bio.grad_badge') }}
                        </span>
                        <span class="text-xs text-slate-400 font-medium">
                            {{ __('bio.role') }}
                        </span>
                    </div>
                </div>

                <!-- Clean Semantic Bio Content -->
                <div class="p-4 rounded-lg bg-carbon-950 border border-carbon-800 text-xs sm:text-sm text-slate-300 leading-relaxed space-y-2.5">
                    <p>{!! __('bio.intro_p1') !!}</p>
                    <p>{!! __('bio.intro_p2') !!}</p>
                    <div class="flex flex-wrap gap-1.5 pt-1">
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-carbon-900 text-cyan-300 border border-carbon-800">Linux / Bash</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-carbon-900 text-cyan-300 border border-carbon-800">Docker</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-carbon-900 text-cyan-300 border border-carbon-800">Redis Cache</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-carbon-900 text-cyan-300 border border-carbon-800">Nginx</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-carbon-900 text-cyan-300 border border-carbon-800">Cloud Fundamentals</span>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-carbon-900 text-cyan-300 border border-carbon-800">Git &amp; CI/CD</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- ─── 2. MODAL CURRICULUM VITAE (Architectural Redesign) ─── -->
    <div x-show="showCvModal"
         x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 overflow-y-auto"
         role="dialog"
         aria-modal="true"
         aria-labelledby="cv-modal-title">

        <!-- Backdrop Overlay -->
        <div x-show="showCvModal"
             x-transition:enter="ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="closeCvModal()"
             class="fixed inset-0 bg-black/85 backdrop-blur-sm transition-opacity"></div>

        <!-- Modal Dialog Card -->
        <div x-show="showCvModal"
             x-transition:enter="ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-98 translate-y-2"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-98 translate-y-2"
             @click.stop
             class="relative w-full max-w-lg bg-carbon-900 border border-carbon-800 rounded-xl shadow-2xl overflow-hidden z-10 my-8 flex flex-col">

            <!-- Decorative Header Banner with Integrated Icon -->
            <div class="relative bg-carbon-950 border-b border-carbon-800 px-6 pt-4 pb-0 shrink-0">
                <div class="flex justify-end">
                    <button type="button"
                            @click="closeCvModal()"
                            aria-label="{{ __('cv.close') }}"
                            class="rounded-lg p-1.5 text-slate-400 hover:text-white hover:bg-carbon-850 transition-colors focus:outline-none focus:ring-2 focus:ring-vermilion-500/50 cursor-pointer">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Header Icon & Status Badge -->
                <div class="flex items-end justify-between translate-y-6 relative z-10">
                    <div class="relative w-16 h-16 sm:w-20 sm:h-20 rounded-xl ring-2 ring-carbon-800 border border-carbon-700 bg-carbon-950 flex items-center justify-center text-cyan-400 shrink-0">
                        <svg class="w-8 h-8 sm:w-9 sm:h-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>

                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 text-xs font-mono font-medium mb-1">
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
                <div class="p-4 rounded-lg bg-carbon-950 border border-carbon-800 text-xs sm:text-sm text-slate-300 space-y-2.5 font-mono">
                    <div class="flex items-start gap-2.5">
                        <span class="text-emerald-400 font-bold">✓</span>
                        <span><strong class="text-white font-semibold font-sans">{{ __('cv.education_label') }}</strong> {{ __('cv.education_val') }}</span>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <span class="text-emerald-400 font-bold">✓</span>
                        <span><strong class="text-white font-semibold font-sans">{{ __('cv.specialization_label') }}</strong> {{ __('cv.specialization_val') }}</span>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <span class="text-emerald-400 font-bold">✓</span>
                        <span><strong class="text-white font-semibold font-sans">{{ __('cv.availability_label') }}</strong> {{ __('cv.availability_val') }}</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-2.5 pt-1">
                    <!-- Line 1: Primary Action - Download CV -->
                    <a href="{{ asset('cv/Ashidqy_CV_Cloud_Engineering.pdf') }}"
                       download="Ashidqy_CV_Cloud_Engineering.pdf"
                       class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-lg bg-vermilion-600 hover:bg-vermilion-500 active:bg-vermilion-700 text-white font-semibold text-sm transition-all duration-150 shadow-md shadow-vermilion-600/20 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>{{ __('cv.download') }}</span>
                    </a>

                    <!-- Line 2: Secondary Action - Copy Portfolio Link -->
                    <button type="button"
                            @click="copyPortfolioUrl()"
                            class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-lg bg-carbon-950 hover:bg-carbon-850 active:bg-carbon-950 text-slate-200 hover:text-white text-xs font-semibold border border-carbon-800 hover:border-slate-700 transition-colors cursor-pointer">
                        <svg x-show="!copied" class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        <svg x-show="copied" class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span x-text="copied ? '{{ __('cv.copied') }}' : '{{ __('cv.copy_link') }}'">{{ __('cv.copy_link') }}</span>
                    </button>
                </div>

            </div>

        </div>

    </div>

</section>
