<nav x-data="{ open: false }" class="bg-carbon-950/90 border-b border-carbon-800 sticky top-0 z-40 backdrop-blur-md">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-6">
                <!-- Brand / Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <!-- 3 Colored Window Dots Motif -->
                        <div class="flex items-center gap-1 p-1 rounded-md bg-carbon-900 border border-carbon-800">
                            <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                            <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        </div>

                        <div class="flex items-center font-mono text-sm sm:text-base font-bold text-white tracking-tight">
                            <span class="text-vermilion-400">&lt;</span>
                            <span class="px-0.5 text-slate-100 group-hover:text-white transition-colors">Ashidqy</span>
                            <span class="text-vermilion-400">/&gt;</span>
                        </div>

                        <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[10px] font-mono font-medium bg-vermilion-500/10 border border-vermilion-500/20 text-vermilion-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-vermilion-400 animate-pulse"></span>
                            cms
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
                </div>
            </div>

            <!-- Right Controls: View Public Web & User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:gap-3">
                <!-- Public Site Link -->
                <a href="{{ url('/') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-mono font-medium text-slate-300 hover:text-white bg-carbon-900 hover:bg-carbon-850 border border-carbon-800 hover:border-carbon-700 transition-colors">
                    <span>Lihat Website</span>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>

                <!-- User Profile Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-3 py-1.5 border border-carbon-800 text-xs font-mono font-medium rounded-lg text-slate-200 bg-carbon-900 hover:border-carbon-700 focus:outline-none transition ease-in-out duration-150 cursor-pointer">
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="fill-current h-3.5 w-3.5 text-slate-400" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profil Akun') }}
                        </x-dropdown-link>

                        <!-- Authentication Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-rose-400 hover:text-rose-300 hover:bg-rose-500/10">
                                {{ __('Keluar (Log Out)') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Button (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-slate-400 hover:text-white hover:bg-carbon-900 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-carbon-800 bg-carbon-950">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Overview (Main Dashboard)') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('projects.index')" :active="request()->routeIs('projects.*')">
                {{ __('Featured Projects (Active)') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('tech-stack.index')" :active="request()->routeIs('tech-stack.*')">
                {{ __('Tech Stack (Active)') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('work-experience.index')" :active="request()->routeIs('work-experience.*')">
                {{ __('Work Experience (Active)') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('journey.index')" :active="request()->routeIs('journey.*')">
                {{ __('Journey & Kredensial (Active)') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('learning-log.index')" :active="request()->routeIs('learning-log.*')">
                {{ __('Notes & Learning Log (Active)') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-3 border-t border-carbon-800 px-4">
            <div class="flex items-center gap-2 mb-2">
                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                <div class="font-mono text-xs font-medium text-white">{{ Auth::user()->name }}</div>
                <div class="font-mono text-[11px] text-slate-500">({{ Auth::user()->email }})</div>
            </div>

            <div class="space-y-1 mt-3">
                <a href="{{ url('/') }}" target="_blank" class="block py-2 text-xs font-mono text-slate-300 hover:text-white">
                    {{ __('Lihat Website Publik ↗') }}
                </a>
                <a href="{{ route('profile.edit') }}" class="block py-2 text-xs font-mono text-slate-300 hover:text-white">
                    {{ __('Pengaturan Profil') }}
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="block py-2 text-xs font-mono text-rose-400 hover:text-rose-300">
                        {{ __('Keluar (Log Out)') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
