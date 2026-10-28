<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'StockGuard — E-Commerce Checkout Engine',
                'slug' => 'stockguard-ecommerce-checkout-engine',
                'complexity_order' => 1,
                'problem_statement' => 'Mengatasi masalah race condition pada stok produk saat lonjakan checkout simultan (promo/flash sale) yang berpotensi menyebabkan overselling (stok minus) akibat transaksi membaca stok secara bersamaan sebelum pembaruan database.',
                'architecture_decision_summary' => "1. Pessimistic Locking & Database Transactions: Mengombinasikan DB::transaction() dengan lockForUpdate() pada baris stok produk untuk menjamin eksklusivitas pembaruan stok.\n2. Async Job Processing: Memanfaatkan Laravel Queue berbasis Redis untuk mengalihkan proses I/O berat (invoice & email konfirmasi) dari request cycle utama.\n3. Service Layer Pattern: Enkapsulasi logika bisnis checkout terpisah dari Controller untuk reusability dan kemudahan unit testing.",
                'impact_metric' => '300+ checkout simultan tanpa overselling, response time <150ms',
                'preview_image_path' => 'https://placehold.co/800x450/0f0f23/6366f1?text=StockGuard+Dashboard',
                'demo_url' => 'https://stockguard-demo.example.com',
                'status' => 'published',
            ],
            [
                'title' => 'OrderSync API — Multi-Channel Order Aggregator',
                'slug' => 'ordersync-api-multi-channel-order-aggregator',
                'complexity_order' => 2,
                'problem_statement' => 'Menyatukan data pesanan dari beberapa channel penjualan (marketplace, POS, website) ke dalam satu sumber data terpusat tanpa duplikasi atau konflik status order.',
                'architecture_decision_summary' => "1. Laravel API Resource untuk menjaga konsistensi struktur JSON response ke semua consumer.\n2. Sanctum token-based authentication untuk otorisasi akses tiap channel/client.",
                'impact_metric' => 'Menyatukan 3 channel penjualan ke 1 API terpusat, response time rata-rata <200ms',
                'preview_image_path' => null,
                'demo_url' => 'https://ordersync-api-demo.example.com/docs',
                'status' => 'published',
            ],
            [
                'title' => 'Modular Portfolio CMS & Learning Tracker',
                'slug' => 'modular-portfolio-cms',
                'complexity_order' => 3,
                'problem_statement' => 'Merancang sistem CMS khusus portfolio dev yang memungkinkan pembaruan konten dinamis (Projects, Tech Stack, Journey Timeline, dan Learning Log) tanpa hardcode view.',
                'architecture_decision_summary' => 'Menerapkan Laravel Breeze auth scaffolding, relasi Eloquent yang ketat (foreign key constraint & cascade rules), serta scope query khusus untuk publikasi konten.',
                'impact_metric' => 'Memangkas waktu publikasi update portfolio dari 30 menit (manual code edit) menjadi kurang dari 2 menit via dashboard CMS.',
                'preview_image_path' => 'projects/portfolio-cms.jpg',
                'demo_url' => 'https://portfolio-cms-demo.example.com',
                'status' => 'published',
            ],
            [
                'title' => 'PayPulse — Multi-Gateway Payment Webhook Handler',
                'slug' => 'paypulse-payment-webhook-handler',
                'complexity_order' => 4,
                'problem_statement' => 'Mengatasi isu data race condition dan duplicate webhooks dari payment gateway (Midtrans, Xendit, Stripe) dengan verifikasi signature idempotency.',
                'architecture_decision_summary' => "1. Idempotency Key & Redis Lock: Memastikan satu payload webhook hanya dieksekusi tepat satu kali (exactly-once processing).\n2. Retry Mechanism & Dead Letter Queue: Menangani kegagalan transient network saat callback ke sistem internal.",
                'impact_metric' => 'Memproses 10,000+ payload webhook per hari dengan zero duplicate transaction error',
                'preview_image_path' => null,
                'demo_url' => 'https://paypulse-demo.example.com',
                'status' => 'published',
            ],
            [
                'title' => 'CacheForge — High-Throughput Redis Cache Engine',
                'slug' => 'cacheforge-redis-cache-engine',
                'complexity_order' => 5,
                'problem_statement' => 'Mengurangi beban query berat pada database relasional saat traffic spike dengan arsitektur multi-layer caching dan cache invalidation strategy.',
                'architecture_decision_summary' => "1. Cache Tagging & Stamped Lock: Mencegah cache stampede (dog-piling effect) saat key populer expired.\n2. Automatic Warmup Worker: Background worker otomatis melakukan pre-fetch query sebelum jam sibuk.",
                'impact_metric' => 'Menurunkan latensi response database dari 280ms menjadi < 15ms (94% offload)',
                'preview_image_path' => null,
                'demo_url' => 'https://cacheforge-demo.example.com',
                'status' => 'published',
            ],
            [
                'title' => 'EventStream — Event-Driven Microservices Hub',
                'slug' => 'eventstream-microservices-hub',
                'complexity_order' => 6,
                'problem_statement' => 'Sinkronisasi state antar microservice independen tanpa tightly-coupled HTTP synchronous dependency yang rentan cascade failure.',
                'architecture_decision_summary' => "1. Pub/Sub Architecture: Menggunakan Redis Pub/Sub dan Laravel Event Broadcasting untuk komunikasi asinkron.\n2. Circuit Breaker Pattern: Otomatis mendegradasi request saat salah satu service downstream sedang downtime.",
                'impact_metric' => 'Uptime reliability meningkat hingga 99.98% tanpa blocking antar layanan',
                'preview_image_path' => 'projects/eventstream.jpg',
                'demo_url' => 'https://eventstream-demo.example.com',
                'status' => 'published',
            ],
        ];

        foreach ($projects as $projectData) {
            Project::updateOrCreate(
                ['slug' => $projectData['slug']],
                $projectData
            );
        }
    }
}
