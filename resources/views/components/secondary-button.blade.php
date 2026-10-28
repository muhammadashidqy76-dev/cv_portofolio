<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 py-2.5 bg-carbon-800 hover:bg-carbon-700 active:bg-carbon-700 border border-carbon-700 text-slate-200 rounded-lg font-mono font-medium text-xs uppercase tracking-wider transition-all duration-150 focus:outline-none cursor-pointer']) }}>
    {{ $slot }}
</button>
