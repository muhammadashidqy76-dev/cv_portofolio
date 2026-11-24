<!-- Modern Web Guidance: W3C HTTPS Upgrade & FOUC Prevention -->
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<meta name="color-scheme" content="light dark">
<style>
    [x-cloak] { display: none !important; }
</style>
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
