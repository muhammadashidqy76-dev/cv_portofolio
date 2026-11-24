<nav x-data="{ open: false }" class="bg-white/90 dark:bg-carbon-950/90 border-b border-slate-200 dark:border-carbon-800 sticky top-0 z-40 backdrop-blur-md shadow-sm dark:shadow-none">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-6">
                <!-- Brand / Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <!-- 3 Colored Window Dots Motif -->
                        <div class="flex items-center gap-1 p-1 rounded-md bg-slate-100 dark:bg-carbon-900 border border-slate-200 dark:border-carbon-800">
                            <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                            <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        </div>

                        <div class="flex items-center font-mono text-sm sm:text-base font-bold text-slate-900 dark:text-white tracking-tight">
                            <span class="text-vermilion-600 dark:text-vermilion-400">&lt;</span>
                            <span class="px-0.5 text-slate-800 dark:text-slate-100 group-hover:text-slate-900 dark:group-hover:text-white transition-colors">Ashidqy</span>
                            <span class="text-vermilion-600 dark:text-vermilion-400">/&gt;</span>
                        </div>

                        <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-mono font-medium bg-vermilion-500/10 border border-vermilion-500/20 text-vermilion-600 dark:text-vermilion-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-vermilion-500 animate-pulse"></span>
                            CMS
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:-my-px sm:flex items-center">
                    <!-- 1. Overview (Dashboard) -->
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Overview') }}
                    </x-nav-link>

                    <!-- 2. Featured Projects (Active) -->
                    <x-nav-link :href="route('projects.index')" :active="request()->routeIs('projects.*')">
                        {{ __('Projects') }}
                    </x-nav-link>

                    <!-- 3. Tech Stack (Active) -->
                    <x-nav-link :href="route('tech-stack.index')" :active="request()->routeIs('tech-stack.*')">
                        {{ __('Tech Stack') }}
                    </x-nav-link>

                    <!-- 4. Work Experience (Active) -->
                    <x-nav-link :href="route('work-experience.index')" :active="request()->routeIs('work-experience.*')">
                        {{ __('Experience') }}
                    </x-nav-link>

                    <!-- 5. Journey & Kredensial (Active) -->
                    <x-nav-link :href="route('journey.index')" :active="request()->routeIs('journey.*')">
                        {{ __('Journey') }}
                    </x-nav-link>

                    <!-- 6. Learning Log / Notes (Active) -->
                    <x-nav-link :href="route('learning-log.index')" :active="request()->routeIs('learning-log.*')">
                        {{ __('Notes') }}
                    </x-nav-link>

                    <!-- 7. Roadmap IT Support (Active) -->
                    <x-nav-link :href="route('roadmap-it-support.index')" :active="request()->routeIs('roadmap-it-support.*')">
                        {{ __('Roadmap IT') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Controls: View Public Web & User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:gap-3">
                <!-- Theme Toggle -->
                <x-theme-toggle />

                <!-- Public Site Link -->
                <a href="{{ url('/') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-mono font-medium text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white bg-slate-100 dark:bg-carbon-900 hover:bg-slate-200 dark:hover:bg-carbon-850 border border-slate-200 dark:border-carbon-800 hover:border-slate-300 dark:hover:border-carbon-700 transition-colors">
                    <span>Lihat Website</span>
                    <svg class="w-3.5 h-3.5 text-slate-500 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>

                <!-- User Profile Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-3 py-1.5 border border-slate-200 dark:border-carbon-800 text-xs font-mono font-medium rounded-lg text-slate-800 dark:text-slate-200 bg-white dark:bg-carbon-900 hover:bg-slate-50 dark:hover:bg-carbon-850 hover:border-slate-300 dark:hover:border-carbon-700 focus:outline-none transition ease-in-out duration-150 cursor-pointer shadow-sm dark:shadow-none">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="fill-current h-3.5 w-3.5 text-slate-500 dark:text-slate-400" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white">
                            {{ __('Profil Akun') }}
                        </x-dropdown-link>

                        <!-- Authentication Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-rose-600 dark:text-rose-400 hover:text-rose-700 dark:hover:text-rose-300 hover:bg-rose-50 dark:hover:bg-rose-500/10 font-medium">
                                {{ __('Keluar (Log Out)') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Right Controls (Theme Toggle & Hamburger) -->
            <div class="-me-2 flex items-center sm:hidden gap-1.5">
                <x-theme-toggle />
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-carbon-900 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-slate-200 dark:border-carbon-800 bg-white dark:bg-carbon-950 divide-y divide-slate-100 dark:divide-carbon-900 transition-all">
        <div class="pt-2 pb-3 space-y-1 px-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <span class="font-mono text-xs">00.</span> {{ __('Overview') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('projects.index')" :active="request()->routeIs('projects.*')">
                <span class="font-mono text-xs">01.</span> {{ __('Featured Projects') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('tech-stack.index')" :active="request()->routeIs('tech-stack.*')">
                <span class="font-mono text-xs">02.</span> {{ __('Tech Stack') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('work-experience.index')" :active="request()->routeIs('work-experience.*')">
                <span class="font-mono text-xs">03.</span> {{ __('Work Experience') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('journey.index')" :active="request()->routeIs('journey.*')">
                <span class="font-mono text-xs">04.</span> {{ __('Journey & Kredensial') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('learning-log.index')" :active="request()->routeIs('learning-log.*')">
                <span class="font-mono text-xs">05.</span> {{ __('Notes & Tech Logs') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('roadmap-it-support.index')" :active="request()->routeIs('roadmap-it-support.*')">
                <span class="font-mono text-xs">06.</span> {{ __('Roadmap IT Support') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-3 pb-3 border-t border-slate-200 dark:border-carbon-800/80 px-4">
            <div class="flex items-center gap-2 mb-3 py-1">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 shrink-0"></span>
                <div class="min-w-0">
                    <div class="font-mono text-xs font-semibold text-slate-900 dark:text-white truncate">{{ Auth::user()->name }}</div>
                    <div class="font-mono text-[11px] text-slate-500 truncate">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="space-y-1">
                <a href="{{ url('/') }}" target="_blank" class="flex items-center justify-between py-2 px-2.5 rounded-lg text-xs font-mono font-medium text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-carbon-900 transition-colors">
                    <span>Lihat Website Publik</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>
                <a href="{{ route('profile.edit') }}" class="flex items-center justify-between py-2 px-2.5 rounded-lg text-xs font-mono font-medium text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-carbon-900 transition-colors">
                    <span>Pengaturan Profil</span>
                    <span class="text-slate-400">&rarr;</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="flex items-center justify-between py-2 px-2.5 rounded-lg text-xs font-mono font-semibold text-rose-600 dark:text-rose-400 hover:text-rose-700 dark:hover:text-rose-300 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition-colors">
                        <span>Keluar (Log Out)</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
