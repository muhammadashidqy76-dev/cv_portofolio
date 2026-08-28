@props(['workExperiences' => null])

@php
    $items = $workExperiences;

    if ($items === null && class_exists(\App\Models\WorkExperience::class)) {
        $items = \App\Models\WorkExperience::published()->chronological()->get();
    }
@endphp

@if($items && $items->isNotEmpty())
<section id="experience" class="py-16 md:py-24 bg-[#0b0f19] border-t border-slate-800/80 relative overflow-hidden">
    <!-- Ambient background glow -->
    <div class="absolute top-1/2 -left-48 w-96 h-96 bg-sky-500/5 rounded-full blur-3xl pointer-events-none -translate-y-1/2"></div>
    <div class="absolute top-1/2 -right-48 w-96 h-96 bg-red-500/5 rounded-full blur-3xl pointer-events-none -translate-y-1/2"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Section Header -->
        <div class="mb-12">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 border border-slate-800 text-xs font-mono text-slate-400 mb-4">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Work Experience &amp; Internships</span>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                        Pengalaman Kerja &amp; Magang
                    </h2>
                    <p class="mt-2 text-sm sm:text-base text-slate-400 max-w-2xl">
                        Rekam jejak kontribusi teknis dan pengalaman profesional dalam pengembangan sistem backend.
                    </p>
                </div>
            </div>
        </div>

        <!-- Work Experience List / Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($items as $experience)
                @php
                    $duration = $experience->duration_label ?? '';
                    $typeBadge = $experience->employment_type_badge_classes ?? 'text-sky-400 bg-sky-500/10 border-sky-500/20';
                    $typeLabel = $experience->employment_type_label ?? 'Internship';
                @endphp

                <!-- Experience Card -->
                <article class="group flex flex-col justify-between rounded-xl bg-slate-900/70 border border-slate-800 hover:border-slate-700/80 transition-all duration-200 hover:-translate-y-0.5 overflow-hidden h-full">
                    
                    <div>
                        <!-- Header Bar (3 colored dots, employment type badge, duration label) -->
                        <div class="flex items-center justify-between px-4 py-3 bg-slate-900 border-b border-slate-800/60 gap-2 flex-wrap">
                            <div class="flex items-center gap-2">
                                <div class="flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-rose-500/70"></span>
                                    <span class="w-2 h-2 rounded-full bg-amber-400/70"></span>
                                    <span class="w-2 h-2 rounded-full bg-emerald-400/70"></span>
                                </div>
                                <span class="font-mono text-[10px] font-semibold uppercase px-2 py-0.5 rounded border {{ $typeBadge }}">
                                    {{ $typeLabel }}
                                </span>
                            </div>

                            @if($duration)
                                <span class="font-mono text-[10px] text-rose-300/80 bg-red-500/10 border border-red-500/20 px-2 py-0.5 rounded shrink-0">
                                    {{ $duration }}
                                </span>
                            @endif
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 sm:p-6 flex flex-col gap-4">
                            <!-- Position & Company -->
                            <div>
                                <h3 class="text-base sm:text-lg font-bold text-white group-hover:text-red-400 transition-colors leading-snug">
                                    {{ $experience->position }}
                                </h3>
                                <div class="flex items-center gap-2 mt-1 text-xs text-slate-300 font-medium flex-wrap">
                                    <span class="text-slate-200">{{ $experience->company_name }}</span>
                                    @if(!empty($experience->location))
                                        <span class="text-slate-600">&bull;</span>
                                        <span class="inline-flex items-center gap-1 text-slate-400">
                                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <span>{{ $experience->location }}</span>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Description -->
                            @if(!empty($experience->description))
                                <div class="p-3.5 rounded-lg bg-[#080d14] border border-slate-800/80">
                                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                                        {{ $experience->description }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                </article>
            @endforeach
        </div>

    </div>
</section>
@endif
