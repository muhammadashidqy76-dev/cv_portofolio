<?php

namespace Database\Seeders;

use App\Models\WorkExperience;
use Illuminate\Database\Seeder;

class WorkExperienceSeeder extends Seeder
{
    /**
     * Seed work_experiences table.
     *
     * ⚠️ PERHATIAN / DISCLAIMER:
     * Ini adalah DATA DUMMY SEMENTARA khusus untuk keperluan preview visual
     * tampilan section Work Experience di halaman portfolio.
     * Data ini HARUS diganti atau dihapus setelah data magang/kerja asli
     * tersedia sebelum di-deploy ke production!
     */
    public function run(): void
    {
        WorkExperience::create([
            'company_name' => 'PT Contoh Teknologi Indonesia',
            'position' => 'Backend Developer Intern',
            'employment_type' => WorkExperience::TYPE_INTERNSHIP,
            'start_date' => '2026-08-01',
            'end_date' => null,
            'is_current' => true,
            'description' => 'Membantu pengembangan fitur backend menggunakan Laravel, termasuk optimasi query database dan implementasi RESTful API untuk kebutuhan internal perusahaan.',
            'location' => 'Remote',
            'display_order' => 1,
            'status' => WorkExperience::STATUS_PUBLISHED,
        ]);
    }
}
