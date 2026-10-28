import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', 'Figtree', ...defaultTheme.fontFamily.sans],
                mono: ['"JetBrains Mono"', 'ui-monospace', 'SFMono-Regular', 'Menlo', 'Monaco', 'Consolas', 'monospace'],
            },
            colors: {
                carbon: {
                    800: '#1e2638',
                    850: '#141a27',
                    900: '#0e131d',
                    950: '#090c12',
                },
                vermilion: {
                    400: '#ff4d6d',
                    500: '#ff334b',
                    600: '#e11d48',
                }
            },
        },
    },

    plugins: [forms],
};
