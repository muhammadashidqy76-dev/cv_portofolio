<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkExperienceRequest;
use App\Models\WorkExperience;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WorkExperienceController extends Controller
{
    /**
     * Display a listing of work experiences.
     */
    public function index(Request $request): View|JsonResponse
    {
        $query = WorkExperience::query()
            ->orderByDesc('is_current')
            ->orderByDesc('start_date')
            ->orderBy('display_order');

        $selectedStatus = $request->query('status');
        if (!empty($selectedStatus) && $selectedStatus !== 'all') {
            $query->where('status', $selectedStatus);
        }

        $experiences = $query->get();

        if ($request->wantsJson()) {
            return response()->json($experiences);
        }

        $stats = [
            'total'     => WorkExperience::count(),
            'current'   => WorkExperience::where('is_current', true)->count(),
            'published' => WorkExperience::where('status', WorkExperience::STATUS_PUBLISHED)->count(),
            'draft'     => WorkExperience::where('status', WorkExperience::STATUS_DRAFT)->count(),
        ];

        return view('work-experience.index', compact('experiences', 'stats', 'selectedStatus'));
    }

    /**
     * Show the form for creating a new work experience.
     */
    public function create(): View
    {
        $nextOrder = (WorkExperience::max('display_order') ?? 0) + 1;

        return view('work-experience.create', compact('nextOrder'));
    }

    /**
     * Store a newly created work experience in storage.
     */
    public function store(WorkExperienceRequest $request): RedirectResponse|JsonResponse
    {
        $experience = WorkExperience::create($request->validated());

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Work experience created successfully.',
                'data'    => $experience,
            ], 201);
        }

        return redirect()->route('work-experience.index')
            ->with('status', 'Riwayat pengalaman di "' . $experience->company_name . '" berhasil ditambahkan.');
    }

    /**
     * Display the specified work experience.
     */
    public function show(WorkExperience $workExperience, Request $request): View|JsonResponse|RedirectResponse
    {
        if ($request->wantsJson()) {
            return response()->json($workExperience);
        }

        return redirect()->route('work-experience.edit', $workExperience);
    }

    /**
     * Show the form for editing the specified work experience.
     */
    public function edit(WorkExperience $workExperience): View
    {
        return view('work-experience.edit', compact('workExperience'));
    }

    /**
     * Update the specified work experience in storage.
     */
    public function update(WorkExperienceRequest $request, WorkExperience $workExperience): RedirectResponse|JsonResponse
    {
        $workExperience->update($request->validated());

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Work experience updated successfully.',
                'data'    => $workExperience,
            ]);
        }

        return redirect()->route('work-experience.index')
            ->with('status', 'Riwayat pengalaman di "' . $workExperience->company_name . '" berhasil diperbarui.');
    }

    /**
     * Remove the specified work experience from storage.
     */
    public function destroy(WorkExperience $workExperience, Request $request): RedirectResponse|JsonResponse
    {
        $company = $workExperience->company_name;
        $workExperience->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Work experience deleted successfully.',
            ]);
        }

        return redirect()->route('work-experience.index')
            ->with('status', 'Riwayat pengalaman di "' . $company . '" berhasil dihapus.');
    }
}
