@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-mono text-xs text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-3.5 py-2.5 rounded-lg mb-4 flex items-center gap-2']) }}>
        <span class="w-2 h-2 rounded-full bg-emerald-400 shrink-0 animate-pulse"></span>
        <span>{{ $status }}</span>
    </div>
@endif
