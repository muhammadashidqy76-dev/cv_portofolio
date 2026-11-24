@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-mono font-bold text-rose-700 dark:text-rose-300 bg-rose-100/80 dark:bg-rose-500/15 border border-rose-300 dark:border-rose-500/30 transition-colors focus:outline-none shadow-sm dark:shadow-none'
            : 'inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-mono font-medium text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-carbon-900 transition-colors focus:outline-none';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
