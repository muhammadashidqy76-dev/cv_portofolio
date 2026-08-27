<?php

namespace Tests\Feature;

use App\Http\Requests\JourneyEntryRequest;
use App\Models\JourneyEntry;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class JourneyEntryTest extends TestCase
{
    use RefreshDatabase;

    private function validate(array $data): \Illuminate\Validation\Validator
    {
        $request = JourneyEntryRequest::create('/journey', 'POST', $data);
        $request->setContainer(app());
        return Validator::make($data, $request->rules());
    }

    public function test_valid_course_entry_passes_validation(): void
    {
        $validator = $this->validate([
            'course_name' => 'Laravel Concurrency',
            'credential_type' => 'course',
            'source' => 'Laracasts',
            'learned' => 'Learned race conditions',
            'result' => 'Fixed checkout bug',
            'status' => 'published',
        ]);

        $this->assertFalse($validator->fails());
    }

    public function test_course_entry_requires_learned_and_result(): void
    {
        $validator = $this->validate([
            'course_name' => 'Laravel Concurrency',
            'credential_type' => 'course',
            'source' => 'Laracasts',
            'status' => 'published',
        ]);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('learned', $validator->errors()->toArray());
        $this->assertArrayHasKey('result', $validator->errors()->toArray());
    }

    public function test_certification_entry_requires_certificate_file_path_and_allows_null_learned_result(): void
    {
        $validator = $this->validate([
            'course_name' => 'BNSP Backend Developer',
            'credential_type' => 'certification',
            'source' => 'BNSP Indonesia',
            'certificate_file_path' => 'certificates/bnsp_backend.pdf',
            'verification_url' => 'https://bnsp.go.id/verify/123',
            'status' => 'published',
        ]);

        $this->assertFalse($validator->fails());
    }

    public function test_certification_entry_fails_when_certificate_file_path_is_missing(): void
    {
        $validator = $this->validate([
            'course_name' => 'BNSP Backend Developer',
            'credential_type' => 'certification',
            'status' => 'published',
        ]);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('certificate_file_path', $validator->errors()->toArray());
    }

    public function test_diploma_entry_requires_certificate_file_path(): void
    {
        $validatorPass = $this->validate([
            'course_name' => 'Sarjana Komputer',
            'credential_type' => 'diploma',
            'source' => 'Universitas Indonesia',
            'certificate_file_path' => 'diplomas/ijazah.pdf',
            'status' => 'published',
        ]);
        $this->assertFalse($validatorPass->fails());

        $validatorFail = $this->validate([
            'course_name' => 'Sarjana Komputer',
            'credential_type' => 'diploma',
            'status' => 'published',
        ]);
        $this->assertTrue($validatorFail->fails());
        $this->assertArrayHasKey('certificate_file_path', $validatorFail->errors()->toArray());
    }

    public function test_invalid_credential_type_fails_validation(): void
    {
        $validator = $this->validate([
            'course_name' => 'Some credential',
            'credential_type' => 'bootcamp_invalid',
            'status' => 'published',
        ]);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('credential_type', $validator->errors()->toArray());
    }

    public function test_journey_entry_query_scopes(): void
    {
        JourneyEntry::factory()->create([
            'course_name' => 'Course 1',
            'credential_type' => JourneyEntry::TYPE_COURSE,
        ]);
        JourneyEntry::factory()->create([
            'course_name' => 'Cert 1',
            'credential_type' => JourneyEntry::TYPE_CERTIFICATION,
            'certificate_file_path' => 'certs/cert1.pdf',
        ]);
        JourneyEntry::factory()->create([
            'course_name' => 'Diploma 1',
            'credential_type' => JourneyEntry::TYPE_DIPLOMA,
            'certificate_file_path' => 'diplomas/dip1.pdf',
        ]);

        $this->assertCount(1, JourneyEntry::courses()->get());
        $this->assertCount(1, JourneyEntry::certifications()->get());
        $this->assertCount(1, JourneyEntry::diplomas()->get());
    }

    public function test_authenticated_user_can_create_course_entry_via_endpoint(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/journey', [
            'course_name' => 'Advanced Eloquent Performance',
            'credential_type' => 'course',
            'source' => 'Laracasts',
            'learned' => 'Eager loading, select constraints, and subquery selects.',
            'result' => 'Reduced N+1 queries across major repository methods.',
            'status' => 'published',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('journey_entries', [
            'course_name' => 'Advanced Eloquent Performance',
            'credential_type' => 'course',
        ]);
    }

    public function test_authenticated_user_can_create_certification_entry_via_endpoint(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/journey', [
            'course_name' => 'BNSP Pemrogram Madya',
            'credential_type' => 'certification',
            'source' => 'Badan Nasional Sertifikasi Profesi',
            'certificate_file_path' => 'certificates/bnsp_madya.pdf',
            'verification_url' => 'https://bnsp.go.id/sertifikat/9999',
            'status' => 'published',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('journey_entries', [
            'course_name' => 'BNSP Pemrogram Madya',
            'credential_type' => 'certification',
            'certificate_file_path' => 'certificates/bnsp_madya.pdf',
        ]);
    }

    public function test_journey_section_renders_all_credential_types_correctly(): void
    {
        JourneyEntry::factory()->create([
            'course_name' => 'Laravel Concurrency Mastery',
            'credential_type' => 'course',
            'source' => 'Laracasts',
            'learned' => 'Database locking mechanisms',
            'result' => 'Zero race conditions',
            'status' => 'published',
        ]);

        JourneyEntry::factory()->create([
            'course_name' => 'BNSP Backend Developer Certificate',
            'credential_type' => 'certification',
            'source' => 'BNSP Indonesia',
            'certificate_file_path' => 'certs/bnsp.pdf',
            'verification_url' => 'https://bnsp.go.id/cert/1234',
            'status' => 'published',
        ]);

        JourneyEntry::factory()->create([
            'course_name' => 'Sarjana Terapan Komputer',
            'credential_type' => 'diploma',
            'source' => 'Politeknik Negeri',
            'certificate_file_path' => 'diplomas/ijazah.pdf',
            'verification_url' => 'https://pddikti.kemdikbud.go.id/1234',
            'status' => 'published',
        ]);

        $view = $this->blade('<x-journey-section />');

        $view->assertSee('Laravel Concurrency Mastery');
        $view->assertSee('BNSP Backend Developer Certificate');
        $view->assertSee('Sarjana Terapan Komputer');
        $view->assertSee('Certification');
        $view->assertSee('Diploma');
        $view->assertSee('Course');
        $view->assertSee('Verifikasi Kredensial');
        $view->assertSee('Lihat Dokumen');
    }
}
