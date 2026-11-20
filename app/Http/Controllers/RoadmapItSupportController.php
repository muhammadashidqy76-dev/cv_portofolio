<?php

namespace App\Http\Controllers;

use App\Models\RoadmapRole;
use App\Models\RoadmapCheckpoint;
use App\Models\LearningLogEntry;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RoadmapItSupportController extends Controller
{
    /**
     * Tampilkan halaman daftar manajemen Roadmap IT Support di Dashboard.
     */
    public function index(): View
    {
        $role = RoadmapRole::firstOrCreate(
            ['slug' => 'it-support'],
            [
                'name'          => 'IT Support & Systems',
                'tagline'       => 'Peta kurikulum penguasaan jaringan komputer, protokol inti internet, pemeliharaan hardware, dan studi kasus operasional IT support in-house.',
                'status'        => 'published',
                'display_order' => 1,
            ]
        );

        $checkpoints = RoadmapCheckpoint::with(['note', 'project'])
            ->where('roadmap_role_id', $role->id)
            ->orderBy('phase_name')
            ->orderBy('display_order')
            ->get();

        $stats = [
            'total'       => $checkpoints->count(),
            'finished'    => $checkpoints->where('status', RoadmapCheckpoint::STATUS_FINISHED)->count(),
            'in_progress' => $checkpoints->where('status', RoadmapCheckpoint::STATUS_IN_PROGRESS)->count(),
            'not_started' => $checkpoints->where('status', RoadmapCheckpoint::STATUS_NOT_STARTED)->count(),
        ];

        $stats['percentage'] = $stats['total'] > 0
            ? round(($stats['finished'] / $stats['total']) * 100)
            : 0;

        $phases = $checkpoints->groupBy('phase_name');

        return view('roadmap_it_support.index', compact('role', 'checkpoints', 'stats', 'phases'));
    }

    /**
     * Tampilkan form pembuatan checkpoint roadmap baru.
     */
    public function create(): View
    {
        $role = RoadmapRole::where('slug', 'it-support')->firstOrFail();
        $notes = LearningLogEntry::published()->orderBy('title')->get(['id', 'title', 'slug', 'category']);
        $projects = Project::published()->orderBy('complexity_order')->get();

        // Daftar fase yang sudah ada sebagai referensi
        $existingPhases = RoadmapCheckpoint::where('roadmap_role_id', $role->id)
            ->distinct()
            ->orderBy('phase_name')
            ->pluck('phase_name');

        return view('roadmap_it_support.create', compact('role', 'notes', 'projects', 'existingPhases'));
    }

    /**
     * Simpan checkpoint roadmap baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $role = RoadmapRole::where('slug', 'it-support')->firstOrFail();

        $validated = $request->validate([
            'phase_name'                 => 'required|string|max:255',
            'title'                      => 'required|string|max:255',
            'description'                => 'nullable|string',
            'status'                     => 'required|in:finished,in_progress,not_started',
            'source_reference'           => 'nullable|string|max:255',
            'external_resources'         => 'nullable|array',
            'external_resources.*.title' => 'nullable|string|max:255',
            'external_resources.*.url'   => 'nullable|url|max:500',
            'external_url'               => 'nullable|url|max:500',
            'external_url_title'         => 'nullable|string|max:255',
            'learning_log_entry_id'      => 'nullable|exists:learning_log_entries,id',
            'project_id'                 => 'nullable|exists:projects,id',
            'display_order'              => 'required|integer|min:0',
        ]);

        $cleanedResources = [];
        if (!empty($request->input('external_resources')) && is_array($request->input('external_resources'))) {
            foreach ($request->input('external_resources') as $item) {
                $url = trim($item['url'] ?? '');
                $title = trim($item['title'] ?? '');
                if (!empty($url)) {
                    $cleanedResources[] = [
                        'title' => $title ?: 'Bahan Bacaan & Referensi',
                        'url'   => $url,
                    ];
                }
            }
        }
        $validated['external_resources'] = $cleanedResources;

        // Auto-sync backward compatibility fields:
        if (!empty($cleanedResources)) {
            $validated['external_url'] = $cleanedResources[0]['url'];
            $validated['external_url_title'] = $cleanedResources[0]['title'];
        } elseif (!empty($request->input('external_url'))) {
            $validated['external_url'] = $request->input('external_url');
            $validated['external_url_title'] = $request->input('external_url_title');
        } else {
            $validated['external_url'] = null;
            $validated['external_url_title'] = null;
        }

        $validated['roadmap_role_id'] = $role->id;

        RoadmapCheckpoint::create($validated);

        return redirect()->route('roadmap-it-support.index')
            ->with('status', 'Checkpoint Roadmap IT Support berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit checkpoint roadmap.
     */
    public function edit(RoadmapCheckpoint $roadmap_it_support): View
    {
        $checkpoint = $roadmap_it_support;
        $role = $checkpoint->role;
        $notes = LearningLogEntry::published()->orderBy('title')->get(['id', 'title', 'slug', 'category']);
        $projects = Project::published()->orderBy('complexity_order')->get();

        $existingPhases = RoadmapCheckpoint::where('roadmap_role_id', $checkpoint->roadmap_role_id)
            ->distinct()
            ->orderBy('phase_name')
            ->pluck('phase_name');

        return view('roadmap_it_support.edit', compact('checkpoint', 'role', 'notes', 'projects', 'existingPhases'));
    }

    /**
     * Perbarui data checkpoint roadmap.
     */
    public function update(Request $request, RoadmapCheckpoint $roadmap_it_support): RedirectResponse
    {
        $checkpoint = $roadmap_it_support;

        $validated = $request->validate([
            'phase_name'                 => 'required|string|max:255',
            'title'                      => 'required|string|max:255',
            'description'                => 'nullable|string',
            'status'                     => 'required|in:finished,in_progress,not_started',
            'source_reference'           => 'nullable|string|max:255',
            'external_resources'         => 'nullable|array',
            'external_resources.*.title' => 'nullable|string|max:255',
            'external_resources.*.url'   => 'nullable|url|max:500',
            'external_url'               => 'nullable|url|max:500',
            'external_url_title'         => 'nullable|string|max:255',
            'learning_log_entry_id'      => 'nullable|exists:learning_log_entries,id',
            'project_id'                 => 'nullable|exists:projects,id',
            'display_order'              => 'required|integer|min:0',
        ]);

        $cleanedResources = [];
        if (!empty($request->input('external_resources')) && is_array($request->input('external_resources'))) {
            foreach ($request->input('external_resources') as $item) {
                $url = trim($item['url'] ?? '');
                $title = trim($item['title'] ?? '');
                if (!empty($url)) {
                    $cleanedResources[] = [
                        'title' => $title ?: 'Bahan Bacaan & Referensi',
                        'url'   => $url,
                    ];
                }
            }
        }
        $validated['external_resources'] = $cleanedResources;

        // Auto-sync backward compatibility fields:
        if (!empty($cleanedResources)) {
            $validated['external_url'] = $cleanedResources[0]['url'];
            $validated['external_url_title'] = $cleanedResources[0]['title'];
        } elseif (!empty($request->input('external_url'))) {
            $validated['external_url'] = $request->input('external_url');
            $validated['external_url_title'] = $request->input('external_url_title');
        } else {
            $validated['external_url'] = null;
            $validated['external_url_title'] = null;
        }

        $checkpoint->update($validated);

        return redirect()->route('roadmap-it-support.index')
            ->with('status', "Checkpoint '{$checkpoint->title}' berhasil diperbarui.");
    }

    /**
     * Hapus checkpoint roadmap dari database.
     */
    public function destroy(RoadmapCheckpoint $roadmap_it_support): RedirectResponse
    {
        $checkpoint = $roadmap_it_support;
        $title = $checkpoint->title;
        $checkpoint->delete();

        return redirect()->route('roadmap-it-support.index')
            ->with('status', "Checkpoint '{$title}' berhasil dihapus.");
    }

    /**
     * Quick toggle status via form / AJAX dari dashboard.
     */
    public function toggleStatus(Request $request, RoadmapCheckpoint $checkpoint): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:finished,in_progress,not_started',
        ]);

        $checkpoint->update(['status' => $validated['status']]);

        return redirect()->back()
            ->with('status', "Status '{$checkpoint->title}' berhasil diubah menjadi " . strtoupper($validated['status']) . ".");
    }
}

