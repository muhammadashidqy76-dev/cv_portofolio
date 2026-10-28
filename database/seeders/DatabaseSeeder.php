<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\TechStackItem;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Admin User, Featured Projects & Tech Stack Items
        $this->call([
            AdminUserSeeder::class,
            ProjectSeeder::class,
            TechStackItemSeeder::class,
        ]);

        // 2. Attach Tech Stack Items to Featured Projects (Pivot Table)
        $this->attachTechStackItemsToProjects();

        // 3. Seed Work Experience, Journey Entries & Learning Log Entries (FK to Projects)
        $this->call([
            WorkExperienceSeeder::class,
            JourneyEntrySeeder::class,
            LearningLogEntrySeeder::class,
        ]);
    }

    private function attachTechStackItemsToProjects(): void
    {
        $laravel = TechStackItem::where('name', 'Laravel')->first();
        $php = TechStackItem::where('name', 'PHP')->first();
        $restApi = TechStackItem::where('name', 'RESTful API')->first();
        $mysql = TechStackItem::where('name', 'MySQL')->first();
        $redis = TechStackItem::where('name', 'Redis')->first();
        $git = TechStackItem::where('name', 'Git & GitHub')->first();
        $blade = TechStackItem::where('name', 'Blade Templating')->first();
        $tailwind = TechStackItem::where('name', 'Tailwind CSS')->first();

        // Project 1: StockGuard — E-Commerce Checkout Engine
        $p1 = Project::where('slug', 'stockguard-ecommerce-checkout-engine')->first();
        if ($p1) {
            $p1->techStackItems()->syncWithoutDetaching(
                array_filter([$laravel?->id, $php?->id, $mysql?->id, $blade?->id, $tailwind?->id])
            );
        }

        // Project 2: OrderSync API — Multi-Channel Order Aggregator
        $p2 = Project::where('slug', 'ordersync-api-multi-channel-order-aggregator')->first();
        if ($p2) {
            $p2->techStackItems()->syncWithoutDetaching(
                array_filter([$laravel?->id, $php?->id, $restApi?->id, $mysql?->id, $redis?->id])
            );
        }

        // Project 3: Modular Portfolio CMS
        $p3 = Project::where('slug', 'modular-portfolio-cms')->first();
        if ($p3) {
            $p3->techStackItems()->syncWithoutDetaching(
                array_filter([$laravel?->id, $php?->id, $mysql?->id, $blade?->id, $tailwind?->id, $git?->id])
            );
        }

        // Project 4: PayPulse — Multi-Gateway Payment Webhook Handler
        $p4 = Project::where('slug', 'paypulse-payment-webhook-handler')->first();
        if ($p4) {
            $p4->techStackItems()->syncWithoutDetaching(
                array_filter([$laravel?->id, $php?->id, $restApi?->id, $mysql?->id, $redis?->id])
            );
        }

        // Project 5: CacheForge — High-Throughput Redis Cache Engine
        $p5 = Project::where('slug', 'cacheforge-redis-cache-engine')->first();
        if ($p5) {
            $p5->techStackItems()->syncWithoutDetaching(
                array_filter([$laravel?->id, $php?->id, $redis?->id, $mysql?->id])
            );
        }

        // Project 6: EventStream — Event-Driven Microservices Hub
        $p6 = Project::where('slug', 'eventstream-microservices-hub')->first();
        if ($p6) {
            $p6->techStackItems()->syncWithoutDetaching(
                array_filter([$laravel?->id, $php?->id, $restApi?->id, $redis?->id, $git?->id])
            );
        }
    }
}
