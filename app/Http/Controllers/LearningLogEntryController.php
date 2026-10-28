<?php

namespace App\Http\Controllers;

use App\Http\Requests\LearningLogEntryRequest;
use App\Models\LearningLogEntry;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LearningLogEntryController extends Controller
{
    /**
     * Display a listing of technical notes & learning log entries.
     */
    public function index(Request $request): View|JsonResponse
    {
        $query = LearningLogEntry::with('relatedProject')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at');

        $selectedCategory = $request->query('category');
        if (!empty($selectedCategory) && $selectedCategory !== 'all') {
            $query->where('category', $selectedCategory);
        }

        $selectedTag = $request->query('tag');
        if (!empty($selectedTag) && $selectedTag !== 'all') {
            $query->where('tag', $selectedTag);
        }

        $selectedStatus = $request->query('status');
        if (!empty($selectedStatus) && $selectedStatus !== 'all') {
            $query->where('status', $selectedStatus);
        }

        $search = $request->query('q');
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('body', 'like', "%{$search}%");
            });
        }

        $entries = $query->get();

        if ($request->wantsJson()) {
            return response()->json($entries);
        }

        $stats = [
            'total'            => LearningLogEntry::count(),
            'laravel'          => LearningLogEntry::where('category', LearningLogEntry::CATEGORY_LARAVEL)->count(),
            'cloud'            => LearningLogEntry::where('category', LearningLogEntry::CATEGORY_CLOUD)->count(),
            'production_ready' => LearningLogEntry::where('tag', LearningLogEntry::TAG_PRODUCTION_READY)->count(),
            'exploring'        => LearningLogEntry::where('tag', LearningLogEntry::TAG_EXPLORING)->count(),
            'published'        => LearningLogEntry::where('status', 'published')->count(),
            'draft'            => LearningLogEntry::where('status', 'draft')->count(),
        ];

        return view('learning-log.index', compact('entries', 'stats', 'selectedCategory', 'selectedTag', 'selectedStatus', 'search'));
    }

    /**
     * Show the form for creating a new technical note.
     */
    public function create(): View
    {
        $projects = Project::orderBy('complexity_order')->get();

        return view('learning-log.create', compact('projects'));
    }

    /**
     * Store a newly created technical note in storage.
     */
    public function store(LearningLogEntryRequest $request): RedirectResponse|JsonResponse
    {
        $entry = LearningLogEntry::create($request->validated());

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Learning log entry created successfully.',
                'data'    => $entry->load('relatedProject'),
            ], 201);
        }

        return redirect()->route('learning-log.index')
            ->with('status', 'Artikel catatan teknis "' . $entry->title . '" berhasil diterbitkan.');
    }

    /**
     * Display the specified technical note.
     */
    public function show(LearningLogEntry $learningLogEntry, Request $request): View|JsonResponse|RedirectResponse
    {
        if ($request->wantsJson()) {
            return response()->json($learningLogEntry->load('relatedProject'));
        }

        return redirect()->route('learning-log.edit', $learningLogEntry);
    }

    /**
     * Show the form for editing the specified technical note.
     */
    public function edit(LearningLogEntry $learningLogEntry): View
    {
        $learningLogEntry->load('relatedProject');
        $projects = Project::orderBy('complexity_order')->get();

        return view('learning-log.edit', compact('learningLogEntry', 'projects'));
    }

    /**
     * Update the specified technical note in storage.
     */
    public function update(LearningLogEntryRequest $request, LearningLogEntry $learningLogEntry): RedirectResponse|JsonResponse
    {
        $learningLogEntry->update($request->validated());

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Learning log entry updated successfully.',
                'data'    => $learningLogEntry->load('relatedProject'),
            ]);
        }

        return redirect()->route('learning-log.index')
            ->with('status', 'Catatan teknis "' . $learningLogEntry->title . '" berhasil diperbarui.');
    }

    /**
     * Remove the specified technical note from storage.
     */
    public function destroy(LearningLogEntry $learningLogEntry, Request $request): RedirectResponse|JsonResponse
    {
        $title = $learningLogEntry->title;
        $learningLogEntry->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Learning log entry deleted successfully.',
            ]);
        }

        return redirect()->route('learning-log.index')
            ->with('status', 'Catatan teknis "' . $title . '" berhasil dihapus.');
    }
}
