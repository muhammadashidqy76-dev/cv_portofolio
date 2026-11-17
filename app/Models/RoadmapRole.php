<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class RoadmapRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'tagline',
        'status',
        'display_order',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function checkpoints(): HasMany
    {
        return $this->hasMany(RoadmapCheckpoint::class)->orderBy('display_order');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }
}

