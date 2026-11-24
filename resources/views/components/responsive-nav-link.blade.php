@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center gap-2.5 w-full ps-3.5 pe-4 py-2.5 rounded-lg border-s-4 border-rose-600 dark:border-rose-500 text-start text-xs font-mono font-bold text-rose-800 dark:text-rose-300 bg-rose-100/70 dark:bg-rose-500/15 focus:outline-none transition-colors shadow-sm dark:shadow-none'
            : 'flex items-center gap-2.5 w-full ps-3.5 pe-4 py-2.5 rounded-lg border-s-4 border-transparent text-start text-xs font-mono font-medium text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-carbon-900 hover:border-slate-300 dark:hover:border-carbon-700 focus:outline-none transition-colors';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
