@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2.5 border-s-2 border-vermilion-500 text-start text-xs font-mono font-semibold text-vermilion-400 bg-vermilion-500/10 focus:outline-none transition-colors'
            : 'block w-full ps-3 pe-4 py-2.5 border-s-2 border-transparent text-start text-xs font-mono font-medium text-slate-400 hover:text-white hover:bg-carbon-900 hover:border-carbon-700 focus:outline-none transition-colors';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
