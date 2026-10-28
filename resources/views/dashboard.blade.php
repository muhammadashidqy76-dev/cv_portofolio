<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 font-mono text-xs text-slate-400 mb-1">
                    <span>CMS</span>
                    <span class="text-slate-600">/</span>
                    <span class="text-vermilion-400">Overview</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-bold font-mono text-white tracking-tight flex items-center gap-2">
                    <span>Control Room</span>
                    <span class="text-xs px-2 py-0.5 rounded font-normal font-mono bg-carbon-800 border border-carbon-700 text-slate-300">
                        Batch 1 &bull; Active
                    </span>
                </h1>
            </div>

            <!-- System Status Badges -->
            <div class="flex items-center gap-2 flex-wrap font-mono text-[11px]">
                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>SYSTEM_ONLINE</span>
                </div>
                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-carbon-900 border border-carbon-800 text-slate-400">
                    <span class="text-slate-500">ENV:</span>
                    <span class="text-slate-200">{{ app()->environment() }}</span>
                </div>
                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-carbon-900 border border-carbon-800 text-slate-400">
                    <span class="text-slate-500">OPERATOR:</span>
                    <span class="text-slate-200">{{ Auth::user()->name }}</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- ─── Metric Cards Grid ─────────────────────────────────────────────── -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                
                <!-- 1. Featured Projects -->
                <a href="{{ route('projects.index') }}" class="group rounded-xl bg-carbon-900/90 border border-carbon-800 p-4 sm:p-5 hover:border-vermilion-500/50 transition-all shadow-lg flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between text-xs font-mono text-slate-400 mb-2">
                            <span class="group-hover:text-vermilion-400 transition-colors">01. Projects &nearrow;</span>
                            <span class="text-[10px] px-1.5 py-0.5 rounded bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">Live</span>
                        </div>
                        <div class="text-2xl sm:text-3xl font-bold font-mono text-white">
                            {{ $projectStats['total'] }}
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-carbon-800/80 flex items-center justify-between text-xs font-mono">
                        <span class="text-emerald-400">{{ $projectStats['published'] }} Published</span>
                        <span class="text-slate-500">{{ $projectStats['draft'] }} Draft</span>
                    </div>
                </a>

                <!-- 2. Tech Stack -->
                <a href="{{ route('tech-stack.index') }}" class="group rounded-xl bg-carbon-900/90 border border-carbon-800 p-4 sm:p-5 hover:border-vermilion-500/50 transition-all shadow-lg flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between text-xs font-mono text-slate-400 mb-2">
                            <span class="group-hover:text-vermilion-400 transition-colors">02. Tech Stack &nearrow;</span>
                            <span class="text-[10px] px-1.5 py-0.5 rounded bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">Live</span>
                        </div>
                        <div class="text-2xl sm:text-3xl font-bold font-mono text-white">
                            {{ $techStats['total'] }}
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-carbon-800/80 flex items-center justify-between text-xs font-mono">
                        <span class="text-emerald-400">{{ $techStats['finished'] }} Mastered</span>
                        <span class="text-amber-400">{{ $techStats['in_progress'] }} Learning</span>
                    </div>
                </a>

                <!-- 3. Work Experience -->
                <a href="{{ route('work-experience.index') }}" class="group rounded-xl bg-carbon-900/90 border border-carbon-800 p-4 sm:p-5 hover:border-vermilion-500/50 transition-all shadow-lg flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between text-xs font-mono text-slate-400 mb-2">
                            <span class="group-hover:text-vermilion-400 transition-colors">03. Experience &nearrow;</span>
                            <span class="text-[10px] px-1.5 py-0.5 rounded bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">Live</span>
                        </div>
                        <div class="text-2xl sm:text-3xl font-bold font-mono text-white">
                            {{ $experienceStats['total'] }}
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-carbon-800/80 flex items-center justify-between text-xs font-mono">
                        <span class="text-cyan-400">{{ $experienceStats['current'] }} Posisi Aktif</span>
                        <span class="text-slate-500">{{ $experienceStats['published'] }} Live</span>
                    </div>
                </a>

                <!-- 4. Journey & Credentials -->
                <a href="{{ route('journey.index') }}" class="group rounded-xl bg-carbon-900/90 border border-carbon-800 p-4 sm:p-5 hover:border-vermilion-500/50 transition-all shadow-lg flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between text-xs font-mono text-slate-400 mb-2">
                            <span class="group-hover:text-vermilion-400 transition-colors">04. Journey &nearrow;</span>
                            <span class="text-[10px] px-1.5 py-0.5 rounded bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">Live</span>
                        </div>
                        <div class="text-2xl sm:text-3xl font-bold font-mono text-white">
                            {{ $journeyStats['total'] }}
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-carbon-800/80 flex items-center justify-between text-xs font-mono">
                        <span class="text-amber-400">{{ $journeyStats['certifications'] }} Sertifikat</span>
                        <span class="text-slate-500">{{ $journeyStats['courses'] }} Kursus</span>
                    </div>
                </a>

                <!-- 5. Learning Log / Technical Notes -->
                <a href="{{ route('learning-log.index') }}" class="group rounded-xl bg-carbon-900/90 border border-carbon-800 p-4 sm:p-5 hover:border-vermilion-500/50 transition-all shadow-lg flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between text-xs font-mono text-slate-400 mb-2">
                            <span class="group-hover:text-vermilion-400 transition-colors">05. Tech Notes &nearrow;</span>
                            <span class="text-[10px] px-1.5 py-0.5 rounded bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">Live</span>
                        </div>
                        <div class="text-2xl sm:text-3xl font-bold font-mono text-white">
                            {{ $noteStats['total'] }}
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-carbon-800/80 flex items-center justify-between text-xs font-mono">
                        <span class="text-vermilion-400">{{ $noteStats['laravel'] }} Laravel</span>
                        <span class="text-cyan-400">{{ $noteStats['cloud'] }} Cloud</span>
                    </div>
                </a>

            </div>


            <!-- ─── Two-Column Feed: Recent Technical Notes & Featured Projects ───── -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Left: Recent Technical Notes -->
                <div class="rounded-xl bg-carbon-900 border border-carbon-800 overflow-hidden shadow-xl flex flex-col justify-between">
                    <div>
                        <div class="px-5 py-3.5 bg-carbon-950/80 border-b border-carbon-800 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-vermilion-400"></span>
                                <h3 class="font-mono text-xs font-semibold text-white uppercase tracking-wider">
                                    Catatan Teknis Terkini
                                </h3>
                            </div>
                            <a href="{{ url('/notes') }}" target="_blank" class="text-xs font-mono text-vermilion-400 hover:text-vermilion-300 transition-colors">
                                Kelola Semua Catatan &nearrow;
                            </a>
                        </div>

                        <div class="divide-y divide-carbon-800/80">
                            @forelse ($recentNotes as $note)
                                <div class="p-4 sm:p-5 hover:bg-carbon-950/40 transition-colors">
                                    <div class="flex items-center justify-between gap-2 mb-1.5">
                                        <div class="flex items-center gap-2">
                                            @if ($note->category === 'cloud_engineering')
                                                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-medium bg-cyan-500/10 border border-cyan-500/20 text-cyan-400">
                                                    Cloud Engineering
                                                </span>
                                            @else
                                                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-medium bg-vermilion-500/10 border border-vermilion-500/20 text-vermilion-400">
                                                    Laravel Ecosystem
                                                </span>
                                            @endif

                                            <span class="text-[11px] font-mono text-slate-500">
                                                {{ $note->reading_time ?? '3 min' }}
                                            </span>
                                        </div>

                                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded {{ $note->status === 'published' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-slate-800 text-slate-400' }}">
                                            {{ ucfirst($note->status) }}
                                        </span>
                                    </div>

                                    <h4 class="font-mono text-sm font-semibold text-white hover:text-vermilion-400 transition-colors">
                                        <a href="{{ url('/notes/' . $note->slug) }}" target="_blank">
                                            {{ $note->title }}
                                        </a>
                                    </h4>

                                    <p class="text-xs text-slate-400 mt-1 line-clamp-2">
                                        {{ Str::limit(strip_tags($note->content), 120) }}
                                    </p>
                                </div>
                            @empty
                                <div class="p-8 text-center text-xs font-mono text-slate-500">
                                    Belum ada entri catatan teknis yang tersimpan.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="p-4 bg-carbon-950 border-t border-carbon-800 flex items-center justify-between text-xs font-mono text-slate-400">
                        <span>Total: {{ $noteStats['total'] }} Catatan</span>
                        <span class="text-slate-500">Notes</span>
                    </div>
                </div>

                <!-- Right: Featured Projects & Architecture Overview -->
                <div class="rounded-xl bg-carbon-900 border border-carbon-800 overflow-hidden shadow-xl flex flex-col justify-between">
                    <div>
                        <div class="px-5 py-3.5 bg-carbon-950/80 border-b border-carbon-800 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-cyan-400"></span>
                                <h3 class="font-mono text-xs font-semibold text-white uppercase tracking-wider">
                                    Featured Projects Utama
                                </h3>
                            </div>
                            <a href="{{ route('projects.index') }}" class="text-xs font-mono text-vermilion-400 hover:text-vermilion-300 transition-colors">
                                Kelola Semua Proyek &nearrow;
                            </a>
                        </div>

                        <div class="divide-y divide-carbon-800/80">
                            @forelse ($recentProjects as $project)
                                <div class="p-4 sm:p-5 hover:bg-carbon-950/40 transition-colors">
                                    <div class="flex items-center justify-between gap-2 mb-1.5">
                                        <div class="flex items-center gap-2">
                                            <span class="px-2 py-0.5 rounded text-[10px] font-mono font-medium bg-carbon-800 text-slate-300">
                                                Tier {{ $project->complexity_order }}
                                            </span>
                                            <span class="text-xs font-mono text-slate-400">
                                                {{ $project->techStackItems->count() }} Tech Items
                                            </span>
                                        </div>

                                        <span class="text-[10px] font-mono px-1.5 py-0.5 rounded {{ $project->status === 'published' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-slate-800 text-slate-400' }}">
                                            {{ ucfirst($project->status) }}
                                        </span>
                                    </div>

                                    <h4 class="font-mono text-sm font-semibold text-white">
                                        {{ $project->title }}
                                    </h4>

                                    <p class="text-xs text-slate-400 mt-1 line-clamp-2">
                                        {{ $project->problem_statement }}
                                    </p>

                                    <!-- Tech Badges preview -->
                                    <div class="flex flex-wrap gap-1.5 mt-3">
                                        @foreach ($project->techStackItems->take(4) as $tech)
                                            <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-carbon-950 border border-carbon-800 text-slate-300">
                                                {{ $tech->name }}
                                            </span>
                                        @endforeach
                                        @if ($project->techStackItems->count() > 4)
                                            <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-carbon-950 text-slate-500">
                                                +{{ $project->techStackItems->count() - 4 }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="p-8 text-center text-xs font-mono text-slate-500">
                                    Belum ada project yang tersimpan di database.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="p-4 bg-carbon-950 border-t border-carbon-800 flex items-center justify-between text-xs font-mono text-slate-400">
                        <span>Total: {{ $projectStats['total'] }} Projects</span>
                        <span class="text-slate-500">Featured Projects</span>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
