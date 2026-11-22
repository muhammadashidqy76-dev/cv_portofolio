<!-- Modern Web Guidance & W3C Color Scheme Meta & FOUC Prevention -->
<meta name="color-scheme" content="light dark">
<script>
    (function() {
        try {
            const stored = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (stored === 'light' || (!stored && !prefersDark)) {
                document.documentElement.classList.remove('dark');
                document.documentElement.classList.add('light');
            } else {
                document.documentElement.classList.add('dark');
                document.documentElement.classList.remove('light');
            }
        } catch (_) {}
    })();
</script>
