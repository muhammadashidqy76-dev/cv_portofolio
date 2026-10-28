<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_id',
        'title_en',
        'slug',
        'complexity_order',
        'problem_statement_id',
        'problem_statement_en',
        'architecture_details_id',
        'architecture_details_en',
        'impact_metric',
        'preview_image_path',
        'demo_url',
        'status',
    ];

    protected $casts = [
        'complexity_order' => 'integer',
    ];

    /**
     * Helper internal untuk mengambil nilai kolom sesuai locale aktif (ID/EN)
     * dengan mekanisme fallback otomatis jika nilai bernilai null atau kosong.
     */
    protected function getLocalizedValue(string $field): ?string
    {
        $locale = app()->getLocale() ?: 'id';
        $currentColumn = "{$field}_{$locale}";
        $fallbackColumn = ($locale === 'en') ? "{$field}_id" : "{$field}_en";

        if (!empty($this->attributes[$currentColumn])) {
            return $this->attributes[$currentColumn];
        }

        if (!empty($this->attributes[$fallbackColumn])) {
            return $this->attributes[$fallbackColumn];
        }

        return $this->attributes["{$field}_id"] ?? null;
    }

    /**
     * Accessor & Mutator dinamis untuk 'title'
     */
    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getLocalizedValue('title'),
            set: fn ($value) => is_array($value) ? $value : [
                'title_id' => $value,
                'title_en' => $this->attributes['title_en'] ?? $value,
            ]
        );
    }

    /**
     * Accessor & Mutator dinamis untuk 'problem_statement'
     */
    protected function problemStatement(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getLocalizedValue('problem_statement'),
            set: fn ($value) => is_array($value) ? $value : [
                'problem_statement_id' => $value,
                'problem_statement_en' => $this->attributes['problem_statement_en'] ?? $value,
            ]
        );
    }

    /**
     * Accessor dinamis untuk 'architecture_details'
     */
    protected function architectureDetails(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getLocalizedValue('architecture_details')
        );
    }

    /**
     * Alias accessor & mutator untuk backward-compatibility dengan architecture_decision_summary
     */
    protected function architectureDecisionSummary(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getLocalizedValue('architecture_details'),
            set: fn ($value) => is_array($value) ? $value : [
                'architecture_details_id' => $value,
                'architecture_details_en' => $this->attributes['architecture_details_en'] ?? $value,
            ]
        );
    }

    /**
     * Accessor URL thumbnail preview proyek
     */
    public function getPreviewImageUrlAttribute(): ?string
    {
        if (empty($this->preview_image_path)) {
            return null;
        }

        if (\Illuminate\Support\Str::startsWith($this->preview_image_path, ['http://', 'https://'])) {
            return $this->preview_image_path;
        }

        if (file_exists(public_path($this->preview_image_path))) {
            return asset($this->preview_image_path);
        }

        return asset('storage/' . ltrim($this->preview_image_path, '/'));
    }

    public function techStackItems(): BelongsToMany
    {
        return $this->belongsToMany(TechStackItem::class, 'project_tech_stack_item');
    }

    public function journeyEntries(): HasMany
    {
        return $this->hasMany(JourneyEntry::class, 'applied_project_id');
    }

    public function learningLogEntries(): HasMany
    {
        return $this->hasMany(LearningLogEntry::class, 'related_project_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeOrderedByComplexity(Builder $query): Builder
    {
        return $query->orderBy('complexity_order');
    }
}