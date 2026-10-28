<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\TechStackItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeaturedProjectsTest extends TestCase
{
    use RefreshDatabase;

    public function test_featured_projects_section_renders_published_projects_from_database(): void
    {
        $tech = TechStackItem::create([
            'name' => 'Laravel',
            'category' => 'Backend',
            'display_order' => 1,
            'status' => 'finished',
        ]);

        $project = Project::create([
            'title' => 'StockGuard — E-Commerce Checkout Engine',
            'slug' => 'stockguard-checkout',
            'complexity_order' => 1,
            'problem_statement' => 'Mengatasi masalah race condition pada stok checkout flash sale.',
            'architecture_decision_summary' => "1. Pessimistic Locking dengan lockForUpdate().\n2. Async Job Processing.",
            'impact_metric' => '300+ checkout simultan tanpa overselling',
            'preview_image_path' => 'projects/stockguard.png',
            'status' => 'published',
        ]);

        $project->techStackItems()->attach($tech->id);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('StockGuard');
        $response->assertSee('E-Commerce Checkout Engine');
        $response->assertSee('Mengatasi masalah race condition pada stok checkout flash sale.');
        $response->assertSee('Pessimistic Locking dengan lockForUpdate().');
        $response->assertSee('300+ checkout simultan tanpa overselling');
        $response->assertSee('Laravel');
        $response->assertSee('#01');
    }

    public function test_featured_projects_does_not_render_draft_projects(): void
    {
        Project::create([
            'title' => 'Secret Project — Draft Only',
            'slug' => 'secret-project',
            'complexity_order' => 1,
            'problem_statement' => 'Hidden draft problem.',
            'status' => 'draft',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertDontSee('Secret Project');
        $response->assertDontSee('Hidden draft problem.');
    }

    public function test_featured_projects_renders_api_mockup_for_order_2(): void
    {
        Project::create([
            'title' => 'OrderSync API — Multi-Channel Order Aggregator',
            'slug' => 'ordersync-api',
            'complexity_order' => 2,
            'problem_statement' => 'Menyatukan data pesanan dari multi channel.',
            'architecture_decision_summary' => '1. RESTful API Resources.',
            'impact_metric' => 'Response time rata-rata <200ms',
            'preview_image_path' => null,
            'status' => 'published',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('OrderSync API');
        $response->assertSee('GET /api/v1/orders');
        $response->assertSee('#02');
    }
}
