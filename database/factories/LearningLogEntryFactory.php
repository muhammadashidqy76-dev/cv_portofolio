<?php

namespace Database\Factories;

use App\Models\LearningLogEntry;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LearningLogEntry>
 */
class LearningLogEntryFactory extends Factory
{
    protected $model = LearningLogEntry::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'content' => $this->faker->paragraphs(2, true),
            'tag' => $this->faker->randomElement([
                LearningLogEntry::TAG_EXPLORING,
                LearningLogEntry::TAG_PRODUCTION_READY,
            ]),
            'category' => $this->faker->randomElement([
                LearningLogEntry::CATEGORY_LARAVEL,
                LearningLogEntry::CATEGORY_CLOUD,
            ]),
            'related_project_id' => Project::factory(),
            'published_at' => $this->faker->date(),
            'status' => 'published',
        ];
    }

    public function laravel(): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => LearningLogEntry::CATEGORY_LARAVEL,
        ]);
    }

    public function cloud(): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => LearningLogEntry::CATEGORY_CLOUD,
        ]);
    }

    public function exploring(): static
    {
        return $this->state(fn (array $attributes) => [
            'tag' => LearningLogEntry::TAG_EXPLORING,
        ]);
    }

    public function productionReady(): static
    {
        return $this->state(fn (array $attributes) => [
            'tag' => LearningLogEntry::TAG_PRODUCTION_READY,
        ]);
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'draft',
        ]);
    }
}
