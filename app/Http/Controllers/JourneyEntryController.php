<?php

namespace App\Http\Controllers;

use App\Http\Requests\JourneyEntryRequest;
use App\Models\JourneyEntry;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class JourneyEntryController extends Controller
{
    /**
     * Display a listing of journey & credential entries.
     */
    public function index(Request $request): View|JsonResponse
    {
        $query = JourneyEntry::with('appliedProject')
            ->orderBy('display_order')
            ->orderByDesc('completed_at');

        $selectedType = $request->query('type');
        if (!empty($selectedType) && $selectedType !== 'all') {
            $query->where('credential_type', $selectedType);
        }

        $selectedStatus = $request->query('status');
        if (!empty($selectedStatus) && $selectedStatus !== 'all') {
            $query->where('status', $selectedStatus);
        }

        $entries = $query->get();

        if ($request->wantsJson()) {
            return response()->json($entries);
        }

        $stats = [
            'total'          => JourneyEntry::count(),
            'courses'        => JourneyEntry::where('credential_type', JourneyEntry::TYPE_COURSE)->count(),
            'certifications' => JourneyEntry::where('credential_type', JourneyEntry::TYPE_CERTIFICATION)->count(),
            'diplomas'       => JourneyEntry::where('credential_type', JourneyEntry::TYPE_DIPLOMA)->count(),
            'published'      => JourneyEntry::where('status', 'published')->count(),
            'draft'          => JourneyEntry::where('status', 'draft')->count(),
        ];

        return view('journey.index', compact('entries', 'stats', 'selectedType', 'selectedStatus'));
    }

    /**
     * Show the form for creating a new journey & credential entry.
     */
    public function create(): View
    {
        $projects = Project::orderBy('complexity_order')->get();
        $nextOrder = (JourneyEntry::max('display_order') ?? 0) + 1;

        return view('journey.create', compact('projects', 'nextOrder'));
    }

    /**
     * Store a newly created journey & credential entry in storage.
     */
    public function store(JourneyEntryRequest $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('certificate_file')) {
            $path = $request->file('certificate_file')->store('certificates', 'public');
            $validated['certificate_file_path'] = 'storage/' . $path;
        }

        unset($validated['certificate_file']);

        $entry = JourneyEntry::create($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Journey entry created successfully.',
                'data'    => $entry->load('appliedProject'),
            ], 201);
        }

        return redirect()->route('journey.index')
            ->with('status', 'Entri "' . $entry->course_name . '" berhasil ditambahkan ke timeline Journey.');
    }

    /**
     * Display the specified journey & credential entry.
     */
    public function show(JourneyEntry $journeyEntry, Request $request): View|JsonResponse|RedirectResponse
    {
        if ($request->wantsJson()) {
            return response()->json($journeyEntry->load('appliedProject'));
        }

        return redirect()->route('journey.edit', $journeyEntry);
    }

    /**
     * Show the form for editing the specified journey & credential entry.
     */
    public function edit(JourneyEntry $journeyEntry): View
    {
        $journeyEntry->load('appliedProject');
        $projects = Project::orderBy('complexity_order')->get();

        return view('journey.edit', compact('journeyEntry', 'projects'));
    }

    /**
     * Update the specified journey & credential entry in storage.
     */
    public function update(JourneyEntryRequest $request, JourneyEntry $journeyEntry): RedirectResponse|JsonResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('certificate_file')) {
            // Delete old uploaded file if it was in storage
            if (!empty($journeyEntry->certificate_file_path) && str_starts_with($journeyEntry->certificate_file_path, 'storage/certificates/')) {
                $oldRel = str_replace('storage/', '', $journeyEntry->certificate_file_path);
                Storage::disk('public')->delete($oldRel);
            }

            $path = $request->file('certificate_file')->store('certificates', 'public');
            $validated['certificate_file_path'] = 'storage/' . $path;
        }

        unset($validated['certificate_file']);

        $journeyEntry->update($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Journey entry updated successfully.',
                'data'    => $journeyEntry->load('appliedProject'),
            ]);
        }

        return redirect()->route('journey.index')
            ->with('status', 'Entri "' . $journeyEntry->course_name . '" berhasil diperbarui.');
    }

    /**
     * Remove the specified journey & credential entry from storage.
     */
    public function destroy(JourneyEntry $journeyEntry, Request $request): RedirectResponse|JsonResponse
    {
        $name = $journeyEntry->course_name;

        if (!empty($journeyEntry->certificate_file_path) && str_starts_with($journeyEntry->certificate_file_path, 'storage/certificates/')) {
            $oldRel = str_replace('storage/', '', $journeyEntry->certificate_file_path);
            Storage::disk('public')->delete($oldRel);
        }

        $journeyEntry->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Journey entry deleted successfully.',
            ]);
        }

        return redirect()->route('journey.index')
            ->with('status', 'Entri "' . $name . '" berhasil dihapus dari Journey.');
    }
}
