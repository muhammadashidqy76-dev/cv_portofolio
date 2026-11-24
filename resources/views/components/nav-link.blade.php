@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-2.5 py-1.5 rounded-md text-xs font-mono font-bold text-vermilion-700 dark:text-vermilion-300 bg-vermilion-50 dark:bg-vermilion-500/15 border border-vermilion-200 dark:border-vermilion-500/30 transition-colors focus:outline-none shadow-sm dark:shadow-none'
            : 'inline-flex items-center px-2.5 py-1.5 rounded-md text-xs font-mono font-medium text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-carbon-900 hover:border-slate-200 dark:hover:border-carbon-800 transition-colors focus:outline-none';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
