<header x-data="{
            mobileOpen: false,
            scrolled: false,
            activeSection: '',
            init() {
                const sectionIds = ['projects', 'tech-stack', 'experience'];
                const observedElements = sectionIds
                    .map(id => document.getElementById(id))
                    .filter(Boolean);

                const visibleSections = new Map();

                const observerOptions = {
                    root: null,
                    rootMargin: '-80px 0px -40% 0px',
                    threshold: [0, 0.1, 0.25, 0.5, 0.75]
                };

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            visibleSections.set(entry.target.id, entry.intersectionRatio);
                        } else {
                            visibleSections.delete(entry.target.id);
                        }
                    });

                    if (window.scrollY < 180) {
                        this.activeSection = '';
                        return;
                    }

                    if (visibleSections.size > 0) {
                        let bestSection = '';
                        let maxRatio = -1;
                        for (const [id, ratio] of visibleSections.entries()) {
                            if (ratio > maxRatio) {
                                maxRatio = ratio;
                            }
                        }
                        for (const [id, ratio] of visibleSections.entries()) {
                            if (ratio === maxRatio) {
                                bestSection = id;
                                break;
                            }
                        }
                        if (bestSection) {
                            this.activeSection = bestSection;
                        }
                    } else if (window.scrollY >= 180) {
                        for (let i = observedElements.length - 1; i >= 0; i--) {
                            const el = observedElements[i];
                            const rect = el.getBoundingClientRect();
                            if (rect.top <= 200) {
                                this.activeSection = el.id;
                                break;
                            }
                        }
                    }
                }, observerOptions);

                observedElements.forEach(el => observer.observe(el));

                window.addEventListener('scroll', () => {
                    this.scrolled = (window.pageYOffset > 20);
                    if (window.pageYOffset < 150) {
                        this.activeSection = '';
                    }
                }, { passive: true });
            }
        }"
        class="sticky top-0 z-50 w-full transition-all duration-300 backdrop-blur-md"
        :class="scrolled ? 'bg-carbon-950/95 border-b border-carbon-800 shadow-xl shadow-black/40' : 'bg-carbon-950/80 border-b border-carbon-800/60'">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 sm:h-20">

            <!-- ─── Left: Brand / Logo ─── -->
            <a href="#" class="flex items-center gap-3 group focus:outline-none focus:ring-2 focus:ring-vermilion-500/40 rounded-lg p-1">
                <!-- 3 Colored Window Dots Motif -->
                <div class="hidden sm:flex items-center gap-1 p-1.5 rounded-md bg-carbon-900 border border-carbon-800 group-hover:border-carbon-700 transition-colors">
                    <span class="w-2 h-2 rounded-full bg-rose-500/90"></span>
                    <span class="w-2 h-2 rounded-full bg-amber-400/90"></span>
                    <span class="w-2 h-2 rounded-full bg-emerald-400/90"></span>
                </div>

                <div class="flex items-center font-mono text-sm sm:text-base font-bold text-white tracking-tight">
                    <span class="text-cyan-400 group-hover:-translate-x-0.5 transition-transform">&lt;</span>
                    <span class="px-1 text-slate-100 group-hover:text-white transition-colors">Ashidqy</span>
                    <span class="text-cyan-400 group-hover:translate-x-0.5 transition-transform">/&gt;</span>
                </div>

                <span class="hidden md:inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-mono font-medium bg-cyan-500/10 border border-cyan-500/20 text-cyan-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
                    dev
                </span>
            </a>

            <!-- ─── Center/Right: Desktop Navigation Anchor Links with Scrollspy ─── -->
            <nav class="hidden md:flex items-center gap-1 lg:gap-2 font-mono">
                <!-- Projects -->
                <a href="#projects"
                   class="px-3 py-2 lg:px-3.5 lg:py-2 rounded-lg text-xs transition-all duration-200 border"
                   :class="activeSection === 'projects'
                       ? 'text-cyan-400 bg-cyan-500/10 border-cyan-500/30 font-semibold shadow-sm'
                       : 'text-slate-300 hover:text-white hover:bg-carbon-900/80 border-transparent font-medium'">
                    {{ __('nav.projects') }}
                </a>

                <!-- Tech Stack -->
                <a href="#tech-stack"
                   class="px-3 py-2 lg:px-3.5 lg:py-2 rounded-lg text-xs transition-all duration-200 border"
                   :class="activeSection === 'tech-stack'
                       ? 'text-cyan-400 bg-cyan-500/10 border-cyan-500/30 font-semibold shadow-sm'
                       : 'text-slate-300 hover:text-white hover:bg-carbon-900/80 border-transparent font-medium'">
                    {{ __('nav.tech_stack') }}
                </a>

                <!-- Experience -->
                <a href="#experience"
                   class="px-3 py-2 lg:px-3.5 lg:py-2 rounded-lg text-xs transition-all duration-200 border"
                   :class="activeSection === 'experience'
                       ? 'text-cyan-400 bg-cyan-500/10 border-cyan-500/30 font-semibold shadow-sm'
                       : 'text-slate-300 hover:text-white hover:bg-carbon-900/80 border-transparent font-medium'">
                    {{ __('nav.experience') }}
                </a>
            </nav>

            <!-- ─── Far Right: Language Switcher + CTA / GitHub Button & Mobile Toggle ─── -->
            <div class="flex items-center gap-2 sm:gap-3">

                <!-- Language Switcher Pill -->
                <div class="flex items-center rounded-lg bg-carbon-900 border border-carbon-800 overflow-hidden shadow-sm font-mono">
                    <a href="{{ route('lang.switch', 'id') }}"
                       class="px-2.5 py-1.5 text-[11px] font-semibold transition-all {{ app()->getLocale() === 'id' ? 'bg-cyan-600 text-white' : 'text-slate-400 hover:text-white hover:bg-carbon-850' }}"
                       title="Bahasa Indonesia">
                        ID
                    </a>
                    <span class="w-px h-3 bg-carbon-800"></span>
                    <a href="{{ route('lang.switch', 'en') }}"
                       class="px-2.5 py-1.5 text-[11px] font-semibold transition-all {{ app()->getLocale() === 'en' ? 'bg-cyan-600 text-white' : 'text-slate-400 hover:text-white hover:bg-carbon-850' }}"
                       title="English">
                        EN
                    </a>
                </div>

                <!-- GitHub Button (Desktop: visible on md and up) -->
                <a href="https://github.com/muhammadashidqy76-dev"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="hidden md:inline-flex items-center gap-2 px-3.5 py-2 rounded-lg bg-carbon-900 hover:bg-carbon-850 border border-carbon-800 hover:border-slate-700 text-slate-200 hover:text-white text-xs font-medium font-mono transition-all shadow-sm group">
                    <svg class="w-4 h-4 text-slate-400 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" />
                    </svg>
                    <span>GitHub</span>
                    <svg class="w-3 h-3 text-slate-500 group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>

                <!-- Mobile Hamburger Button (Mobile: visible under md, hidden on md and up) -->
                <button type="button"
                        @click="mobileOpen = !mobileOpen"
                        class="inline-flex md:hidden items-center justify-center p-2 rounded-lg bg-carbon-900 border border-carbon-800 text-slate-400 hover:text-white hover:border-slate-700 transition-colors focus:outline-none focus:ring-2 focus:ring-vermilion-500/40"
                        aria-label="{{ __('nav.toggle_menu') }}">
                    <svg x-show="!mobileOpen" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileOpen" x-cloak class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

            </div>

        </div>
    </div>

    <!-- ─── Mobile Dropdown Menu (Alpine.js) ─── -->
    <div x-show="mobileOpen"
         x-cloak
         x-transition:enter="transition ease-out duration-150"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         @click.away="mobileOpen = false"
         class="md:hidden border-t border-carbon-800 bg-carbon-950/95 backdrop-blur-xl px-4 pt-3 pb-5 shadow-2xl font-mono">
        <nav class="flex flex-col space-y-1">
            <!-- Mobile Projects -->
            <a href="#projects"
               @click="mobileOpen = false"
               class="px-3.5 py-2.5 rounded-lg text-xs transition-colors flex items-center justify-between border-l-2"
               :class="activeSection === 'projects'
                   ? 'text-vermilion-400 bg-vermilion-500/10 border-vermilion-500 font-semibold'
                   : 'text-slate-300 hover:bg-carbon-900 hover:text-white border-transparent font-medium'">
                <span>{{ __('nav.projects') }}</span>
                <span class="font-mono text-[10px]" :class="activeSection === 'projects' ? 'text-vermilion-400 font-bold' : 'text-slate-500'">01</span>
            </a>

            <!-- Mobile Tech Stack -->
            <a href="#tech-stack"
               @click="mobileOpen = false"
               class="px-3.5 py-2.5 rounded-lg text-xs transition-colors flex items-center justify-between border-l-2"
               :class="activeSection === 'tech-stack'
                   ? 'text-vermilion-400 bg-vermilion-500/10 border-vermilion-500 font-semibold'
                   : 'text-slate-300 hover:bg-carbon-900 hover:text-white border-transparent font-medium'">
                <span>{{ __('nav.tech_stack') }}</span>
                <span class="font-mono text-[10px]" :class="activeSection === 'tech-stack' ? 'text-vermilion-400 font-bold' : 'text-slate-500'">02</span>
            </a>

            <!-- Mobile Experience -->
            <a href="#experience"
               @click="mobileOpen = false"
               class="px-3.5 py-2.5 rounded-lg text-xs transition-colors flex items-center justify-between border-l-2"
               :class="activeSection === 'experience'
                   ? 'text-vermilion-400 bg-vermilion-500/10 border-vermilion-500 font-semibold'
                   : 'text-slate-300 hover:bg-carbon-900 hover:text-white border-transparent font-medium'">
                <span>{{ __('nav.experience') }}</span>
                <span class="font-mono text-[10px]" :class="activeSection === 'experience' ? 'text-vermilion-400 font-bold' : 'text-slate-500'">03</span>
            </a>

            <div class="pt-3 mt-2 border-t border-carbon-800">
                <a href="https://github.com"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-vermilion-600 hover:bg-vermilion-500 text-white text-xs font-semibold shadow-md shadow-vermilion-600/20 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" />
                    </svg>
                    <span>{{ __('nav.view_github') }}</span>
                </a>
            </div>
        </nav>
    </div>

</header>
