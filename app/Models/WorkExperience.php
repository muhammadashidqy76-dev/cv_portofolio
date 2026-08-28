<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use HasFactory;

    public const TYPE_INTERNSHIP = 'internship';
    public const TYPE_FULL_TIME = 'full_time';
    public const TYPE_PART_TIME = 'part_time';
    public const TYPE_FREELANCE = 'freelance';

    public const STATUS_PUBLISHED = 'published';
    public const STATUS_DRAFT = 'draft';

    protected $fillable = [
        'company_name',
        'position',
        'employment_type',
        'start_date',
        'end_date',
        'is_current',
        'description',
        'location',
        'display_order',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
        'display_order' => 'integer',
    ];

    protected $appends = [
        'duration_label',
        'employment_type_badge_classes',
        'employment_type_label',
    ];

    public function getDurationLabelAttribute(): string
    {
        if (empty($this->start_date)) {
            return '';
        }

        $startFormatted = is_string($this->start_date)
            ? Carbon::parse($this->start_date)->format('M Y')
            : $this->start_date->format('M Y');

        if ($this->is_current) {
            return "{$startFormatted} - Present";
        }

        if (!empty($this->end_date)) {
            $endFormatted = is_string($this->end_date)
                ? Carbon::parse($this->end_date)->format('M Y')
                : $this->end_date->format('M Y');

            return "{$startFormatted} - {$endFormatted}";
        }

        return $startFormatted;
    }

    public function getEmploymentTypeLabelAttribute(): string
    {
        return match ($this->employment_type) {
            self::TYPE_FULL_TIME => 'Full-time',
            self::TYPE_PART_TIME => 'Part-time',
            self::TYPE_FREELANCE => 'Freelance',
            default => 'Internship',
        };
    }

    public function getEmploymentTypeBadgeClassesAttribute(): string
    {
        return match ($this->employment_type) {
            self::TYPE_FULL_TIME => 'text-emerald-400 bg-emerald-500/10 border-emerald-500/20',
            self::TYPE_PART_TIME => 'text-amber-400 bg-amber-500/10 border-amber-500/20',
            self::TYPE_FREELANCE => 'text-purple-400 bg-purple-500/10 border-purple-500/20',
            default => 'text-sky-400 bg-sky-500/10 border-sky-500/20',
        };
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    public function scopeCurrent(Builder $query): Builder
    {
        return $query->where('is_current', true);
    }

    public function scopeChronological(Builder $query): Builder
    {
        return $query->orderByDesc('start_date')->orderBy('display_order');
    }
}
