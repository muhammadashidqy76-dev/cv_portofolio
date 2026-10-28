@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-carbon-950 border border-carbon-800 text-slate-100 placeholder-slate-500 text-sm rounded-lg focus:border-vermilion-500 focus:ring-1 focus:ring-vermilion-500/30 transition-colors shadow-sm block w-full']) !!}>
