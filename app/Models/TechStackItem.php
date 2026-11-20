<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

class TechStackItem extends Model
{
    use HasFactory;

    public const STATUS_FINISHED     = 'finished';
    public const STATUS_IN_PROGRESS  = 'in_progress';
    public const STATUS_NOT_STARTED  = 'not_started';

    protected $fillable = [
        'name',
        'category',
        'display_order',
        'status',
    ];

    protected $casts = [
        'display_order' => 'integer',
    ];

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_tech_stack_item');
    }

    /**
     * Accessor slug untuk tautan URL roadmap / filter.
     */
    public function getSlugAttribute(): string
    {
        return \Illuminate\Support\Str::slug($this->name);
    }

    /**
     * Mapping status ke Tailwind text-color class untuk warna icon SVG di komponen.
     * 'finished'    -> 'text-emerald-400'
     * 'in_progress' -> 'text-amber-400'
     * 'not_started' -> 'text-rose-400'
     */
    public function getStatusColorClassAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_FINISHED    => 'text-emerald-400',
            self::STATUS_IN_PROGRESS => 'text-amber-400',
            self::STATUS_NOT_STARTED => 'text-rose-400',
            default                  => 'text-rose-400',
        };
    }

    /**
     * Mapping status ke kombinasi class Tailwind untuk badge pill (text + bg + border).
     * Mengembalikan array asosiatif dengan key 'text', 'bg', 'border' supaya
     * tiap bagian badge bisa mendapat class yang tepat secara terpisah di Blade.
     *
     * 'finished'    -> emerald: text-emerald-400, bg-emerald-400/10, border-emerald-400/20
     * 'in_progress' -> amber:   text-amber-400,   bg-amber-400/10,   border-amber-400/20
     * 'not_started' -> rose:    text-rose-400,     bg-rose-400/10,    border-rose-400/20
     * default/null  -> rose (fallback aman)
     */
    public function getStatusBadgeClassesAttribute(): array
    {
        return match ($this->status) {
            self::STATUS_FINISHED    => [
                'text'   => 'text-emerald-400',
                'bg'     => 'bg-emerald-400/10',
                'border' => 'border-emerald-400/20',
            ],
            self::STATUS_IN_PROGRESS => [
                'text'   => 'text-amber-400',
                'bg'     => 'bg-amber-400/10',
                'border' => 'border-amber-400/20',
            ],
            default => [
                'text'   => 'text-rose-400',
                'bg'     => 'bg-rose-400/10',
                'border' => 'border-rose-400/20',
            ],
        };
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
}