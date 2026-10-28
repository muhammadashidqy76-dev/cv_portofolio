<x-layout title="500 Server Error">
    <!-- Error Status Code Pill / Block -->
    <div class="inline-flex items-center justify-center font-mono text-5xl sm:text-6xl font-black tracking-tight text-white mb-3">
        <span class="text-rose-500">5</span>0<span class="text-rose-500">0</span>
    </div>

    <h1 class="text-xl sm:text-2xl font-extrabold text-white tracking-tight mb-2">
        Internal Server Error
    </h1>
    <p class="text-xs sm:text-sm text-slate-400 leading-relaxed max-w-sm mb-6">
        An unexpected condition occurred on the server pipeline. The incident has been recorded for diagnostics.
    </p>

    <!-- Terminal-style Telemetry Inspection Block -->
    <div class="w-full rounded-lg bg-carbon-950 border border-carbon-800 p-3.5 sm:p-4 font-mono text-xs text-left mb-6 space-y-1.5 overflow-x-auto select-all">
        <div class="flex items-center gap-2 text-slate-400">
            <span class="text-rose-500 font-bold select-none">$</span>
            <span>tail -f storage/logs/laravel.log</span>
        </div>
        <div class="flex items-center gap-2 text-slate-300">
            <span class="text-rose-400 bg-rose-500/10 border border-rose-500/20 px-1.5 py-0.2 rounded text-[10px] font-bold">CRITICAL</span>
            <span>[{{ now()->format('Y-m-d H:i:s') }}] production.ERROR</span>
        </div>
        <div class="text-slate-500 text-[11px] pl-6">
            Unhandled Exception caught in ExceptionHandler pipeline.
        </div>
    </div>

    <!-- Back to Home CTA -->
    <a href="{{ url('/') }}" class="inline-flex items-center gap-2.5 px-6 py-2.5 rounded-lg bg-vermilion-500 hover:bg-vermilion-600 text-white font-mono text-xs font-semibold transition-all duration-200 shadow-lg shadow-vermilion-500/20 hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-vermilion-500/40">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        <span>Return to Application</span>
    </a>
</x-layout>
