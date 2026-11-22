@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 pt-1 border-b-2 border-vermilion-500 text-xs font-mono font-semibold text-vermilion-600 dark:text-vermilion-400 transition-colors focus:outline-none'
            : 'inline-flex items-center px-3 pt-1 border-b-2 border-transparent text-xs font-mono font-medium text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:border-slate-300 dark:hover:border-carbon-700 transition-colors focus:outline-none';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
