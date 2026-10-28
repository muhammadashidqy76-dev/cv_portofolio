<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'System Error' }} — Ashidqy</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-web.svg') }}">

    <!-- Google Fonts via Bunny CDN -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800|jetbrains-mono:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html, body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            background-color: #090c12;
            color: #f1f5f9;
            min-height: 100vh;
        }
        .font-mono { font-family: 'JetBrains Mono', monospace, monospace; }
    </style>
</head>
<body class="bg-carbon-950 text-slate-100 flex items-center justify-center min-h-screen p-4 sm:p-6 antialiased selection:bg-rose-500 selection:text-white relative overflow-hidden">
    
    <!-- Global Seamless Engineering Matrix Grid Background -->
    <div class="fixed inset-0 bg-[linear-gradient(to_right,#1f293d18_1px,transparent_1px),linear-gradient(to_bottom,#1f293d18_1px,transparent_1px)] bg-[size:3.5rem_3.5rem] pointer-events-none z-0"></div>

    <!-- Architectural Subtle Accent Line -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-3/4 h-px bg-gradient-to-r from-transparent via-vermilion-500/20 to-transparent pointer-events-none"></div>

    <main class="relative z-10 w-full max-w-xl">
        <!-- Error Card Window Mockup -->
        <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-2xl overflow-hidden backdrop-blur-sm">
            
            <!-- Window Bar -->
            <div class="flex items-center justify-between px-4 py-3 bg-carbon-950 border-b border-carbon-800 select-none">
                <div class="flex items-center gap-2">
                    <div class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-rose-500/80"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-400/80"></span>
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-400/80"></span>
                    </div>
                    <span class="font-mono text-[11px] text-slate-400 ml-1">app/Exceptions/Handler.php</span>
                </div>
                <div class="flex items-center gap-2 font-mono text-[10px] text-vermilion-400 bg-vermilion-500/10 border border-vermilion-500/20 px-2 py-0.5 rounded">
                    <span class="w-1.5 h-1.5 rounded-full bg-vermilion-500 animate-pulse"></span>
                    <span>EXCEPTION_THROWN</span>
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-6 sm:p-8 flex flex-col items-center text-center">
                {{ $slot }}

                <!-- Brand Signature Bar -->
                <div class="w-full mt-8 pt-5 border-t border-carbon-800 flex items-center justify-between text-xs font-mono text-slate-500">
                    <div class="flex items-center gap-2">
                        <div class="w-1.5 h-1.5 rounded-full bg-vermilion-500"></div>
                        <span>ashidqy.dev</span>
                    </div>
                    <span class="text-[11px] text-slate-600">HTTP Kernel Telemetry</span>
                </div>
            </div>

        </div>
    </main>

</body>
</html>
