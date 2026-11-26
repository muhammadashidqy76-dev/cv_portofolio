<section x-data="{
    showBioModal: false,
    showCvModal: false,
    copied: false,
    focusTrack: '{{ strtolower(request('focus', 'it-support')) }}',
    init() {
        const urlParams = new URLSearchParams(window.location.search);
        const urlFocus = urlParams.get('focus');
        if (urlFocus) {
            const val = urlFocus.toLowerCase();
            if (['backend', 'laravel'].includes(val)) this.focusTrack = 'backend';
            else if (['cloud', 'aws'].includes(val)) this.focusTrack = 'cloud';
            else if (['it-support', 'it_support', 'itsupport'].includes(val)) this.focusTrack = 'it-support';
        } else {
            this.focusTrack = 'it-support';
        }
    },
    setFocus(track) {
        if (this.focusTrack === track) {
            this.focusTrack = 'all';
            const url = new URL(window.location.href);
            url.searchParams.delete('focus');
            window.history.replaceState({}, '', url.pathname + (url.search ? url.search : '') + url.hash);
        } else {
            this.focusTrack = track;
            const url = new URL(window.location.href);
            url.searchParams.set('focus', track);
            window.history.replaceState({}, '', url.pathname + url.search + url.hash);
        }
    },
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
    class="relative min-h-[88vh] flex items-center justify-center bg-slate-50 dark:bg-[#0a0a0c] text-slate-800 dark:text-slate-100 overflow-hidden py-20 sm:py-28 lg:py-32 border-b border-slate-200/80 dark:border-white/[0.08]">

    <!-- ─── Developer-Centric Background Canvas (Linear/Cursor Dot-Grid & Ambient Radial Depth) ─── -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none select-none">
        <!-- Technical Dot-Grid Matrix with Smooth Center-Focused Radial Mask -->
        <div class="absolute inset-0 bg-[radial-gradient(#00000012_1px,transparent_1px)] dark:bg-[radial-gradient(#ffffff18_1px,transparent_1px)] [background-size:24px_24px] [mask-image:radial-gradient(ellipse_65%_55%_at_50%_50%,#000_60%,transparent_100%)]"></div>

        <!-- Ambient Radial Gradient Glow behind Hero text for subtle dimension -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[550px] sm:w-[750px] h-[350px] sm:h-[450px] bg-gradient-to-b from-vermilion-500/12 via-rose-600/5 to-transparent blur-[130px] rounded-full"></div>

        <!-- Sleek Top Accent Line -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-3/4 max-w-4xl h-px bg-gradient-to-r from-transparent via-vermilion-500/30 to-transparent"></div>
    </div>

    <!-- ─── Main Content Container (Centered Alignment) ─── -->
    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10">
        <div class="flex flex-col items-center text-center space-y-6 sm:space-y-8">

            <!-- 1. Small Top Badge (Pill with Thin Border & White/Red Text, Triggers Bio Modal) -->
            <button type="button" @click="openBioModal()" title="Klik untuk melihat bio & profil lengkap"
                class="group inline-flex items-center gap-2 sm:gap-2.5 px-3.5 py-1.5 rounded-full bg-white dark:bg-white/[0.03] hover:bg-slate-100 dark:hover:bg-white/[0.07] border border-slate-300 dark:border-white/10 hover:border-vermilion-500/50 backdrop-blur-md transition-all duration-200 cursor-pointer shadow-sm focus:outline-none focus:ring-1 focus:ring-vermilion-500/50">
                <!-- Mini Avatar with Live Dot Indicator -->
                <div class="relative w-5 h-5 rounded-full overflow-hidden ring-1 ring-slate-300 dark:ring-white/10 group-hover:ring-vermilion-500/60 transition-all shrink-0 bg-slate-100 dark:bg-carbon-950">
                    <img src="{{ asset('images/Siakad.jpg') }}" alt="Moch Hasbi Ashidqy"
                        class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-300" />
                    <span class="absolute bottom-0 right-0 w-1.5 h-1.5 rounded-full bg-emerald-400 ring-1 ring-white dark:ring-carbon-950" title="Open to Work"></span>
                </div>

                <span class="text-xs font-medium text-slate-800 dark:text-white tracking-tight">
                    Moch Hasbi Ashidqy
                </span>

                <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-slate-600 dark:group-hover:text-slate-300 transition-colors ml-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- 2. Main Headline (Large, Bold, Clean White Text) -->
            <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight text-slate-900 dark:text-white leading-[1.12] max-w-4xl">
                Infrastructure, Backend &amp;
                <span class="block mt-1 sm:mt-2 text-slate-900 dark:text-white font-extrabold">
                    System Reliability
                </span>
            </h1>

            <!-- 3. Sub-headline / Deskripsi (Abu-abu Terang, Clean) -->
            <p class="text-base sm:text-lg md:text-xl text-slate-600 dark:text-slate-400 max-w-2xl sm:max-w-3xl leading-relaxed font-normal">
                Fokus pada operasional IT Support, pemecahan masalah jaringan &amp; hardware sistem, serta fondasi otomasi dan infrastruktur modern.
            </p>

            <!-- 4. Tombol Call-to-Action (CTA) Berdampingan di Tengah -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3.5 sm:gap-4 w-full sm:w-auto pt-1">
                <!-- Tombol Utama: Lihat Projek (Aksen Warna Merah Khas) -->
                <a href="#projects"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg bg-vermilion-600 hover:bg-vermilion-500 active:bg-vermilion-700 text-white font-semibold text-sm border border-vermilion-500/50 shadow-lg shadow-vermilion-600/20 hover:shadow-vermilion-500/30 transition-all duration-200 group cursor-pointer">
                    <span>Lihat Projek</span>
                    <svg class="w-4 h-4 group-hover:translate-y-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>

                <!-- Tombol Sekunder: Curriculum Vitae -->
                <button type="button" @click="openCvModal()"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg text-slate-700 dark:text-slate-200 hover:text-slate-900 dark:hover:text-white font-semibold text-sm border border-slate-300 dark:border-white/10 hover:border-slate-400 dark:hover:border-white/20 bg-white dark:bg-white/[0.04] hover:bg-slate-100 dark:hover:bg-white/[0.08] backdrop-blur-sm transition-all duration-200 group cursor-pointer focus:outline-none focus:ring-1 focus:ring-slate-400 dark:focus:ring-slate-500 shadow-sm">
                    <svg class="w-4 h-4 text-vermilion-500 dark:text-vermilion-400 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Curriculum Vitae</span>
                </button>
            </div>

            <!-- 5. Tech Stack Pills (Career Pillar Spotlight: IT Support Active, Others Locked) -->
            <div class="flex flex-col items-center gap-2 pt-2">
                <div class="flex flex-wrap items-center justify-center gap-2.5 sm:gap-3">
                    <!-- IT Support (ACTIVE PRIMARY PILLAR) -->
                    <button type="button"
                        title="Fokus Utama: IT Support & System Reliability"
                        class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-mono backdrop-blur-sm transition-all duration-300 cursor-default focus:outline-none bg-indigo-600 dark:bg-indigo-600 border border-indigo-500 dark:border-indigo-500 shadow-md shadow-indigo-600/30 ring-2 ring-indigo-500/30 scale-[1.03]"
                        style="color: #ffffff !important;">
                        <!-- Active Pulsing Dot -->
                        <span class="w-1.5 h-1.5 rounded-full animate-pulse shrink-0" style="background-color: #ffffff !important;"></span>

                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color: #ffffff !important; stroke: #ffffff !important;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="font-semibold" style="color: #ffffff !important;">IT Support</span>
                    </button>

                    <!-- Laravel Backend (LOCKED / NEXT PATH) -->
                    <!-- <div class="relative select-none" title="Fase pengembangan berikutnya (Next Learning Path) — saat ini fokus pada IT Support & Systems">
                        <button type="button" disabled
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-mono opacity-60 blur-[0.3px] border border-dashed border-slate-300 dark:border-white/10 text-slate-600 dark:text-slate-400 bg-slate-100/90 dark:bg-white/[0.02] cursor-not-allowed">
                            <svg class="w-3.5 h-3.5 shrink-0 text-rose-500/70" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                            </svg>
                            <span class="font-medium text-slate-600 dark:text-slate-400">Laravel</span>
                            <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded text-[9px] font-mono font-medium bg-slate-200/80 dark:bg-white/[0.06] text-slate-600 dark:text-slate-400 border border-slate-300/60 dark:border-white/10">
                                🔒 Next Path
                            </span>
                        </button>
                    </div> -->

                    <!-- AWS Cloud (LOCKED / NEXT PATH) -->
                    <!-- <div class="relative select-none" title="Fase pengembangan berikutnya (Next Learning Path) — saat ini fokus pada IT Support & Systems">
                        <button type="button" disabled
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-mono opacity-60 blur-[0.3px] border border-dashed border-slate-300 dark:border-white/10 text-slate-600 dark:text-slate-400 bg-slate-100/90 dark:bg-white/[0.02] cursor-not-allowed">
                            <svg class="w-3.5 h-3.5 shrink-0 text-amber-500/70" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 00-9.78 2.096A4.001 4.001 0 003 15z" />
                            </svg>
                            <span class="font-medium text-slate-600 dark:text-slate-400">AWS Cloud</span>
                            <span class="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded text-[9px] font-mono font-medium bg-slate-200/80 dark:bg-white/[0.06] text-slate-600 dark:text-slate-400 border border-slate-300/60 dark:border-white/10">
                                🔒 Next Path
                            </span>
                        </button>
                    </div>
                </div> -->

                <!-- Role Learning Path Quick Link (Khusus IT Support) -->
                <div class="pt-1">
                    <a href="{{ route('roadmap.index', ['roleSlug' => 'it-support']) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-indigo-50/90 dark:bg-indigo-500/15 hover:bg-indigo-100 dark:hover:bg-indigo-500/25 border border-indigo-300 dark:border-indigo-500/50 hover:border-indigo-400 text-indigo-900 dark:text-indigo-300 hover:text-indigo-950 dark:hover:text-white font-mono text-xs font-semibold shadow-sm dark:shadow-lg dark:shadow-indigo-500/10 transition-all duration-200 group">
                        <span class="w-2 h-2 rounded-full bg-indigo-600 dark:bg-indigo-400 animate-pulse"></span>
                        <span>Buka Learning Path &amp; Checklist IT Support</span>
                        <svg class="w-3.5 h-3.5 text-indigo-700 dark:text-indigo-400 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- 6. Footer Connect (// CONNECT: GitHub & LinkedIn) -->
            <div class="pt-6 sm:pt-8 border-t border-white/[0.08] w-full max-w-2xl flex items-center justify-center gap-3 text-xs font-mono text-slate-400">
                <span class="text-[11px] uppercase tracking-wider text-slate-500 font-semibold">CONNECT:</span>

                <!-- GitHub -->
                <a href="https://github.com/muhammadashidqy76-dev" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/[0.03] hover:bg-white/[0.08] border border-white/10 hover:border-white/20 text-slate-300 hover:text-white transition-all group backdrop-blur-sm"
                    aria-label="GitHub" title="GitHub Profile">
                    <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" />
                    </svg>
                    <span>GitHub</span>
                </a>

                <!-- LinkedIn -->
                <a href="https://www.linkedin.com/in/moch-hasbi-ashidqy-ashidqy-960157130" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white/[0.03] hover:bg-white/[0.08] border border-white/10 hover:border-white/20 text-slate-300 hover:text-white transition-all group backdrop-blur-sm"
                    aria-label="LinkedIn" title="LinkedIn Profile">
                    <svg class="w-3.5 h-3.5 text-sky-400 group-hover:scale-105 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v8.37H9.25V10.9H6.46M7.86 6.74a1.6 1.6 0 1 0 0 3.2 1.6 1.6 0 0 0 0-3.2z" />
                    </svg>
                    <span>LinkedIn</span>
                </a>
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
                    <h3 id="bio-modal-title" class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white tracking-tight">
                        Moch Hasbi Ashidqy
                    </h3>
                    <div class="flex flex-wrap items-center gap-2 mt-1.5">
                        <span
                            class="inline-flex items-center gap-1 text-xs font-mono font-medium text-amber-300 bg-amber-500/10 border border-amber-500/20 px-2 py-0.5 rounded">
                            {{ __('bio.grad_badge') }}
                        </span>
                        <span class="text-xs text-slate-400 font-medium">
                            IT Support, Cloud &amp; Backend Engineer
                        </span>
                    </div>
                </div>

                <!-- Clean Semantic Bio Content -->
                <div
                    class="p-4 rounded-lg bg-carbon-950 border border-carbon-800 text-xs sm:text-sm text-slate-300 leading-relaxed space-y-2.5">
                    <p>{!! __('bio.intro_p1') !!}</p>
                </div>

                <!-- Compact Media Sosial Grid -->
                <div class="space-y-2 pt-1">
                    <span
                        class="text-[11px] font-mono uppercase tracking-widest text-slate-400 font-semibold flex items-center gap-1.5">
                        {{ __('bio.social_title') }}
                    </span>

                    <div class="grid grid-cols-2 gap-2">
                        <!-- LinkedIn -->
                        <a href="https://www.linkedin.com/in/moch-hasbi-ashidqy-ashidqy-960157130" target="_blank" rel="noopener noreferrer"
                            class="flex items-center gap-2 py-2 px-3 rounded-lg bg-carbon-950 hover:bg-carbon-850 border border-carbon-800 hover:border-slate-700 text-slate-300 hover:text-white transition-all text-xs font-semibold group">
                            <svg class="w-3.5 h-3.5 text-sky-400 group-hover:scale-105 transition-transform shrink-0"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v8.37H9.25V10.9H6.46M7.86 6.74a1.6 1.6 0 1 0 0 3.2 1.6 1.6 0 0 0 0-3.2z" />
                            </svg>
                            <span class="truncate">LinkedIn</span>
                        </a>

                        <!-- GitHub -->
                        <a href="https://github.com/muhammadashidqy76-dev" target="_blank" rel="noopener noreferrer"
                            class="flex items-center gap-2 py-2 px-3 rounded-lg bg-carbon-950 hover:bg-carbon-850 border border-carbon-800 hover:border-slate-700 text-slate-300 hover:text-white transition-all text-xs font-semibold group">
                            <svg class="w-3.5 h-3.5 text-slate-400 group-hover:scale-105 transition-transform shrink-0"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" />
                            </svg>
                            <span class="truncate">GitHub</span>
                        </a>

                        <!-- Email Direct -->
                        <a href="mailto:muhammadashidqy76@gmail.com"
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
                <div class="flex items-center justify-center translate-y-6 relative z-10">
                    <div class="relative w-16 h-16 sm:w-20 sm:h-20 rounded-xl ring-2 ring-carbon-800 border border-carbon-700 bg-carbon-950 flex items-center justify-center text-vermilion-400 shrink-0">
                        <svg class="w-8 h-8 sm:w-9 sm:h-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Resume Content Section -->
            <div class="px-6 pb-6 pt-9 relative flex-1 space-y-5 overflow-y-auto">

                <!-- Title & Qualifications Header -->
                <div class="text-center">
                    <h3 id="cv-modal-title" class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white tracking-tight">
                        {{ __('cv.title') }}
                    </h3>
                </div>
                <!-- Action Buttons -->
                <div class="space-y-2.5 pt-1 font-mono">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                        <!-- Line 1a: Primary Action - Lihat Dokumen CV (Preview Tab Baru) -->
                        <a href="{{ asset('storage/cv/Ashidqy_CV_Laravel_Backend.pdf') }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-full flex items-center justify-center gap-2 py-3 px-3 rounded-lg bg-vermilion-600 hover:bg-vermilion-500 active:bg-vermilion-700 text-white font-semibold text-xs sm:text-sm transition-all duration-150 shadow-md shadow-vermilion-600/20 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <span>{{ __('journey.doc') }} ↗</span>
                        </a>

                        <!-- Line 1b: Secondary Action - Download CV -->
                        <a href="{{ asset('storage/cv/Ashidqy_CV_Laravel_Backend.pdf') }}"
                            download="Ashidqy_CV_Laravel_Backend.pdf"
                            class="w-full flex items-center justify-center gap-2 py-3 px-3 rounded-lg bg-slate-100 hover:bg-slate-200 dark:bg-carbon-950 dark:hover:bg-carbon-850 text-slate-800 dark:text-slate-200 font-semibold text-xs sm:text-sm border border-slate-300 dark:border-carbon-800 transition-all duration-150 cursor-pointer">
                            <svg class="w-4 h-4 text-slate-600 dark:text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span>{{ __('cv.download') }}</span>
                        </a>
                    </div>

                    <!-- Line 2: Copy Portfolio Link -->
                    <button type="button" @click="copyPortfolioUrl()"
                        class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-lg bg-slate-100 hover:bg-slate-200 dark:bg-carbon-950 dark:hover:bg-carbon-850 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white text-xs font-semibold border border-slate-200 dark:border-carbon-800 hover:border-slate-300 dark:hover:border-slate-700 transition-colors cursor-pointer">
                        <svg x-show="!copied" class="w-4 h-4 text-slate-500 dark:text-slate-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        <svg x-show="copied" class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24"
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
