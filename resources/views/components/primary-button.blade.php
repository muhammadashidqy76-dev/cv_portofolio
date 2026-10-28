<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2.5 bg-vermilion-500 hover:bg-vermilion-600 active:bg-vermilion-700 border border-transparent rounded-lg font-mono font-medium text-xs text-white uppercase tracking-wider transition-all duration-150 shadow-lg shadow-vermilion-500/20 hover:shadow-vermilion-500/30 focus:outline-none focus:ring-2 focus:ring-vermilion-500/50 disabled:opacity-50 cursor-pointer']) }}>
    {{ $slot }}
</button>
