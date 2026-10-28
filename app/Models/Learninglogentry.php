<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class LearningLogEntry extends Model
{
    use HasFactory;

    public const TAG_EXPLORING = 'exploring';
    public const TAG_PRODUCTION_READY = 'production_ready';

    public const CATEGORY_LARAVEL = 'laravel';
    public const CATEGORY_CLOUD = 'cloud_engineering';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'body',
        'tag',
        'category',
        'related_project_id',
        'published_at',
        'status',
    ];

    protected $casts = [
        'published_at' => 'date',
    ];

    /**
     * Auto-generate slug from title when creating if not provided.
     */
    protected static function booted(): void
    {
        static::creating(function (LearningLogEntry $entry) {
            if (empty($entry->slug)) {
                $entry->slug = Str::slug($entry->title);
            }
        });
    }

    /**
     * Route model binding by slug instead of id.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function relatedProject(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'related_project_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeExploring(Builder $query): Builder
    {
        return $query->where('tag', self::TAG_EXPLORING);
    }

    public function scopeProductionReady(Builder $query): Builder
    {
        return $query->where('tag', self::TAG_PRODUCTION_READY);
    }

    public function scopeLaravel(Builder $query): Builder
    {
        return $query->where('category', self::CATEGORY_LARAVEL);
    }

    public function scopeCloud(Builder $query): Builder
    {
        return $query->where('category', self::CATEGORY_CLOUD);
    }

    public function scopeCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    /**
     * Reading time calculated from body (full content) if available, else from excerpt.
     */
    public function getReadingTimeAttribute(): string
    {
        $text = !empty($this->body) ? $this->body : $this->content;
        $words = str_word_count(strip_tags((string) $text));
        $minutes = max(1, (int) ceil($words / 180));
        return "{$minutes} min read";
    }

    /**
     * Returns parsed HTML from the body Markdown field.
     * Falls back to content excerpt if body is empty.
     */
    public function getBodyHtmlAttribute(): string
    {
        $source = !empty($this->body) ? $this->body : $this->content;
        return \Illuminate\Support\Str::markdown((string) $source, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);
    }
}