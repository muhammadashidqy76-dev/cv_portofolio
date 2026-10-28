<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class JourneyEntry extends Model
{
    use HasFactory;

    public const TYPE_COURSE = 'course';
    public const TYPE_CERTIFICATION = 'certification';
    public const TYPE_DIPLOMA = 'diploma';

    protected $fillable = [
        'course_name',
        'credential_type',
        'source',
        'learned',
        'applied_project_id',
        'result',
        'certificate_file_path',
        'verification_url',
        'completed_at',
        'display_order',
        'status',
    ];

    protected $casts = [
        'completed_at' => 'date',
        'display_order' => 'integer',
    ];

    protected $appends = [
        'has_narrative',
        'issuer_logo',
        'certificate_url',
    ];

    public function getCertificateUrlAttribute(): ?string
    {
        if (empty($this->certificate_file_path)) {
            return null;
        }

        if (str_starts_with($this->certificate_file_path, 'http://') || str_starts_with($this->certificate_file_path, 'https://')) {
            return $this->certificate_file_path;
        }

        return asset($this->certificate_file_path);
    }

    public function appliedProject(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'applied_project_id');
    }

    public function getHasNarrativeAttribute(): bool
    {
        return !empty(trim($this->learned ?? '')) && !empty(trim($this->result ?? ''));
    }

    public function getIssuerLogoAttribute(): string
    {
        $mapping = [
            'laracasts' => 'laracasts.svg',
            'udemy' => 'udemy.svg',
            'bnsp' => 'bnsp.svg',
            'badan nasional sertifikasi profesi' => 'bnsp.svg',
            'lsp telematika' => 'bnsp.svg',
        ];

        $sourceKey = strtolower(trim($this->source ?? ''));
        $file = 'default.svg';

        if (isset($mapping[$sourceKey])) {
            $file = $mapping[$sourceKey];
        } else {
            foreach ($mapping as $key => $logo) {
                if (str_contains($sourceKey, $key)) {
                    $file = $logo;
                    break;
                }
            }
        }

        return asset('images/issuer-logos/' . $file);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeChronological(Builder $query): Builder
    {
        return $query->orderBy('display_order');
    }

    public function scopeCourses(Builder $query): Builder
    {
        return $query->where('credential_type', self::TYPE_COURSE);
    }

    public function scopeCertifications(Builder $query): Builder
    {
        return $query->where('credential_type', self::TYPE_CERTIFICATION);
    }

    public function scopeDiplomas(Builder $query): Builder
    {
        return $query->where('credential_type', self::TYPE_DIPLOMA);
    }
}