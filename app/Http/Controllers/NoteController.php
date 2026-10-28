<?php

namespace App\Http\Controllers;

use App\Models\LearningLogEntry;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NoteController extends Controller
{
    /**
     * Show the public index / archive page for all Learning Log entries.
     * Route: GET /notes
     */
    public function index(Request $request): View
    {
        $category = $request->query('category');
        $search = $request->query('q');

        $query = LearningLogEntry::published()
            ->with('relatedProject')
            ->latest('published_at');

        if ($category && in_array($category, ['laravel', 'cloud_engineering'])) {
            $query->where('category', $category);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $notes = $query->paginate(9)->withQueryString();

        $laravelCount = LearningLogEntry::published()->where('category', 'laravel')->count();
        $cloudCount = LearningLogEntry::published()->where('category', 'cloud_engineering')->count();
        $totalCount = $laravelCount + $cloudCount;

        return view('notes.index', compact('notes', 'category', 'search', 'laravelCount', 'cloudCount', 'totalCount'));
    }

    /**
     * Show the public detail page for a single Learning Log entry.
     * Route: GET /notes/{entry:slug}
     */
    public function show(LearningLogEntry $entry): View
    {
        // Only published entries are accessible publicly
        abort_if($entry->status !== 'published', 404);

        // Adjacent entries for prev/next navigation (same category, published)
        $prevEntry = LearningLogEntry::published()
            ->where('category', $entry->category)
            ->where('published_at', '<', $entry->published_at)
            ->orderBy('published_at', 'desc')
            ->first(['id', 'title', 'slug', 'category']);

        $nextEntry = LearningLogEntry::published()
            ->where('category', $entry->category)
            ->where('published_at', '>', $entry->published_at)
            ->orderBy('published_at', 'asc')
            ->first(['id', 'title', 'slug', 'category']);

        return view('notes.show', compact('entry', 'prevEntry', 'nextEntry'));
    }
}
