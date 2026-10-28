<?php

namespace App\Http\Controllers;

use App\Models\JourneyEntry;
use App\Models\LearningLogEntry;
use App\Models\Project;
use App\Models\TechStackItem;
use App\Models\WorkExperience;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the CMS Dashboard overview.
     */
    public function index(): View
    {
        // 1. Featured Projects Stats
        $projectStats = [
            'total' => Project::count(),
            'published' => Project::where('status', 'published')->count(),
            'draft' => Project::where('status', 'draft')->count(),
        ];
        $recentProjects = Project::with('techStackItems')
            ->orderedByComplexity()
            ->take(3)
            ->get();

        // 2. Tech Stack Stats
        $techStats = [
            'total' => TechStackItem::count(),
            'finished' => TechStackItem::where('status', TechStackItem::STATUS_FINISHED)->count(),
            'in_progress' => TechStackItem::where('status', TechStackItem::STATUS_IN_PROGRESS)->count(),
            'not_started' => TechStackItem::where('status', TechStackItem::STATUS_NOT_STARTED)->count(),
        ];

        // 3. Work Experience Stats
        $experienceStats = [
            'total' => WorkExperience::count(),
            'current' => WorkExperience::where('is_current', true)->count(),
            'published' => WorkExperience::where('status', WorkExperience::STATUS_PUBLISHED)->count(),
        ];

        // 4. Journey & Credentials Stats
        $journeyStats = [
            'total' => JourneyEntry::count(),
            'courses' => JourneyEntry::where('credential_type', JourneyEntry::TYPE_COURSE)->count(),
            'certifications' => JourneyEntry::where('credential_type', JourneyEntry::TYPE_CERTIFICATION)->count(),
            'diplomas' => JourneyEntry::where('credential_type', JourneyEntry::TYPE_DIPLOMA)->count(),
        ];

        // 5. Notes / Learning Log Stats
        $noteStats = [
            'total' => LearningLogEntry::count(),
            'published' => LearningLogEntry::where('status', 'published')->count(),
            'draft' => LearningLogEntry::where('status', 'draft')->count(),
            'laravel' => LearningLogEntry::where('category', LearningLogEntry::CATEGORY_LARAVEL)->count(),
            'cloud' => LearningLogEntry::where('category', LearningLogEntry::CATEGORY_CLOUD)->count(),
        ];
        $recentNotes = LearningLogEntry::latest('published_at')
            ->latest('id')
            ->take(4)
            ->get();

        return view('dashboard', compact(
            'projectStats',
            'recentProjects',
            'techStats',
            'experienceStats',
            'journeyStats',
            'noteStats',
            'recentNotes'
        ));
    }
}
