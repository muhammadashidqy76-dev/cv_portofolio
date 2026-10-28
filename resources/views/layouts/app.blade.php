<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} &mdash; CMS Console</title>

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
    <body class="bg-carbon-950 text-slate-100 antialiased selection:bg-rose-500 selection:text-white relative min-h-screen flex flex-col">
        
        <!-- Global Engineering Matrix Grid Background -->
        <div class="fixed inset-0 bg-[linear-gradient(to_right,#1f293d18_1px,transparent_1px),linear-gradient(to_bottom,#1f293d18_1px,transparent_1px)] bg-[size:3.5rem_3.5rem] pointer-events-none z-0"></div>

        <div class="relative z-10 flex-1 flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-carbon-900/50 border-b border-carbon-800/80 backdrop-blur-sm">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-1">
                {{ $slot }}
            </main>

            <!-- Admin Footer -->
            <footer class="border-t border-carbon-800/80 bg-carbon-950/80 py-4 mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs font-mono text-slate-500">
                    <div class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                        <span>Azure Portfolio CMS &bull; Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</span>
                    </div>
                    <div>
                        <span>&copy; {{ date('Y') }} Ashidqy &bull; Single-Operator Mode</span>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
