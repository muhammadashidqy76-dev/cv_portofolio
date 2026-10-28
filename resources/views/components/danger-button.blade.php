<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2.5 bg-rose-600 hover:bg-rose-700 active:bg-rose-800 border border-transparent rounded-lg font-mono font-medium text-xs text-white uppercase tracking-wider transition-all duration-150 shadow-lg shadow-rose-600/20 hover:shadow-rose-600/30 focus:outline-none focus:ring-2 focus:ring-rose-500/50 cursor-pointer']) }}>
    {{ $slot }}
</button>
