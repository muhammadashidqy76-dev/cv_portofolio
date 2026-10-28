@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-3 pt-1 border-b-2 border-vermilion-500 text-xs font-mono font-semibold text-vermilion-400 transition-colors focus:outline-none'
            : 'inline-flex items-center px-3 pt-1 border-b-2 border-transparent text-xs font-mono font-medium text-slate-400 hover:text-white hover:border-carbon-700 transition-colors focus:outline-none';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
