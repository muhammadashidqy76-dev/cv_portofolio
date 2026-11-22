import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.data('themeSwitcher', () => ({
        isDark: document.documentElement.classList.contains('dark'),
        init() {
            this.updateState();
            window.addEventListener('storage', (e) => {
                if (e.key === 'theme') {
                    this.applyTheme(e.newValue);
                }
            });
            window.addEventListener('theme-toggle-event', (e) => {
                this.isDark = (e.detail.theme === 'dark');
            });
            try {
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                    if (!localStorage.getItem('theme')) {
                        this.applyTheme(e.matches ? 'dark' : 'light');
                    }
                });
            } catch (_) {}
        },
        updateState() {
            this.isDark = document.documentElement.classList.contains('dark');
        },
        toggle() {
            const newTheme = this.isDark ? 'light' : 'dark';
            this.applyTheme(newTheme);
            localStorage.setItem('theme', newTheme);
            window.dispatchEvent(new CustomEvent('theme-toggle-event', { detail: { theme: newTheme } }));
        },
        applyTheme(theme) {
            if (theme === 'light') {
                document.documentElement.classList.remove('dark');
                document.documentElement.classList.add('light');
                this.isDark = false;
            } else {
                document.documentElement.classList.add('dark');
                document.documentElement.classList.remove('light');
                this.isDark = true;
            }
        }
    }));
});

Alpine.start();
