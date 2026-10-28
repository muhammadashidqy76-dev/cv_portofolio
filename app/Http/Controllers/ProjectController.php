<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\TechStackItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects.
     */
    public function index(Request $request): View|JsonResponse
    {
        $projects = Project::with('techStackItems')
            ->orderedByComplexity()
            ->get();

        if ($request->wantsJson()) {
            return response()->json($projects);
        }

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create(): View
    {
        $techStackItems = TechStackItem::orderBy('category')
            ->orderBy('display_order')
            ->get()
            ->groupBy('category');

        $nextOrder = (Project::max('complexity_order') ?? 0) + 1;

        return view('projects.create', compact('techStackItems', 'nextOrder'));
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(ProjectRequest $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title_id'] ?? $validated['title'] ?? 'project');
        }

        // Handle Preview Image Upload
        if ($request->hasFile('preview_image')) {
            $path = $request->file('preview_image')->store('projects', 'public');
            $validated['preview_image_path'] = $path;
        }
        unset($validated['preview_image']);

        $project = Project::create($validated);

        if (isset($validated['tech_stack_items'])) {
            $project->techStackItems()->sync($validated['tech_stack_items']);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Project created successfully.',
                'data' => $project->load('techStackItems'),
            ], 201);
        }

        return redirect()->route('projects.index')
            ->with('status', 'Proyek "' . $project->title . '" berhasil ditambahkan.');
    }

    /**
     * Display the specified project.
     */
    public function show(Project $project, Request $request): View|JsonResponse|RedirectResponse
    {
        if ($request->wantsJson()) {
            return response()->json($project->load('techStackItems', 'journeyEntries', 'learningLogEntries'));
        }

        return redirect()->route('projects.edit', $project);
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project): View
    {
        $project->load('techStackItems');

        $techStackItems = TechStackItem::orderBy('category')
            ->orderBy('display_order')
            ->get()
            ->groupBy('category');

        $selectedTechIds = $project->techStackItems->pluck('id')->toArray();

        return view('projects.edit', compact('project', 'techStackItems', 'selectedTechIds'));
    }

    /**
     * Update the specified project in storage.
     */
    public function update(ProjectRequest $request, Project $project): RedirectResponse|JsonResponse
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title_id'] ?? $project->title_id ?? 'project');
        }

        // Handle Preview Image Upload or Removal
        if ($request->hasFile('preview_image')) {
            if (!empty($project->preview_image_path) && !Str::startsWith($project->preview_image_path, ['http://', 'https://'])) {
                Storage::disk('public')->delete($project->preview_image_path);
            }
            $path = $request->file('preview_image')->store('projects', 'public');
            $validated['preview_image_path'] = $path;
        } elseif ($request->filled('remove_preview_image') && $request->boolean('remove_preview_image')) {
            if (!empty($project->preview_image_path) && !Str::startsWith($project->preview_image_path, ['http://', 'https://'])) {
                Storage::disk('public')->delete($project->preview_image_path);
            }
            $validated['preview_image_path'] = null;
        }
        unset($validated['preview_image'], $validated['remove_preview_image']);

        $project->update($validated);

        if (isset($validated['tech_stack_items'])) {
            $project->techStackItems()->sync($validated['tech_stack_items']);
        } else {
            $project->techStackItems()->detach();
        }

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Project updated successfully.',
                'data' => $project->load('techStackItems'),
            ]);
        }

        return redirect()->route('projects.index')
            ->with('status', 'Proyek "' . $project->title . '" berhasil diperbarui.');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project, Request $request): RedirectResponse|JsonResponse
    {
        if (!empty($project->preview_image_path) && !Str::startsWith($project->preview_image_path, ['http://', 'https://'])) {
            Storage::disk('public')->delete($project->preview_image_path);
        }

        $project->techStackItems()->detach();
        $project->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Project deleted successfully.',
            ]);
        }

        return redirect()->route('projects.index')
            ->with('status', 'Proyek berhasil dihapus dari sistem.');
    }
}
