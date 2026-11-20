<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class RoadmapCheckpoint extends Model
{
    use HasFactory;

    public const STATUS_FINISHED = 'finished';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_NOT_STARTED = 'not_started';

    protected $fillable = [
        'roadmap_role_id',
        'phase_name',
        'title',
        'description',
        'status',
        'source_reference',
        'external_url',
        'external_url_title',
        'external_resources',
        'learning_log_entry_id',
        'project_id',
        'display_order',
    ];

    protected $casts = [
        'external_resources' => 'array',
    ];

    /**
     * Pastikan external_resources selalu mengembalikan array list sumber referensi.
     * Mendukung fallback dari legacy external_url jika kolom external_resources kosong.
     */
    public function getExternalResourcesAttribute($value): array
    {
        if (!empty($value)) {
            $decoded = is_string($value) ? json_decode($value, true) : $value;
            if (is_array($decoded) && count($decoded) > 0) {
                return $decoded;
            }
        }

        if (!empty($this->attributes['external_url'])) {
            return [
                [
                    'title' => $this->attributes['external_url_title'] ?: 'Bahan Bacaan & Referensi',
                    'url'   => $this->attributes['external_url'],
                ]
            ];
        }

        return [];
    }

    /**
     * Helper untuk pre-populate form edit (minimal 1 baris).
     */
    public function getExternalResourcesListAttribute(): array
    {
        $resources = $this->external_resources;
        if (empty($resources)) {
            return [['title' => '', 'url' => '']];
        }
        return $resources;
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(RoadmapRole::class, 'roadmap_role_id');
    }

    public function note(): BelongsTo
    {
        return $this->belongsTo(LearningLogEntry::class, 'learning_log_entry_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function scopeFinished(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_FINISHED);
    }

    public function scopeInProgress(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_IN_PROGRESS);
    }

    public function scopeNotStarted(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_NOT_STARTED);
    }

    /**
     * Styling badge status untuk rendering view.
     */
    public function getStatusBadgeClassesAttribute(): array
    {
        return match ($this->status) {
            self::STATUS_FINISHED => [
                'bg'     => 'bg-emerald-400/10',
                'border' => 'border-emerald-400/20',
                'text'   => 'text-emerald-400',
                'dot'    => 'bg-emerald-400',
                'label'  => 'Finished &bull; Selesai Dikuasai',
            ],
            self::STATUS_IN_PROGRESS => [
                'bg'     => 'bg-amber-400/10',
                'border' => 'border-amber-400/20',
                'text'   => 'text-amber-400',
                'dot'    => 'bg-amber-400',
                'label'  => 'In Progress &bull; Sedang Berjalan',
            ],
            default => [
                'bg'     => 'bg-rose-400/10',
                'border' => 'border-rose-400/20',
                'text'   => 'text-rose-400',
                'dot'    => 'bg-rose-400',
                'label'  => 'Planned &bull; Rencana Belajar',
            ],
        };
    }
}

