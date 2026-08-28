<?php

namespace Tests\Feature;

use App\Models\JourneyEntry;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JourneyEntryTest extends TestCase
{
    use RefreshDatabase;

    public function test_has_narrative_accessor_returns_true_when_learned_and_result_present(): void
    {
        $entry = new JourneyEntry([
            'learned' => 'Belajar indexing query database',
            'result' => 'Query time berkurang hingga 50%',
        ]);

        $this->assertTrue($entry->has_narrative);
    }

    public function test_has_narrative_accessor_returns_false_when_narrative_is_missing_or_empty(): void
    {
        $entry1 = new JourneyEntry([
            'learned' => null,
            'result' => null,
        ]);
        $this->assertFalse($entry1->has_narrative);

        $entry2 = new JourneyEntry([
            'learned' => 'Hanya ada learned',
            'result' => '',
        ]);
        $this->assertFalse($entry2->has_narrative);

        $entry3 = new JourneyEntry([
            'learned' => '   ',
            'result' => 'Ada result tapi learned spasi',
        ]);
        $this->assertFalse($entry3->has_narrative);
    }

    public function test_credential_type_scopes(): void
    {
        JourneyEntry::create([
            'course_name' => 'Course 1',
            'credential_type' => 'course',
            'learned' => 'Learned 1',
            'result' => 'Result 1',
            'status' => 'published',
        ]);

        JourneyEntry::create([
            'course_name' => 'Cert 1',
            'credential_type' => 'certification',
            'learned' => null,
            'result' => null,
            'status' => 'published',
        ]);

        JourneyEntry::create([
            'course_name' => 'Diploma 1',
            'credential_type' => 'diploma',
            'learned' => null,
            'result' => null,
            'status' => 'published',
        ]);

        $this->assertEquals(1, JourneyEntry::courses()->count());
        $this->assertEquals(1, JourneyEntry::certifications()->count());
        $this->assertEquals(1, JourneyEntry::diplomas()->count());
    }

    public function test_can_create_certification_without_narrative(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route('journey.store'), [
            'course_name' => 'Sertifikasi BNSP Junior Web Developer',
            'credential_type' => 'certification',
            'source' => 'BNSP LSP Telematika',
            'learned' => null,
            'result' => null,
            'certificate_file_path' => 'certificates/bnsp-cert.pdf',
            'verification_url' => 'https://bnsp.go.id/verify/12345',
            'completed_at' => '2026-06-01',
            'status' => 'published',
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.credential_type', 'certification')
            ->assertJsonPath('data.has_narrative', false);

        $this->assertDatabaseHas('journey_entries', [
            'course_name' => 'Sertifikasi BNSP Junior Web Developer',
            'credential_type' => 'certification',
            'certificate_file_path' => 'certificates/bnsp-cert.pdf',
        ]);
    }

    public function test_rejects_invalid_credential_type_or_invalid_file_extension(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson(route('journey.store'), [
            'course_name' => 'Invalid Test',
            'credential_type' => 'bootcamp_invalid',
            'certificate_file_path' => 'certificates/cert.exe',
            'status' => 'published',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['credential_type', 'certificate_file_path']);
    }

    public function test_journey_section_renders_both_narrative_and_non_narrative_entries(): void
    {
        JourneyEntry::create([
            'course_name' => 'Laravel Database Transactions & Concurrency Handling',
            'credential_type' => 'course',
            'source' => 'Laracasts',
            'learned' => 'Mempelajari penggunaan DB::transaction()',
            'result' => 'Mencegah terjadinya stok minus',
            'status' => 'published',
        ]);

        JourneyEntry::create([
            'course_name' => 'Sertifikasi BNSP Pemrograman Web',
            'credential_type' => 'certification',
            'source' => 'BNSP LSP Telematika',
            'learned' => null,
            'result' => null,
            'certificate_file_path' => 'certificates/bnsp.pdf',
            'verification_url' => 'https://bnsp.go.id/verify',
            'status' => 'published',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Laravel Database Transactions &amp; Concurrency Handling', false);
        $response->assertSee('Laracasts');
        $response->assertSee('Sertifikasi BNSP Pemrograman Web');
        $response->assertSee('Verifikasi');
        $response->assertSee('Dokumen');
        $response->assertSee('images/issuer-logos/laracasts.svg');
        $response->assertSee('images/issuer-logos/bnsp.svg');
    }

    public function test_issuer_logo_accessor_maps_source_to_svg_logo_with_fallback(): void
    {
        $laracasts = new JourneyEntry(['source' => 'Laracasts']);
        $udemy = new JourneyEntry(['source' => 'Udemy Online']);
        $bnsp = new JourneyEntry(['source' => 'Badan Nasional Sertifikasi Profesi (BNSP)']);
        $unknown = new JourneyEntry(['source' => 'Unknown University']);

        $this->assertStringContainsString('images/issuer-logos/laracasts.svg', $laracasts->issuer_logo);
        $this->assertStringContainsString('images/issuer-logos/udemy.svg', $udemy->issuer_logo);
        $this->assertStringContainsString('images/issuer-logos/bnsp.svg', $bnsp->issuer_logo);
        $this->assertStringContainsString('images/issuer-logos/default.svg', $unknown->issuer_logo);
    }
}
