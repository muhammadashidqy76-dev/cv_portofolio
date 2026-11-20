<?php

namespace Database\Seeders;

use App\Models\TechStackItem;
use Illuminate\Database\Seeder;

class TechStackItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            // Backend
            ['name' => 'Laravel', 'category' => 'Backend', 'display_order' => 1],
            ['name' => 'PHP', 'category' => 'Backend', 'display_order' => 2],
            ['name' => 'RESTful API', 'category' => 'Backend', 'display_order' => 3],
            // Database
            ['name' => 'MySQL', 'category' => 'Database', 'display_order' => 1],
            ['name' => 'Redis', 'category' => 'Database', 'display_order' => 2],
            // Tools
            ['name' => 'Git & GitHub', 'category' => 'Tools', 'display_order' => 1],
            ['name' => 'Composer', 'category' => 'Tools', 'display_order' => 2],
            ['name' => 'Postman', 'category' => 'Tools', 'display_order' => 3],
            ['name' => 'Docker', 'category' => 'Tools', 'display_order' => 4],
            // Networking & Simulation
            ['name' => 'Cisco Packet Tracer', 'category' => 'Networking & Simulation', 'display_order' => 1],
            ['name' => 'GNS3', 'category' => 'Networking & Simulation', 'display_order' => 2],
            ['name' => 'Wireshark', 'category' => 'Networking & Simulation', 'display_order' => 3],
            // Frontend
            ['name' => 'Blade Templating', 'category' => 'Frontend', 'display_order' => 1],
            ['name' => 'Tailwind CSS', 'category' => 'Frontend', 'display_order' => 2],
            ['name' => 'Alpine.js', 'category' => 'Frontend', 'display_order' => 3],
        ];

        foreach ($items as $itemData) {
            TechStackItem::updateOrCreate(
                ['name' => $itemData['name'], 'category' => $itemData['category']],
                $itemData
            );
        }
    }
}
