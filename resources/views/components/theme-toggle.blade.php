<div x-data="themeSwitcher()" class="inline-flex items-center">
    <button type="button"
            @click="toggle()"
            :aria-label="isDark ? 'Ganti ke Mode Terang (Light Mode)' : 'Ganti ke Mode Gelap (Dark Mode)'"
            :title="isDark ? 'Ganti ke Mode Terang (Light Mode)' : 'Ganti ke Mode Gelap (Dark Mode)'"
            class="relative inline-flex items-center justify-center p-2 rounded-lg bg-carbon-900 hover:bg-carbon-850 border border-carbon-800 hover:border-slate-700 text-slate-400 hover:text-white transition-all shadow-sm focus:outline-none focus:ring-2 focus:ring-vermilion-500/40 cursor-pointer group">
        
        <!-- Sun icon (shown when dark, clicking it switches to light) -->
        <svg x-show="isDark" x-cloak class="w-4 h-4 text-amber-400 group-hover:rotate-45 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>

        <!-- Moon icon (shown when light, clicking it switches to dark) -->
        <svg x-show="!isDark" x-cloak class="w-4 h-4 text-indigo-500 group-hover:-rotate-12 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
        </svg>
    </button>
</div>
