<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkExperienceRequest;
use App\Http\Requests\UpdateWorkExperienceRequest;
use App\Models\WorkExperience;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorkExperienceController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $experiences = WorkExperience::chronological()->get();

        return response()->json($experiences);
    }

    public function store(StoreWorkExperienceRequest $request): JsonResponse
    {
        $experience = WorkExperience::create($request->validated());

        return response()->json([
            'message' => 'Work experience created successfully.',
            'data' => $experience,
        ], 201);
    }

    public function show(WorkExperience $workExperience): JsonResponse
    {
        return response()->json($workExperience);
    }

    public function update(UpdateWorkExperienceRequest $request, WorkExperience $workExperience): JsonResponse
    {
        $workExperience->update($request->validated());

        return response()->json([
            'message' => 'Work experience updated successfully.',
            'data' => $workExperience,
        ]);
    }

    public function destroy(WorkExperience $workExperience): JsonResponse
    {
        $workExperience->delete();

        return response()->json([
            'message' => 'Work experience deleted successfully.',
        ]);
    }
}
