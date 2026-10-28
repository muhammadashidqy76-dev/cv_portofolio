<?php

namespace App\Http\Controllers;

use App\Http\Requests\TechStackItemRequest;
use App\Models\Project;
use App\Models\TechStackItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TechStackItemController extends Controller
{
    /**
     * Display a listing of tech stack items.
     */
    public function index(Request $request): View|JsonResponse
    {
        $query = TechStackItem::withCount('projects')
            ->orderBy('category')
            ->orderBy('display_order');

        $selectedCategory = $request->query('category');
        if (!empty($selectedCategory) && $selectedCategory !== 'all') {
            $query->where('category', $selectedCategory);
        }

        $items = $query->get();

        if ($request->wantsJson()) {
            return response()->json($items);
        }

        $itemsGrouped = $items->groupBy('category');

        $categories = TechStackItem::select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category')
            ->toArray();

        $stats = [
            'total'       => TechStackItem::count(),
            'finished'    => TechStackItem::where('status', TechStackItem::STATUS_FINISHED)->count(),
            'in_progress' => TechStackItem::where('status', TechStackItem::STATUS_IN_PROGRESS)->count(),
            'not_started' => TechStackItem::where('status', TechStackItem::STATUS_NOT_STARTED)->count(),
        ];

        return view('tech-stack.index', compact('itemsGrouped', 'categories', 'stats', 'selectedCategory'));
    }

    /**
     * Show the form for creating a new tech stack item.
     */
    public function create(Request $request): View
    {
        $existingCategories = TechStackItem::select('category')
            ->distinct()
            ->pluck('category')
            ->toArray();

        $presetCategories = ['Backend', 'Database', 'Tools', 'Frontend', 'Cloud & DevOps'];
        $categories = array_values(array_unique(array_merge($presetCategories, $existingCategories)));

        $selectedCategory = $request->query('category', 'Backend');

        $nextOrder = (TechStackItem::where('category', $selectedCategory)->max('display_order') ?? 0) + 1;

        $projects = Project::orderBy('complexity_order')->get();

        return view('tech-stack.create', compact('categories', 'selectedCategory', 'nextOrder', 'projects'));
    }

    /**
     * Store a newly created tech stack item in storage.
     */
    public function store(TechStackItemRequest $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validated();
        unset($validated['custom_category'], $validated['project_ids']);

        $item = TechStackItem::create($validated);

        if ($request->has('project_ids')) {
            $item->projects()->sync($request->input('project_ids', []));
        }

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Tech stack item created successfully.',
                'data'    => $item->load('projects'),
            ], 201);
        }

        return redirect()->route('tech-stack.index')
            ->with('status', 'Item teknologi "' . $item->name . '" berhasil ditambahkan.');
    }

    /**
     * Display the specified tech stack item.
     */
    public function show(TechStackItem $techStackItem, Request $request): View|JsonResponse|RedirectResponse
    {
        if ($request->wantsJson()) {
            return response()->json($techStackItem->load('projects'));
        }

        return redirect()->route('tech-stack.edit', $techStackItem);
    }

    /**
     * Show the form for editing the specified tech stack item.
     */
    public function edit(TechStackItem $techStackItem): View
    {
        $techStackItem->load('projects');

        $existingCategories = TechStackItem::select('category')
            ->distinct()
            ->pluck('category')
            ->toArray();

        $presetCategories = ['Backend', 'Database', 'Tools', 'Frontend', 'Cloud & DevOps'];
        $categories = array_values(array_unique(array_merge($presetCategories, $existingCategories)));

        $projects = Project::orderBy('complexity_order')->get();

        return view('tech-stack.edit', compact('techStackItem', 'categories', 'projects'));
    }

    /**
     * Update the specified tech stack item in storage.
     */
    public function update(TechStackItemRequest $request, TechStackItem $techStackItem): RedirectResponse|JsonResponse
    {
        $validated = $request->validated();
        unset($validated['custom_category'], $validated['project_ids']);

        $techStackItem->update($validated);

        // Sinkronisasi relasi pivot (menambah yang dicentang, melepas yang tidak dicentang)
        $techStackItem->projects()->sync($request->input('project_ids', []));

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Tech stack item updated successfully.',
                'data'    => $techStackItem->load('projects'),
            ]);
        }

        return redirect()->route('tech-stack.index')
            ->with('status', 'Item teknologi "' . $techStackItem->name . '" berhasil diperbarui.');
    }

    /**
     * Remove the specified tech stack item from storage.
     */
    public function destroy(TechStackItem $techStackItem, Request $request): RedirectResponse|JsonResponse
    {
        $name = $techStackItem->name;

        // Detach from any projects (pivot)
        $techStackItem->projects()->detach();
        $techStackItem->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Tech stack item deleted successfully.',
            ]);
        }

        return redirect()->route('tech-stack.index')
            ->with('status', 'Item teknologi "' . $name . '" berhasil dihapus.');
    }
}
