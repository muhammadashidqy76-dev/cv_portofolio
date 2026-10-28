<x-layout title="419 Page Expired">
    <!-- Error Status Code Pill / Block -->
    <div class="inline-flex items-center justify-center font-mono text-5xl sm:text-6xl font-black tracking-tight text-white mb-3">
        <span class="text-amber-400">4</span>1<span class="text-amber-400">9</span>
    </div>

    <h1 class="text-xl sm:text-2xl font-extrabold text-white tracking-tight mb-2">
        Session Expired
    </h1>
    <p class="text-xs sm:text-sm text-slate-400 leading-relaxed max-w-sm mb-6">
        Your CSRF token or session has timed out due to inactivity. Please refresh the page to renew your security token.
    </p>

    <!-- Terminal-style Telemetry Inspection Block -->
    <div class="w-full rounded-lg bg-carbon-950 border border-carbon-800 p-3.5 sm:p-4 font-mono text-xs text-left mb-6 space-y-1.5 overflow-x-auto select-all">
        <div class="flex items-center gap-2 text-slate-400">
            <span class="text-amber-500 font-bold select-none">$</span>
            <span>php artisan session:status</span>
        </div>
        <div class="flex items-center gap-2 text-slate-300">
            <span class="text-amber-400 bg-amber-500/10 border border-amber-500/20 px-1.5 py-0.2 rounded text-[10px] font-bold">WARNING</span>
            <span>CSRF token mismatch on <span class="text-amber-400">VerifyCsrfToken</span> middleware</span>
        </div>
        <div class="text-slate-500 text-[11px] pl-6">
            Session lifetime exceeded config threshold. Request aborted.
        </div>
    </div>

    <!-- Actions Group -->
    <div class="flex items-center gap-3 flex-wrap justify-center font-mono">
        <button onclick="window.location.reload()" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-vermilion-500 hover:bg-vermilion-600 text-white text-xs font-semibold transition-all duration-200 shadow-lg shadow-vermilion-500/20 hover:-translate-y-0.5 cursor-pointer">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            <span>Refresh Page</span>
        </button>
        <a href="{{ url('/') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-carbon-950 hover:bg-carbon-850 border border-carbon-800 hover:border-slate-700 text-slate-300 hover:text-white text-xs font-semibold transition-all duration-200">
            <span>Return Home</span>
        </a>
    </div>
</x-layout>
