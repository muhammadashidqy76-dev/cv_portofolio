<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\WorkExperience;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreWorkExperienceRequest;
use Tests\TestCase;

class WorkExperienceTest extends TestCase
{
    use RefreshDatabase;

    public function test_work_experience_model_creation_and_duration_label_accessor(): void
    {
        $currentExp = WorkExperience::create([
            'company_name' => 'PT Contoh Teknologi Indonesia',
            'position' => 'Backend Developer Intern',
            'employment_type' => WorkExperience::TYPE_INTERNSHIP,
            'start_date' => '2026-08-01',
            'end_date' => null,
            'is_current' => true,
            'description' => 'Membantu optimasi query database.',
            'location' => 'Remote',
            'display_order' => 1,
            'status' => WorkExperience::STATUS_PUBLISHED,
        ]);

        $this->assertEquals('Aug 2026 - Present', $currentExp->duration_label);
        $this->assertEquals('Internship', $currentExp->employment_type_label);
        $this->assertStringContainsString('text-sky-400', $currentExp->employment_type_badge_classes);

        $pastExp = WorkExperience::create([
            'company_name' => 'Tech Corp',
            'position' => 'Junior Backend Developer',
            'employment_type' => WorkExperience::TYPE_FULL_TIME,
            'start_date' => '2025-01-01',
            'end_date' => '2025-12-31',
            'is_current' => false,
            'description' => 'Full-time backend engineer.',
            'location' => 'Jakarta',
            'display_order' => 2,
            'status' => WorkExperience::STATUS_PUBLISHED,
        ]);

        $this->assertEquals('Jan 2025 - Dec 2025', $pastExp->duration_label);
        $this->assertEquals('Full-time', $pastExp->employment_type_label);
        $this->assertStringContainsString('text-emerald-400', $pastExp->employment_type_badge_classes);
    }

    public function test_work_experience_scopes(): void
    {
        WorkExperience::create([
            'company_name' => 'Draft Company',
            'position' => 'Intern',
            'employment_type' => 'internship',
            'start_date' => '2026-01-01',
            'end_date' => '2026-03-01',
            'is_current' => false,
            'status' => 'draft',
        ]);

        WorkExperience::create([
            'company_name' => 'Active Company',
            'position' => 'Developer',
            'employment_type' => 'full_time',
            'start_date' => '2026-04-01',
            'end_date' => null,
            'is_current' => true,
            'status' => 'published',
        ]);

        $this->assertCount(1, WorkExperience::published()->get());
        $this->assertCount(1, WorkExperience::current()->get());
    }

    public function test_store_work_experience_request_validation(): void
    {
        $rules = (new StoreWorkExperienceRequest())->rules();

        // Valid data with is_current = true
        $validDataCurrent = [
            'company_name' => 'PT Valid',
            'position' => 'Backend Engineer',
            'employment_type' => 'full_time',
            'start_date' => '2026-01-01',
            'is_current' => true,
            'status' => 'published',
        ];
        $validator1 = Validator::make($validDataCurrent, $rules);
        $this->assertTrue($validator1->passes());

        // Invalid: missing end_date when is_current is false
        $invalidMissingEndDate = [
            'company_name' => 'PT Valid',
            'position' => 'Backend Engineer',
            'employment_type' => 'full_time',
            'start_date' => '2026-01-01',
            'is_current' => false,
            'status' => 'published',
        ];
        $validator2 = Validator::make($invalidMissingEndDate, $rules);
        $this->assertTrue($validator2->fails());
        $this->assertArrayHasKey('end_date', $validator2->errors()->toArray());

        // Invalid employment_type
        $invalidType = [
            'company_name' => 'PT Valid',
            'position' => 'Backend Engineer',
            'employment_type' => 'invalid_type',
            'start_date' => '2026-01-01',
            'is_current' => true,
            'status' => 'published',
        ];
        $validator3 = Validator::make($invalidType, $rules);
        $this->assertTrue($validator3->fails());
        $this->assertArrayHasKey('employment_type', $validator3->errors()->toArray());
    }

    public function test_work_experience_api_crud_endpoints(): void
    {
        $user = User::factory()->create();

        // 1. Store
        $payload = [
            'company_name' => 'PT Api Test',
            'position' => 'API Developer',
            'employment_type' => 'freelance',
            'start_date' => '2026-02-01',
            'is_current' => true,
            'description' => 'Building microservices.',
            'location' => 'Bandung',
            'display_order' => 1,
            'status' => 'published',
        ];

        $response = $this->actingAs($user)->postJson(route('work-experience.store'), $payload);
        $response->assertStatus(201);
        $this->assertDatabaseHas('work_experiences', ['company_name' => 'PT Api Test']);

        $id = $response->json('data.id');

        // 2. Index
        $indexResponse = $this->actingAs($user)->getJson(route('work-experience.index'));
        $indexResponse->assertStatus(200);
        $indexResponse->assertJsonFragment(['company_name' => 'PT Api Test']);

        // 3. Show
        $showResponse = $this->actingAs($user)->getJson(route('work-experience.show', $id));
        $showResponse->assertStatus(200);
        $showResponse->assertJsonFragment(['company_name' => 'PT Api Test']);

        // 4. Update
        $updateResponse = $this->actingAs($user)->putJson(route('work-experience.update', $id), [
            'position' => 'Senior API Developer',
        ]);
        $updateResponse->assertStatus(200);
        $this->assertDatabaseHas('work_experiences', ['id' => $id, 'position' => 'Senior API Developer']);

        // 5. Destroy
        $destroyResponse = $this->actingAs($user)->deleteJson(route('work-experience.destroy', $id));
        $destroyResponse->assertStatus(200);
        $this->assertDatabaseMissing('work_experiences', ['id' => $id]);
    }

    public function test_work_experience_section_blade_graceful_visibility(): void
    {
        // 1. When no published work experience exists -> Section is not rendered
        $responseEmpty = $this->get('/');
        $responseEmpty->assertStatus(200);
        $responseEmpty->assertDontSee('Pengalaman Kerja &amp; Magang', false);

        // 2. When published entry exists -> Section is rendered
        WorkExperience::create([
            'company_name' => 'PT Tampil Di Publik',
            'position' => 'Backend Developer Intern',
            'employment_type' => 'internship',
            'start_date' => '2026-08-01',
            'is_current' => true,
            'description' => 'Membantu pengembangan fitur backend Laravel.',
            'location' => 'Remote',
            'display_order' => 1,
            'status' => 'published',
        ]);

        $responseVisible = $this->get('/');
        $responseVisible->assertStatus(200);
        $responseVisible->assertSee('Pengalaman Kerja &amp; Magang', false);
        $responseVisible->assertSee('PT Tampil Di Publik');
        $responseVisible->assertSee('Backend Developer Intern');
        $responseVisible->assertSee('Aug 2026 - Present');
    }
}
