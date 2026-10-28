<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} — CMS Auth</title>

        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-web.svg') }}">

        <!-- Fonts via Bunny CDN -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800|jetbrains-mono:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            html, body {
                font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
                background-color: #090c12;
                color: #f1f5f9;
            }
            .font-mono { font-family: 'JetBrains Mono', monospace; }
        </style>
    </head>
    <body class="bg-carbon-950 text-slate-100 flex flex-col justify-center items-center min-h-screen p-4 sm:p-6 antialiased selection:bg-rose-500 selection:text-white relative overflow-hidden">
        
        <!-- Global Engineering Matrix Grid Background -->
        <div class="fixed inset-0 bg-[linear-gradient(to_right,#1f293d18_1px,transparent_1px),linear-gradient(to_bottom,#1f293d18_1px,transparent_1px)] bg-[size:3.5rem_3.5rem] pointer-events-none z-0"></div>

        <!-- Architectural Subtle Accent Glow Line -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-3/4 h-px bg-gradient-to-r from-transparent via-vermilion-500/25 to-transparent pointer-events-none"></div>

        <div class="relative z-10 w-full max-w-md">
            <!-- Brand & Console Header -->
            <div class="flex items-center justify-between mb-4 px-1">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 group">
                    <div class="flex items-center font-mono text-base font-bold text-white tracking-tight">
                        <span class="text-vermilion-400 group-hover:-translate-x-0.5 transition-transform">&lt;</span>
                        <span class="px-0.5 text-slate-100 group-hover:text-white transition-colors">Ashidqy</span>
                        <span class="text-vermilion-400 group-hover:translate-x-0.5 transition-transform">/&gt;</span>
                    </div>
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-mono font-medium bg-vermilion-500/10 border border-vermilion-500/20 text-vermilion-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-vermilion-400 animate-pulse"></span>
                        admin
                    </span>
                </a>

                <a href="{{ url('/') }}" class="text-xs font-mono text-slate-400 hover:text-white transition-colors flex items-center gap-1">
                    <span>Website Utama</span>
                </a>
            </div>

            <!-- Terminal Window Card -->
            <div class="rounded-xl bg-carbon-900 border border-carbon-800 shadow-2xl shadow-black/60 overflow-hidden backdrop-blur-md">
                <!-- Window Titlebar -->
                <div class="flex items-center justify-between px-4 py-3 bg-carbon-950 border-b border-carbon-800 select-none">
                    <div class="flex items-center gap-2">
                        <div class="flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-rose-500/80"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-400/80"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400/80"></span>
                        </div>
                        <span class="font-mono text-[11px] text-slate-400 ml-1">auth/session.guard</span>
                    </div>
                    <div class="flex items-center gap-1.5 font-mono text-[10px] text-slate-500">
                        <span>PORTFOLIO_CMS</span>
                    </div>
                </div>

                <!-- Window Content -->
                <div class="p-6 sm:p-8">
                    {{ $slot }}
                </div>
            </div>

            <!-- Footer / Copyright note -->
            <div class="text-center mt-6">
                <p class="text-xs font-mono text-slate-500">
                    &copy; {{ date('Y') }} Ashidqy &mdash; Portfolio &amp; CMS Engine
                </p>
            </div>
        </div>
    </body>
</html>
