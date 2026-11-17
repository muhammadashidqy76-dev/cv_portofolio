<?php

namespace App\Http\Controllers;

use App\Models\RoadmapRole;
use App\Models\RoadmapCheckpoint;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoadmapController extends Controller
{
    /**
     * Menampilkan halaman Learning Path Tracker & Kurikulum Spesialisasi.
     * Route: GET /roadmap/{role:slug?}
     */
    public function index(?string $roleSlug = null): View
    {
        $allRoles = RoadmapRole::published()
            ->orderBy('display_order')
            ->get();

        if ($allRoles->isEmpty()) {
            abort(404, 'Belum ada kurikulum roadmap yang dipublikasikan.');
        }

        // Tentukan role aktif: cari berdasarkan slug yang diminta, fallback ke 'it-support', atau role pertama
        if ($roleSlug) {
            $currentRole = $allRoles->firstWhere('slug', $roleSlug)
                ?? RoadmapRole::published()->where('slug', $roleSlug)->firstOrFail();
        } else {
            $currentRole = $allRoles->firstWhere('slug', 'it-support') ?? $allRoles->first();
        }

        // Ambil checkpoints terurut beserta relasi Note (artikel blog) dan Project
        $checkpoints = RoadmapCheckpoint::with(['note', 'project'])
            ->where('roadmap_role_id', $currentRole->id)
            ->orderBy('display_order')
            ->get();

        // Kelompokkan checkpoints per modul/fase
        $phases = $checkpoints->groupBy('phase_name');

        // Ringkasan metrik progres penguasaan
        $stats = [
            'total'       => $checkpoints->count(),
            'finished'    => $checkpoints->where('status', RoadmapCheckpoint::STATUS_FINISHED)->count(),
            'in_progress' => $checkpoints->where('status', RoadmapCheckpoint::STATUS_IN_PROGRESS)->count(),
            'not_started' => $checkpoints->where('status', RoadmapCheckpoint::STATUS_NOT_STARTED)->count(),
        ];

        // Persentase progres
        $stats['percentage'] = $stats['total'] > 0
            ? round(($stats['finished'] / $stats['total']) * 100)
            : 0;

        return view('roadmap.index', compact(
            'currentRole',
            'allRoles',
            'phases',
            'checkpoints',
            'stats'
        ));
    }
}
