<?php

namespace Database\Seeders;

use App\Models\JourneyEntry;
use App\Models\Project;
use Illuminate\Database\Seeder;

class JourneyEntrySeeder extends Seeder
{
    public function run(): void
    {
        $ecommerce = Project::where('slug', 'stockguard-ecommerce-checkout-engine')->first();
        $headless = Project::where('slug', 'ordersync-api-multi-channel-order-aggregator')->first();
        $cms = Project::where('slug', 'modular-portfolio-cms')->first();

        $entries = [
            [
                'course_name' => 'Laravel Database Transactions & Concurrency Handling',
                'credential_type' => 'course',
                'source' => 'Laracasts',
                'learned' => 'Mempelajari penggunaan DB::transaction(), pessimistic locking (lockForUpdate), dan mitigasi race condition pada query database.',
                'applied_project_id' => $ecommerce?->id,
                'result' => 'Mencegah terjadinya stok minus / overselling pada saat checkout produk e-commerce berkategori high demand.',
                'certificate_file_path' => null,
                'verification_url' => null,
                'completed_at' => '2026-02-15',
                'display_order' => 1,
                'status' => 'published',
            ],
            [
                'course_name' => 'Mastering RESTful API Architecture & Sanctum Authentication',
                'credential_type' => 'course',
                'source' => 'Udemy',
                'learned' => 'Mempelajari standar desain RESTful API, Eloquent API Resources, JWT/Sanctum bearer token authentication, dan rate-limiting middleware.',
                'applied_project_id' => $headless?->id,
                'result' => 'Membangun API headless backend modular dengan struktur respon JSON standar (data, meta, error handling) dan proteksi endpoint terautentikasi.',
                'certificate_file_path' => null,
                'verification_url' => null,
                'completed_at' => '2026-05-10',
                'display_order' => 2,
                'status' => 'published',
            ],
            [
                'course_name' => 'Sertifikasi BNSP Pemrograman Web (Junior Web Developer)',
                'credential_type' => 'certification',
                'source' => 'Badan Nasional Sertifikasi Profesi (BNSP)',
                'learned' => null,
                'applied_project_id' => null,
                'result' => null,
                'certificate_file_path' => 'certificates/sertifikat-bnsp-web.pdf',
                'verification_url' => 'https://bnsp.go.id',
                'completed_at' => '2026-06-12',
                'display_order' => 3,
                'status' => 'published',
            ],
            [
                'course_name' => 'Laravel Breeze Scaffolding & Dynamic CMS Data Architecture',
                'credential_type' => 'course',
                'source' => 'Official Laravel Documentation',
                'learned' => 'Mempelajari otentikasi Breeze, pengelolaan relasi Eloquent komplek, scope query (scopePublished), serta penanganan data-driven content.',
                'applied_project_id' => $cms?->id,
                'result' => 'Mengubah situs portfolio statis menjadi CMS berbasis database yang fleksibel untuk manajemen konten jangka panjang.',
                'certificate_file_path' => null,
                'verification_url' => null,
                'completed_at' => '2026-08-20',
                'display_order' => 4,
                'status' => 'published',
            ],
        ];

        foreach ($entries as $entryData) {
            JourneyEntry::create($entryData);
        }
    }
}
