<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $currentRole->name }} — Network & IT Systems Roadmap | Ashidqy</title>
    <meta name="description" content="Peta alur kurikulum pembelajaran terapan dan penguasaan peran {{ $currentRole->name }} oleh Moch Hasbi Ashidqy.">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo-web.svg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800|jetbrains-mono:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0a0a0c] text-slate-100 font-sans antialiased selection:bg-rose-500 selection:text-white relative min-h-screen flex flex-col justify-between"
      x-data="roadmapApp({
          initialStats: {{ Js::from($stats) }},
          initialCheckpoints: {{ Js::from($checkpoints) }}
      })"
      @keydown.escape.window="closeDrawer()">

    <!-- Technical Dot-Grid Matrix & Ambient Glow Background -->
    <div class="fixed inset-0 bg-[radial-gradient(#ffffff14_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none z-0"></div>
    <div class="fixed top-20 left-1/2 -translate-x-1/2 w-[750px] h-[350px] bg-gradient-to-b from-indigo-500/10 via-emerald-500/5 to-transparent blur-[140px] pointer-events-none rounded-full z-0"></div>

    <div class="relative z-10 flex-1 flex flex-col">

        <!-- ── Navigation Bar ── -->
        <header class="sticky top-0 z-40 backdrop-blur-md bg-[#0a0a0c]/85 border-b border-white/[0.08] transition-all duration-300">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between gap-4">

                <!-- Left: Brand Logo & Back to Home -->
                <div class="flex items-center gap-3">
                    <a href="/" class="flex items-center gap-2.5 group focus:outline-none focus:ring-2 focus:ring-vermilion-500/40 rounded-lg p-1" title="Kembali ke Beranda">
                        <!-- 3 Window Dots Motif -->
                        <div class="flex items-center gap-1 p-1 rounded bg-carbon-900 border border-carbon-800 group-hover:border-carbon-700 transition-colors">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500/90"></span>
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400/90"></span>
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400/90"></span>
                        </div>
                        <span class="font-mono text-sm sm:text-base font-bold text-white tracking-tight">
                            <span class="text-vermilion-400 group-hover:-translate-x-0.5 transition-transform inline-block">&lt;</span>
                            <span class="text-slate-100 group-hover:text-white transition-colors">Ashidqy</span>
                            <span class="text-vermilion-400 group-hover:translate-x-0.5 transition-transform inline-block">/&gt;</span>
                        </span>
                    </a>

                    <span class="h-4 w-px bg-carbon-800 hidden sm:block"></span>

                    <span class="hidden sm:inline-flex items-center gap-1.5 text-xs font-mono text-indigo-400 bg-indigo-500/10 border border-indigo-500/20 px-2 py-0.5 rounded">
                        <span>Roadmap &bull; Network &amp; Systems</span>
                    </span>
                </div>

                <!-- Right: Navigation Links -->
                <div class="flex items-center gap-2 sm:gap-4 font-mono text-xs">
                    <a href="/#projects" class="hidden md:inline-block text-slate-400 hover:text-white transition-colors px-2 py-1">
                        Projek
                    </a>
                    <a href="/#tech-stack" class="hidden md:inline-block text-slate-400 hover:text-white transition-colors px-2 py-1">
                        Teknologi
                    </a>
                    <a href="/notes" class="hidden md:inline-block text-slate-400 hover:text-white transition-colors px-2 py-1">
                        Catatan Teknis
                    </a>
                    <a href="/" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-carbon-900 hover:bg-carbon-850 border border-carbon-800 text-vermilion-400 hover:text-vermilion-300 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Beranda</span>
                    </a>
                </div>
            </div>
        </header>

        <!-- ── Main Content Container ── -->
        <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14 space-y-10 flex-1 w-full">

            <!-- ── Top Header & Stats Bar ── -->
            <div class="space-y-6">
                <nav class="flex items-center gap-2 font-mono text-xs text-slate-400">
                    <a href="/" class="hover:text-white transition-colors">Beranda</a>
                    <span class="text-slate-600">/</span>
                    <span class="text-slate-300">Learning Path Tracker</span>
                    <span class="text-slate-600">/</span>
                    <span class="text-indigo-400 font-semibold">{{ $currentRole->name }}</span>
                </nav>

                <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 border-b border-carbon-800/80 pb-8">
                    <div class="max-w-2xl space-y-3">
                        <div class="inline-flex items-center gap-2 font-mono text-[11px] font-semibold uppercase tracking-widest text-indigo-400">
                            <span class="w-3.5 h-px bg-indigo-500 rounded"></span>
                            <span>NETWORK ENGINEER &amp; IT SUPPORT TRACK // ROADMAP.SH SPEC</span>
                        </div>
                        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white tracking-tight">
                            {{ $currentRole->name }}
                        </h1>
                        <p class="text-slate-400 text-sm sm:text-base leading-relaxed">
                            {{ $currentRole->tagline }}
                        </p>
                    </div>

                    <!-- Live Progress & Interactive Summary -->
                    <div class="p-4 rounded-xl bg-carbon-900 border border-carbon-800/80 space-y-3 self-start lg:self-end shrink-0 w-full lg:w-80 shadow-lg">
                        <div class="flex items-center justify-between font-mono text-xs">
                            <span class="text-slate-400">Tingkat Penguasaan</span>
                            <span class="font-bold text-emerald-400">{{ $stats['percentage'] }}% Selesai (Clear)</span>
                        </div>
                        <!-- Progress Bar -->
                        <div class="w-full h-2 rounded-full bg-carbon-950 border border-carbon-800 overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-indigo-500 to-emerald-400 transition-all duration-500 rounded-full"
                                 style="width: {{ $stats['percentage'] }}%"></div>
                        </div>
                        <div class="flex items-center justify-between font-mono text-[11px] text-slate-400 pt-1 border-t border-carbon-800/60">
                            <span class="flex items-center gap-1.5 text-emerald-400">
                                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                <span>{{ $stats['finished'] }} Clear</span>
                            </span>
                            <span class="flex items-center gap-1.5 text-amber-400">
                                <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                                <span>{{ $stats['in_progress'] }} In Progress</span>
                            </span>
                            <span class="flex items-center gap-1.5 text-slate-400">
                                <span class="w-2 h-2 rounded-full bg-slate-600"></span>
                                <span>{{ $stats['not_started'] }} Planned</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- ── Filter & Search Toolbar (Roadmap.sh Style) ── -->
                <div class="p-3.5 rounded-xl bg-carbon-900 border border-carbon-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4 font-mono text-xs">
                    <!-- Status Filter Pills -->
                    <div class="flex flex-wrap items-center gap-1.5">
                        <button type="button"
                                @click="selectedStatus = 'all'"
                                :class="selectedStatus === 'all' ? 'bg-white/10 text-white font-bold border-white/20' : 'text-slate-400 hover:text-white border-transparent'"
                                class="px-3 py-1.5 rounded-lg border transition-colors cursor-pointer">
                            Semua ({{ $stats['total'] }})
                        </button>
                        <button type="button"
                                @click="selectedStatus = 'finished'"
                                :class="selectedStatus === 'finished' ? 'bg-emerald-500/20 text-emerald-300 font-bold border-emerald-500/40' : 'text-slate-400 hover:text-white border-transparent'"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border transition-colors cursor-pointer">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                            <span>Finished / Clear ({{ $stats['finished'] }})</span>
                        </button>
                        <button type="button"
                                @click="selectedStatus = 'in_progress'"
                                :class="selectedStatus === 'in_progress' ? 'bg-amber-500/20 text-amber-300 font-bold border-amber-500/40' : 'text-slate-400 hover:text-white border-transparent'"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border transition-colors cursor-pointer">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                            <span>In Progress ({{ $stats['in_progress'] }})</span>
                        </button>
                        <button type="button"
                                @click="selectedStatus = 'not_started'"
                                :class="selectedStatus === 'not_started' ? 'bg-slate-700/30 text-slate-300 font-bold border-slate-600' : 'text-slate-400 hover:text-white border-transparent'"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border transition-colors cursor-pointer">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span>
                            <span>Planned ({{ $stats['not_started'] }})</span>
                        </button>
                    </div>

                    <!-- Search Input -->
                    <div class="relative w-full sm:w-56">
                        <input type="text"
                               x-model="search"
                               placeholder="Cari materi..."
                               class="w-full bg-carbon-950 border border-carbon-800 text-slate-100 text-xs rounded-lg pl-8 pr-3 py-1.5 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500/30 font-mono transition-colors">
                        <svg class="w-3.5 h-3.5 text-slate-500 absolute left-2.5 top-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Info Hint -->
                <div class="flex items-center justify-between text-[11px] font-mono text-slate-500 px-1">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Klik topik untuk membuka panel referensi materi, artikel catatan teknis, atau panduan blog terkurasi.</span>
                    </span>
                    <span class="hidden sm:inline-block">Format Network Engineer Roadmap</span>
                </div>
            </div>

            <!-- ── 00 // HANDS-ON LAB SIMULATION CARD (CLEAN & MAINTAINABLE) ── -->
            <div class="rounded-2xl bg-carbon-900 border border-carbon-800 p-5 sm:p-6 shadow-xl relative overflow-hidden font-mono"
                 x-data="{ labModalOpen: false }">
                <!-- Subtle Ambient Glow -->
                <div class="absolute -right-12 -top-12 w-48 h-48 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="flex flex-col md:flex-row md:items-center justify-between gap-5 relative z-10">
                    
                    <!-- Left: Lab Info & Summary -->
                    <div class="space-y-3 max-w-2xl">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-[11px] font-bold uppercase tracking-wider">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span>Hands-on Lab Simulation</span>
                            </span>
                            <span class="text-xs text-slate-500">&bull;</span>
                            <span class="text-xs text-slate-400">Cisco Packet Tracer</span>
                            <span class="inline-flex items-center gap-1 text-[11px] text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2 py-0.5 rounded">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                <span>Verified 0% Loss</span>
                            </span>
                        </div>

                        <div>
                            <h3 class="text-base sm:text-lg font-bold text-white tracking-tight leading-snug">
                                Lab 01: Peer-to-Peer &amp; Local Switch Connectivity
                            </h3>
                            <p class="mt-1.5 text-xs sm:text-sm text-slate-300 font-sans leading-relaxed">
                                Simulasi pengujian pertukaran file data antar dua workstation kantor melalui Cisco Catalyst 2960 Switch Layer 2 dalam satu subnet lokal (192.168.1.0/24) dengan verifikasi pengujian ICMP Ping tanpa packet loss.
                            </p>
                        </div>

                        <!-- Tags / Meta -->
                        <div class="flex flex-wrap items-center gap-2 text-[11px] text-slate-400 pt-0.5">
                            <span class="px-2 py-0.5 rounded bg-carbon-950 border border-carbon-800 text-slate-300">
                                Topologi: 2 End-Devices + Catalyst 2960
                            </span>
                            <span class="px-2 py-0.5 rounded bg-carbon-950 border border-carbon-800 text-slate-300">
                                Subnet: 192.168.1.0/24
                            </span>
                            <span class="px-2 py-0.5 rounded bg-carbon-950 border border-carbon-800 text-emerald-400">
                                Ping: &lt;1ms
                            </span>
                        </div>
                    </div>

                    <!-- Right: Action Buttons -->
                    <div class="flex flex-col sm:flex-row md:flex-col gap-2.5 shrink-0 sm:w-auto md:w-52">
                        <!-- Baca Summary Button (Triggers Modal) -->
                        <button type="button"
                                @click="labModalOpen = true"
                                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-carbon-950 hover:bg-carbon-850 border border-carbon-700 hover:border-indigo-500/50 text-white font-semibold text-xs transition-all shadow-sm cursor-pointer group">
                            <svg class="w-4 h-4 text-indigo-400 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <span>Baca Summary Lab</span>
                        </button>

                        <!-- Dokumentasi Lengkap Button -->
                        <a href="{{ route('notes.index') }}"
                           class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-xs transition-all shadow-md shadow-indigo-600/20 group">
                            <span>Dokumentasi Teknis</span>
                            <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                </div>

                <!-- ─── SUMMARY MODAL DIALOG (ALPINE.JS) ─── -->
                <div x-show="labModalOpen" x-cloak
                     class="fixed inset-0 z-50 overflow-y-auto" role="dialog" aria-modal="true">
                    <!-- Backdrop -->
                    <div x-show="labModalOpen"
                         x-transition:enter="ease-out duration-200"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="ease-in duration-150"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         @click="labModalOpen = false"
                         class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity"></div>

                    <!-- Dialog Box -->
                    <div class="min-h-screen px-4 text-center flex items-center justify-center py-8">
                        <div x-show="labModalOpen"
                             x-transition:enter="ease-out duration-300"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="ease-in duration-200"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             @click.stop
                             class="inline-block w-full max-w-xl text-left align-middle transition-all transform bg-carbon-900 border border-carbon-800 rounded-2xl shadow-2xl overflow-hidden font-mono">
                            
                            <!-- Modal Header -->
                            <div class="flex items-center justify-between px-6 py-4 bg-carbon-950 border-b border-carbon-800">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-rose-500/80"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-amber-400/80"></span>
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400/80"></span>
                                    <span class="ml-2 text-xs font-bold text-white">Summary Lab Skenario</span>
                                </div>
                                <button type="button" @click="labModalOpen = false" class="text-slate-400 hover:text-white p-1 rounded-lg hover:bg-carbon-800 transition-colors">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>

                            <!-- Modal Body -->
                            <div class="p-6 space-y-5 text-xs text-slate-300 font-sans">
                                <div>
                                    <div class="flex items-center gap-2 mb-1.5 font-mono text-[10px] text-indigo-400 font-bold uppercase tracking-wider">
                                        <span>LAB 01 &bull; CISCO PACKET TRACER</span>
                                    </div>
                                    <h4 class="text-base font-bold text-white font-mono">
                                        Local LAN Connectivity &amp; Switch Peer-to-Peer Transfer
                                    </h4>
                                </div>

                                <!-- Skenario & Objektif -->
                                <div class="space-y-1.5">
                                    <strong class="text-white font-mono text-xs block">1. Skenario &amp; Objektif:</strong>
                                    <p class="text-slate-300 text-xs leading-relaxed">
                                        Menghubungkan dua unit laptop workstation pada satu lantai kantor menggunakan Switch Cisco Catalyst 2960 untuk memungkinkan pertukaran file lokal secara langsung tanpa perlu melewati router gateway.
                                    </p>
                                </div>

                                <!-- Parameter Konfigurasi -->
                                <div class="space-y-1.5">
                                    <strong class="text-white font-mono text-xs block">2. Parameter Konfigurasi:</strong>
                                    <div class="p-3 rounded-xl bg-carbon-950 border border-carbon-800 font-mono text-[11px] space-y-1 text-slate-300">
                                        <p>&bull; <strong>Laptop-01:</strong> IP 192.168.1.10 / Netmask 255.255.255.0 (/24)</p>
                                        <p>&bull; <strong>Laptop-02:</strong> IP 192.168.1.20 / Netmask 255.255.255.0 (/24)</p>
                                        <p>&bull; <strong>Perangkat Penghubung:</strong> Switch Cisco Catalyst 2960 (Port Fa0/1 &amp; Fa0/2)</p>
                                        <p>&bull; <strong>Media Transmisi:</strong> UTP Cat5e/Cat6 Straight-Through (TIA/EIA-568B)</p>
                                    </div>
                                </div>

                                <!-- Hasil Pengujian -->
                                <div class="space-y-1.5">
                                    <strong class="text-white font-mono text-xs block">3. Hasil Uji Verifikasi:</strong>
                                    <p class="text-slate-300 text-xs leading-relaxed">
                                        &bull; <strong>Tes Ping ICMP:</strong> 4 packets transmitted, 4 received, <strong>0% packet loss</strong>, latensi rata-rata &lt;1ms.<br>
                                        &bull; <strong>Switch MAC Table:</strong> Switch sukses mencatat MAC address pengirim secara dinamis pada port masing-masing (Dynamic MAC Learning) dan meneruskan frame secara unicast.
                                    </p>
                                </div>

                                <!-- Analisis Teknis Singkat -->
                                <div class="p-3 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-slate-300 text-[11px] leading-relaxed">
                                    <strong class="text-indigo-400 font-mono block mb-1">Analisis Inti:</strong>
                                    Komunikasi berhasil langsung di Layer 2 (Data Link) tanpa routing karena kedua host berada pada Network ID yang sama (<code class="text-indigo-300 font-mono">192.168.1.0/24</code>), sehingga switch hanya bertindak sebagai jembatan frame berbasis MAC address.
                                </div>
                            </div>

                            <!-- Modal Footer -->
                            <div class="px-6 py-4 bg-carbon-950 border-t border-carbon-800 flex items-center justify-between gap-3 font-mono">
                                <button type="button" @click="labModalOpen = false" class="px-4 py-2 rounded-lg bg-carbon-900 border border-carbon-800 text-slate-300 hover:text-white text-xs transition-colors cursor-pointer">
                                    Tutup
                                </button>
                                <a href="{{ route('notes.index') }}" class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-semibold transition-colors inline-flex items-center gap-1.5">
                                    <span>Buka Catatan Teknis</span>
                                    &rarr;
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- ── ROADMAP.SH TREE FLOW CANVAS ── -->
            <div class="relative pt-4 pb-12 space-y-16">

                <!-- Central Spine Line (Garis Alur Vertikal Tengah Presisi) -->
                <div class="absolute left-6 md:left-1/2 top-8 bottom-4 w-0.5 -translate-x-1/2 bg-gradient-to-b from-indigo-500/60 via-carbon-700 to-indigo-500/30 pointer-events-none z-0"></div>

                @php $phaseIndex = 0; @endphp
                @foreach ($phases as $phaseName => $items)
                    @php $phaseIndex++; @endphp
                    <div class="relative z-10 space-y-8">

                        <!-- Milestone Phase Box (Node Utama di Tengah Alur) -->
                        <div class="flex items-center justify-start md:justify-center pl-12 md:pl-0">
                            <div class="relative group">
                                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500/20 to-purple-500/20 rounded-xl blur-sm opacity-70 group-hover:opacity-100 transition duration-300"></div>
                                
                                <div class="relative px-5 py-2.5 rounded-xl bg-carbon-900 border border-indigo-500/50 shadow-xl flex items-center gap-3 font-mono">
                                    <span class="flex h-2.5 w-2.5 relative">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-indigo-500"></span>
                                    </span>
                                    <h2 class="text-xs sm:text-sm font-bold text-white tracking-tight uppercase">
                                        {{ $phaseName }}
                                    </h2>
                                    <span class="text-[10px] text-indigo-300 bg-indigo-500/20 px-2 py-0.5 rounded border border-indigo-500/30">
                                        {{ count($items) }} Topik
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Checkpoints Rhythm Tree (Seirama, Presisi, Simetris) -->
                        <div class="space-y-4 md:space-y-6">
                            @foreach ($items as $idx => $item)
                                @php
                                    $isLeft = ($idx % 2 === 0);
                                @endphp

                                <div x-show="matchesFilter('{{ $item->id }}')"
                                     x-transition:enter="transition ease-out duration-150"
                                     x-transition:enter-start="opacity-0 scale-98"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     class="relative flex items-center w-full">

                                    <!-- ── DESKTOP ALTERNATING ROW (SEIRAMA & SIMETRIS) ── -->
                                    <div class="hidden md:flex items-center w-full justify-between">
                                        
                                        <!-- LEFT COLUMN -->
                                        <div class="w-1/2 flex items-center justify-end">
                                            @if ($isLeft)
                                                <button type="button"
                                                        @click="openDrawer({{ $item->id }})"
                                                        :class="getNodeClasses('{{ $item->id }}')"
                                                        class="w-full max-w-md p-3.5 rounded-xl border transition-all duration-200 text-left flex items-start justify-between gap-3 group cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500/40 relative shadow-md">
                                                    
                                                    <!-- Left Icon & Topic Title -->
                                                    <div class="flex items-start gap-2.5 min-w-0">
                                                        <div class="mt-0.5 shrink-0">
                                                            @if ($item->status === \App\Models\RoadmapCheckpoint::STATUS_FINISHED)
                                                                <div class="w-5 h-5 rounded-md bg-emerald-500/20 border border-emerald-500/40 flex items-center justify-center text-emerald-400 shadow-sm shadow-emerald-500/20">
                                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                                    </svg>
                                                                </div>
                                                            @elseif ($item->status === \App\Models\RoadmapCheckpoint::STATUS_IN_PROGRESS)
                                                                <div class="w-5 h-5 rounded-md bg-amber-500/20 border border-amber-500/40 flex items-center justify-center text-amber-400">
                                                                    <svg class="w-3.5 h-3.5 animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                                    </svg>
                                                                </div>
                                                            @else
                                                                <div class="w-5 h-5 rounded-md bg-carbon-950 border border-carbon-800 flex items-center justify-center text-slate-500 group-hover:border-slate-600">
                                                                    <div class="w-1.5 h-1.5 rounded-full bg-slate-600"></div>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <div class="space-y-1 min-w-0">
                                                            <div class="text-xs sm:text-sm font-semibold tracking-tight leading-snug group-hover:text-white transition-colors {{ $item->status === 'finished' ? 'text-emerald-200' : ($item->status === 'in_progress' ? 'text-amber-200' : 'text-slate-300') }}">
                                                                {{ $item->title }}
                                                            </div>
                                                            @if ($item->source_reference)
                                                                <div class="text-[10px] font-mono text-slate-500 truncate" title="{{ $item->source_reference }}">
                                                                    {{ $item->source_reference }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <!-- Indicators -->
                                                    <div class="flex items-center gap-1.5 shrink-0 font-mono text-[10px]">
                                                        @if ($item->note)
                                                            <span class="px-1.5 py-0.5 rounded bg-indigo-500/10 border border-indigo-500/30 text-indigo-400" title="Catatan Teknis">Note</span>
                                                        @elseif ($item->external_url)
                                                            <span class="px-1.5 py-0.5 rounded bg-sky-500/10 border border-sky-500/30 text-sky-400" title="Referensi Terkurasi">Blog</span>
                                                        @endif
                                                        @if ($item->project)
                                                            <span class="px-1.5 py-0.5 rounded bg-vermilion-500/10 border border-vermilion-500/30 text-vermilion-400" title="Proyek Riil">Proj</span>
                                                        @endif
                                                        <svg class="w-3.5 h-3.5 text-slate-600 group-hover:text-slate-300 group-hover:translate-x-0.5 transition-all ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                        </svg>
                                                    </div>
                                                </button>

                                                <!-- Horizontal Connector Line (Left side) -->
                                                <div class="w-8 h-px border-t border-dashed border-carbon-600 shrink-0"></div>
                                            @else
                                                <div class="w-full max-w-md"></div>
                                            @endif
                                        </div>

                                        <!-- CENTER NODE DOT (PADA SUMBU TULANG BELAKANG) -->
                                        <div class="shrink-0 flex items-center justify-center w-8 z-10">
                                            @if ($item->status === \App\Models\RoadmapCheckpoint::STATUS_FINISHED)
                                                <span class="w-3.5 h-3.5 rounded-full bg-emerald-400 ring-4 ring-emerald-500/20 border-2 border-carbon-950 shadow-sm shadow-emerald-500/50"></span>
                                            @elseif ($item->status === \App\Models\RoadmapCheckpoint::STATUS_IN_PROGRESS)
                                                <span class="w-3.5 h-3.5 rounded-full bg-amber-400 ring-4 ring-amber-500/20 border-2 border-carbon-950 animate-pulse"></span>
                                            @else
                                                <span class="w-3 h-3 rounded-full bg-slate-600 ring-2 ring-carbon-800 border-2 border-carbon-950"></span>
                                            @endif
                                        </div>

                                        <!-- RIGHT COLUMN -->
                                        <div class="w-1/2 flex items-center justify-start">
                                            @if (!$isLeft)
                                                <!-- Horizontal Connector Line (Right side) -->
                                                <div class="w-8 h-px border-t border-dashed border-carbon-600 shrink-0"></div>

                                                <button type="button"
                                                        @click="openDrawer({{ $item->id }})"
                                                        :class="getNodeClasses('{{ $item->id }}')"
                                                        class="w-full max-w-md p-3.5 rounded-xl border transition-all duration-200 text-left flex items-start justify-between gap-3 group cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500/40 relative shadow-md">
                                                    
                                                    <!-- Left Icon & Topic Title -->
                                                    <div class="flex items-start gap-2.5 min-w-0">
                                                        <div class="mt-0.5 shrink-0">
                                                            @if ($item->status === \App\Models\RoadmapCheckpoint::STATUS_FINISHED)
                                                                <div class="w-5 h-5 rounded-md bg-emerald-500/20 border border-emerald-500/40 flex items-center justify-center text-emerald-400 shadow-sm shadow-emerald-500/20">
                                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                                    </svg>
                                                                </div>
                                                            @elseif ($item->status === \App\Models\RoadmapCheckpoint::STATUS_IN_PROGRESS)
                                                                <div class="w-5 h-5 rounded-md bg-amber-500/20 border border-amber-500/40 flex items-center justify-center text-amber-400">
                                                                    <svg class="w-3.5 h-3.5 animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                                    </svg>
                                                                </div>
                                                            @else
                                                                <div class="w-5 h-5 rounded-md bg-carbon-950 border border-carbon-800 flex items-center justify-center text-slate-500 group-hover:border-slate-600">
                                                                    <div class="w-1.5 h-1.5 rounded-full bg-slate-600"></div>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <div class="space-y-1 min-w-0">
                                                            <div class="text-xs sm:text-sm font-semibold tracking-tight leading-snug group-hover:text-white transition-colors {{ $item->status === 'finished' ? 'text-emerald-200' : ($item->status === 'in_progress' ? 'text-amber-200' : 'text-slate-300') }}">
                                                                {{ $item->title }}
                                                            </div>
                                                            @if ($item->source_reference)
                                                                <div class="text-[10px] font-mono text-slate-500 truncate" title="{{ $item->source_reference }}">
                                                                    {{ $item->source_reference }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <!-- Indicators -->
                                                    <div class="flex items-center gap-1.5 shrink-0 font-mono text-[10px]">
                                                        @if ($item->note)
                                                            <span class="px-1.5 py-0.5 rounded bg-indigo-500/10 border border-indigo-500/30 text-indigo-400" title="Catatan Teknis">Note</span>
                                                        @elseif ($item->external_url)
                                                            <span class="px-1.5 py-0.5 rounded bg-sky-500/10 border border-sky-500/30 text-sky-400" title="Referensi Terkurasi">Blog</span>
                                                        @endif
                                                        @if ($item->project)
                                                            <span class="px-1.5 py-0.5 rounded bg-vermilion-500/10 border border-vermilion-500/30 text-vermilion-400" title="Proyek Riil">Proj</span>
                                                        @endif
                                                        <svg class="w-3.5 h-3.5 text-slate-600 group-hover:text-slate-300 group-hover:translate-x-0.5 transition-all ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                        </svg>
                                                    </div>
                                                </button>
                                            @else
                                                <div class="w-full max-w-md"></div>
                                            @endif
                                        </div>

                                    </div>

                                    <!-- ── MOBILE ROW (< md) PRESISE CONNECTOR ── -->
                                    <div class="flex md:hidden items-center w-full pl-6">
                                        <!-- Node dot on left vertical line -->
                                        <div class="absolute left-6 -translate-x-1/2 z-10">
                                            @if ($item->status === \App\Models\RoadmapCheckpoint::STATUS_FINISHED)
                                                <span class="w-3 h-3 block rounded-full bg-emerald-400 ring-2 ring-emerald-500/30 border border-carbon-950"></span>
                                            @elseif ($item->status === \App\Models\RoadmapCheckpoint::STATUS_IN_PROGRESS)
                                                <span class="w-3 h-3 block rounded-full bg-amber-400 ring-2 ring-amber-500/30 border border-carbon-950"></span>
                                            @else
                                                <span class="w-2.5 h-2.5 block rounded-full bg-slate-600 border border-carbon-950"></span>
                                            @endif
                                        </div>

                                        <!-- Connector line to card -->
                                        <div class="w-6 h-px border-t border-dashed border-carbon-700 shrink-0"></div>

                                        <!-- Card Button Mobile -->
                                        <button type="button"
                                                @click="openDrawer({{ $item->id }})"
                                                :class="getNodeClasses('{{ $item->id }}')"
                                                class="flex-1 p-3 rounded-xl border transition-all duration-200 text-left flex items-start justify-between gap-2.5 group">
                                            <div class="space-y-0.5 min-w-0">
                                                <div class="text-xs font-semibold {{ $item->status === 'finished' ? 'text-emerald-300' : ($item->status === 'in_progress' ? 'text-amber-300' : 'text-slate-300') }}">
                                                    {{ $item->title }}
                                                </div>
                                                @if ($item->source_reference)
                                                    <div class="text-[9px] font-mono text-slate-500 truncate">{{ $item->source_reference }}</div>
                                                @endif
                                            </div>

                                            <div class="flex items-center gap-1 shrink-0 font-mono text-[9px]">
                                                @if ($item->note)
                                                    <span class="px-1 py-0.5 rounded bg-indigo-500/10 border border-indigo-500/30 text-indigo-400">Note</span>
                                                @elseif ($item->external_url)
                                                    <span class="px-1 py-0.5 rounded bg-sky-500/10 border border-sky-500/30 text-sky-400">Blog</span>
                                                @endif
                                                <svg class="w-3 h-3 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </div>
                                        </button>
                                    </div>

                                </div>
                            @endforeach
                        </div>

                    </div>
                @endforeach
            </div>

            <!-- ── Back to Top & Return to Home Bar ── -->
            <div class="pt-8 border-t border-carbon-800/80 flex flex-col sm:flex-row items-center justify-between gap-4 font-mono text-xs">
                <a href="/" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-carbon-900 hover:bg-carbon-850 border border-carbon-800 text-slate-300 hover:text-white transition-colors">
                    <svg class="w-4 h-4 text-vermilion-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali ke Beranda</span>
                </a>

                <button type="button" @click="window.scrollTo({ top: 0, behavior: 'smooth' })" class="text-slate-400 hover:text-white transition-colors flex items-center gap-1.5 cursor-pointer">
                    <span>Kembali ke Atas</span>
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                    </svg>
                </button>
            </div>

        </main>

        <!-- ── FOOTER ── -->
        <footer class="mt-16 border-t border-white/[0.08] py-8 text-center text-xs font-mono text-slate-500">
            <div class="max-w-6xl mx-auto px-4 space-y-2">
                <p>&copy; {{ date('Y') }} Moch Hasbi Ashidqy &bull; IT Support &amp; Systems Engineer.</p>
                <p class="text-slate-600">Built with Laravel, Blade, Tailwind CSS &amp; Alpine.js &bull; Inspired by Roadmap.sh Network Engineer Spec.</p>
            </div>
        </footer>

    </div>

    <!-- ─── SLIDE-OVER SIDE DRAWER (ROADMAP.SH PERSIS GAMBAR 3) ─── -->
    <div x-show="drawerOpen" x-cloak
         class="fixed inset-0 z-50 overflow-hidden" role="dialog" aria-modal="true">

        <!-- Backdrop Overlay -->
        <div x-show="drawerOpen"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="closeDrawer()"
             class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity"></div>

        <!-- Slide-Over Panel at Right Side -->
        <div class="fixed inset-y-0 right-0 max-w-full flex pl-10">
            <div x-show="drawerOpen"
                 x-transition:enter="transform transition ease-in-out duration-300 sm:duration-400"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transform transition ease-in-out duration-200 sm:duration-300"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full"
                 @click.stop
                 class="w-screen max-w-md sm:max-w-xl bg-carbon-900 border-l border-carbon-800 shadow-2xl flex flex-col justify-between overflow-y-auto">

                <!-- Drawer Content -->
                <div class="flex-1 p-6 sm:p-8 space-y-6">

                    <!-- Drawer Top Bar: Tab & Status Badge & Close Button -->
                    <div class="flex items-center justify-between pb-4 border-b border-carbon-800">
                        <div class="flex items-center gap-2">
                            <!-- Resources Pill Tab -->
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md bg-white/10 text-white font-mono text-xs font-semibold">
                                <svg class="w-3.5 h-3.5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <span>Resources</span>
                            </span>

                            <!-- Status Badge -->
                            <template x-if="activeCheckpoint?.status === 'finished'">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 text-xs font-mono font-medium">
                                    <svg class="w-3 h-3 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Done / Clear</span>
                                </span>
                            </template>
                            <template x-if="activeCheckpoint?.status === 'in_progress'">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-amber-500/20 border border-amber-500/40 text-amber-300 text-xs font-mono font-medium">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                                    <span>Learning</span>
                                </span>
                            </template>
                            <template x-if="activeCheckpoint?.status === 'not_started'">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-slate-800 text-slate-300 text-xs font-mono font-medium">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span>
                                    <span>Planned</span>
                                </span>
                            </template>
                        </div>

                        <!-- Close Button -->
                        <button type="button" @click="closeDrawer()" aria-label="Tutup Panel"
                                class="p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-carbon-850 transition-colors cursor-pointer">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Topic Title & Phase Breadcrumb -->
                    <div class="space-y-1.5">
                        <div class="text-[11px] font-mono text-indigo-400 tracking-wider uppercase" x-text="activeCheckpoint?.phase_name"></div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight" x-text="activeCheckpoint?.title"></h2>
                    </div>

                    <!-- Description / Body Text -->
                    <div class="prose prose-invert max-w-none text-slate-300 text-sm sm:text-base leading-relaxed space-y-3 font-normal">
                        <p x-text="activeCheckpoint?.description"></p>
                    </div>

                    <!-- Reference Pill -->
                    <template x-if="activeCheckpoint?.source_reference">
                        <div class="flex items-center gap-2 text-xs font-mono text-slate-400 pt-2">
                            <span class="text-slate-500">Kurikulum Standar:</span>
                            <span class="px-2 py-0.5 rounded bg-carbon-950 border border-carbon-800 text-indigo-300" x-text="activeCheckpoint?.source_reference"></span>
                        </div>
                    </template>

                    <!-- ── LEARNING RESOURCES SECTION ── -->
                    <div class="space-y-3 pt-6 border-t border-carbon-800/80">
                        <div class="flex items-center gap-2 font-mono text-xs font-semibold uppercase tracking-wider text-slate-200">
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            <span>Materi Pembelajaran &amp; Referensi</span>
                        </div>

                        <!-- 1. JIKA ADA NOTE TEKNIS INTERNAL (PRIORITAS UTAMA) -->
                        <template x-if="activeCheckpoint?.note">
                            <a :href="`/notes/${activeCheckpoint.note.slug}`"
                               class="flex items-center justify-between p-4 rounded-xl bg-indigo-500/10 hover:bg-indigo-500/20 border border-indigo-500/40 text-white transition-all group shadow-lg shadow-indigo-500/10">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2">
                                        <span class="text-[10px] font-mono font-bold uppercase px-2 py-0.5 rounded bg-indigo-500 text-white">
                                            Catatan Teknis Saya
                                        </span>
                                        <span class="text-xs text-indigo-300 font-mono" x-text="activeCheckpoint.note.reading_time || 'Artikel Lengkap'"></span>
                                    </div>
                                    <h4 class="text-sm font-bold text-white group-hover:text-indigo-200 transition-colors" x-text="activeCheckpoint.note.title"></h4>
                                    <p class="text-xs text-slate-400 line-clamp-1" x-text="activeCheckpoint.note.content"></p>
                                </div>
                                <svg class="w-5 h-5 text-indigo-400 group-hover:translate-x-1 transition-transform shrink-0 ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </template>

                        <!-- 2. JIKA BELUM ADA NOTE INTERNAL -> PAKAI BLOG LAIN / EXTERNAL RESOURCES -->
                        <template x-if="!activeCheckpoint?.note && activeCheckpoint?.external_url">
                            <a :href="activeCheckpoint.external_url" target="_blank" rel="noopener noreferrer"
                               class="flex items-center justify-between p-4 rounded-xl bg-carbon-950 hover:bg-carbon-850 border border-carbon-800 hover:border-slate-700 text-white transition-all group">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2 font-mono">
                                        <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded bg-sky-500/20 border border-sky-500/30 text-sky-300">
                                            Official / Terkurasi
                                        </span>
                                        <span class="text-xs text-slate-400" x-text="activeCheckpoint.external_url_title || 'Dokumentasi Resmi'"></span>
                                    </div>
                                    <h4 class="text-sm font-semibold text-white group-hover:text-sky-300 transition-colors flex items-center gap-1.5">
                                        <span x-text="activeCheckpoint.external_url_title || 'Baca Panduan Lengkap'"></span>
                                        <svg class="w-3.5 h-3.5 text-slate-500 group-hover:text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </h4>
                                    <p class="text-xs text-slate-500 font-mono truncate max-w-sm" x-text="activeCheckpoint.external_url"></p>
                                </div>
                                <span class="text-xs font-mono text-slate-400 group-hover:text-white group-hover:translate-x-1 transition-all">Buka &rarr;</span>
                            </a>
                        </template>

                        <!-- 3. JIKA ADA PROYEK TERAPAN -->
                        <template x-if="activeCheckpoint?.project">
                            <a href="/#projects"
                               class="flex items-center justify-between p-4 rounded-xl bg-vermilion-500/10 hover:bg-vermilion-500/20 border border-vermilion-500/30 text-white transition-all group">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2 font-mono">
                                        <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded bg-vermilion-500 text-white">
                                            Implementasi Riil
                                        </span>
                                        <span class="text-xs text-vermilion-300">Featured Project</span>
                                    </div>
                                    <h4 class="text-sm font-bold text-white group-hover:text-vermilion-200 transition-colors" x-text="activeCheckpoint.project.title"></h4>
                                </div>
                                <span class="text-xs font-mono text-vermilion-400 group-hover:translate-x-1 transition-transform">Lihat Proyek &rarr;</span>
                            </a>
                        </template>
                    </div>

                </div>

                <!-- Drawer Footer (Recruiter View Only) -->
                <div class="p-6 bg-carbon-950 border-t border-carbon-800/80 flex items-center justify-between font-mono text-xs text-slate-500">
                    <span class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        <span>Verifikasi Portofolio Moch Hasbi Ashidqy</span>
                    </span>
                    <button type="button" @click="closeDrawer()" class="text-slate-400 hover:text-white transition-colors cursor-pointer">
                        Tutup Panel ✕
                    </button>
                </div>

            </div>
        </div>

    </div>

    <!-- ── Alpine App Logic Script ── -->
    <script>
        function roadmapApp(config) {
            return {
                stats: config.initialStats,
                checkpoints: config.initialCheckpoints,
                selectedStatus: 'all',
                search: '',
                drawerOpen: false,
                activeCheckpoint: null,

                getCheckpointStatus(id) {
                    const item = this.checkpoints.find(c => c.id == id);
                    return item ? item.status : 'not_started';
                },

                getNodeClasses(id) {
                    const status = this.getCheckpointStatus(id);
                    if (status === 'finished') {
                        return 'bg-emerald-950/20 border-emerald-500/40 hover:border-emerald-400 hover:bg-emerald-950/30 shadow-sm shadow-emerald-500/10';
                    }
                    if (status === 'in_progress') {
                        return 'bg-amber-950/20 border-amber-500/40 hover:border-amber-400 hover:bg-amber-950/30 shadow-sm shadow-amber-500/10';
                    }
                    return 'bg-carbon-900 border-carbon-800 hover:border-carbon-700 hover:bg-carbon-850';
                },

                matchesFilter(id) {
                    const item = this.checkpoints.find(c => c.id == id);
                    if (!item) return false;

                    const matchStatus = (this.selectedStatus === 'all' || this.selectedStatus === item.status);
                    const query = this.search.toLowerCase().trim();
                    const matchSearch = !query || 
                        item.title.toLowerCase().includes(query) || 
                        (item.description && item.description.toLowerCase().includes(query)) ||
                        (item.source_reference && item.source_reference.toLowerCase().includes(query));

                    return matchStatus && matchSearch;
                },

                openDrawer(id) {
                    this.activeCheckpoint = this.checkpoints.find(c => c.id == id);
                    this.drawerOpen = true;
                    document.body.classList.add('overflow-hidden');
                },

                closeDrawer() {
                    this.drawerOpen = false;
                    document.body.classList.remove('overflow-hidden');
                }
            };
        }
    </script>

</body>
</html>
