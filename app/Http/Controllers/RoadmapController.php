<?php

namespace App\Http\Controllers;

use App\Models\TechStackItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RoadmapController extends Controller
{
    /**
     * Display the developer skill and technology roadmap page.
     * Route: GET /roadmap
     */
    public function index(Request $request): View
    {
        $tech = $request->query('tech');
        $selectedCategory = $request->query('category', 'all');
        $selectedStatus = $request->query('status', 'all');

        $query = TechStackItem::with('projects')
            ->orderBy('category')
            ->orderBy('display_order');

        if ($selectedCategory && $selectedCategory !== 'all') {
            $query->where('category', $selectedCategory);
        }

        if ($selectedStatus && in_array($selectedStatus, [
            TechStackItem::STATUS_FINISHED,
            TechStackItem::STATUS_IN_PROGRESS,
            TechStackItem::STATUS_NOT_STARTED,
        ])) {
            $query->where('status', $selectedStatus);
        }

        $items = $query->get();
        $itemsGrouped = $items->groupBy('category');

        $categories = TechStackItem::select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category')
            ->toArray();

        $stats = [
            'total'       => TechStackItem::count(),
            'finished'    => TechStackItem::where('status', TechStackItem::STATUS_FINISHED)->count(),
            'in_progress' => TechStackItem::where('status', TechStackItem::STATUS_IN_PROGRESS)->count(),
            'not_started' => TechStackItem::where('status', TechStackItem::STATUS_NOT_STARTED)->count(),
        ];

        $curriculum = $this->getRoadmapCurriculum();

        return view('roadmap.index', compact(
            'items',
            'itemsGrouped',
            'categories',
            'stats',
            'tech',
            'selectedCategory',
            'selectedStatus',
            'curriculum'
        ));
    }

    /**
     * Standar kurikulum roadmap teknis untuk tiap teknologi backend & pendukung.
     */
    private function getRoadmapCurriculum(): array
    {
        return [
            'PHP' => [
                'phase' => '01 // Core Language & Runtime',
                'level' => 'Fundamental to Advanced',
                'description' => 'Bahasa pemrograman utama backend web dinamis dan fondasi runtime ekosistem modern Laravel.',
                'documentation' => 'https://www.php.net/docs.php',
                'checkpoints' => [
                    ['title' => 'Sintaks Modern PHP 8.x', 'desc' => 'Strict Types, Named Arguments, Match Expressions, Nullsafe Operator, & Constructor Property Promotion.'],
                    ['title' => 'Object-Oriented Programming (OOP)', 'desc' => 'Classes, Inheritance, Encapsulation, Abstract Classes, Interfaces, dan Traits.'],
                    ['title' => 'Design Patterns & SOLID', 'desc' => 'Penerapan Single Responsibility, Dependency Inversion, Repository & Factory Pattern.'],
                    ['title' => 'Database Persistence via PDO', 'desc' => 'Koneksi database aman dengan Prepared Statements untuk mencegah SQL Injection.'],
                    ['title' => 'Autoloading & PSR Standards', 'desc' => 'Struktur PSR-4 Autoloading, PSR-12 Coding Standard, dan manajemen paket.'],
                    ['title' => 'Unit & Feature Testing', 'desc' => 'Pengujian otomatis berbasis PHPUnit & Pest untuk verifikasi logika bisnis.'],
                ],
            ],
            'Laravel' => [
                'phase' => '02 // Framework & Application Architecture',
                'level' => 'Enterprise Architecture',
                'description' => 'Framework PHP berstandar industri dengan arsitektur MVC elegan, ekosistem kaya, dan developer experience tinggi.',
                'documentation' => 'https://laravel.com/docs',
                'checkpoints' => [
                    ['title' => 'Request Lifecycle & Middleware', 'desc' => 'Alur permintaan HTTP dari index.php, HTTP Kernel, Routing, Middleware pipeline, hingga Controller.'],
                    ['title' => 'Service Container & IoC', 'desc' => 'Dependency Injection otomatis, Service Providers, Binding interface ke implementasi konkret.'],
                    ['title' => 'Eloquent ORM & Query Scopes', 'desc' => 'Relasi relasional (1:1, 1:N, N:N), Eager Loading untuk mencegah N+1 problem, dan reusable scopes.'],
                    ['title' => 'Database Transactions & Locking', 'desc' => 'Atomic operations via DB::transaction(), Pessimistic Locking (lockForUpdate) untuk integritas data tinggi.'],
                    ['title' => 'Asynchronous Queue & Jobs', 'desc' => 'Pemrosesan background task via Redis Queue driver, retry logic, timeout, dan penanganan failed jobs.'],
                    ['title' => 'Events, Listeners & Observers', 'desc' => 'Decoupled event-driven system untuk audit log, notifikasi, dan pemisahan side-effects.'],
                ],
            ],
            'RESTful API' => [
                'phase' => '03 // API Engineering & Integration',
                'level' => 'Stateless Backend Service',
                'description' => 'Perancangan arsitektur antarmuka komunikasi data stateless antar-sistem client-server berstandar REST.',
                'documentation' => 'https://restfulapi.net/',
                'checkpoints' => [
                    ['title' => 'HTTP Verbs & Semantic Status Codes', 'desc' => 'Pemanfaatan GET, POST, PUT, PATCH, DELETE serta kode status 200, 201, 400, 401, 403, 404, 422, 500.'],
                    ['title' => 'API Resources Transformation', 'desc' => 'Layer isolasi transformasi response JSON tanpa mengekspos struktur tabel database mentah.'],
                    ['title' => 'Token Authentication & Sanctum', 'desc' => 'Autentikasi API berbasis Bearer Token dengan Laravel Sanctum, scope token, dan revocation.'],
                    ['title' => 'Rate Limiting & Throttle', 'desc' => 'Proteksi endpoint dari brute-force dan DDoS menggunakan Redis-backed rate limiters.'],
                    ['title' => 'Comprehensive Error Handling', 'desc' => 'Format error JSON terstandar untuk validasi 422, unauthenticated 401, dan model not found 404.'],
                ],
            ],
            'MySQL' => [
                'phase' => '04 // Relational Data Store',
                'level' => 'Data Modeling & Query Optimization',
                'description' => 'Sistem manajemen basis data relasional (RDBMS) standar untuk penyimpanan data transaksional terstruktur.',
                'documentation' => 'https://dev.mysql.com/doc/',
                'checkpoints' => [
                    ['title' => 'Schema Design & Normalization', 'desc' => 'Perancangan skema normalisasi (1NF sampai 3NF) dengan foreign key constraints and cascade rules.'],
                    ['title' => 'Indexing Strategies', 'desc' => 'B-Tree indexes, Composite indexes pada foreign key, dan analisis eksekusi via EXPLAIN query.'],
                    ['title' => 'ACID Compliance & Isolation', 'desc' => 'Prinsip Atomicity, Consistency, Isolation, dan Durability dalam skenario multi-user concurrency.'],
                    ['title' => 'Migrations & Seeding', 'desc' => 'Versioning skema basis data Laravel dan pembuatan dummy data realistis via Model Factories.'],
                ],
            ],
            'Redis' => [
                'phase' => '05 // High-Throughput In-Memory Layer',
                'level' => 'Caching & Queue Broker',
                'description' => 'In-memory data structure store berkecepatan tinggi untuk caching layer, session storage, dan broker antrean.',
                'documentation' => 'https://redis.io/docs/',
                'checkpoints' => [
                    ['title' => 'Data Structures', 'desc' => 'Penguasaan Strings, Hashes, Lists, Sets, dan Sorted Sets untuk kebutuhan caching terdistribusi.'],
                    ['title' => 'Cache-Aside Pattern & TTL', 'desc' => 'Strategi query cache: cek Redis -> fallback DB -> tulis ke Redis dengan Time-To-Live terukur.'],
                    ['title' => 'Cache Tagging', 'desc' => 'Pembersihan cache selektif per tag tanpa menghapus seluruh key cache aplikasi.'],
                    ['title' => 'Redis Queue Driver', 'desc' => 'Eksekusi ratusan job asinkron per detik dengan latensi submilisetik via Redis worker.'],
                ],
            ],
            'Git & GitHub' => [
                'phase' => '06 // Version Control & Collaboration',
                'level' => 'Engineering Workflow',
                'description' => 'Sistem kontrol versi terdistribusi dan platform kolaborasi kode sumber standar industri.',
                'documentation' => 'https://git-scm.com/doc',
                'checkpoints' => [
                    ['title' => 'Branching Strategy', 'desc' => 'GitHub Flow, isolasi fitur via feature-branch, dan pencegahan commit langsung ke branch utama.'],
                    ['title' => 'Semantic Commits', 'desc' => 'Standar pesan commit berbasis Conventional Commits (feat, fix, docs, refactor, test, chore).'],
                    ['title' => 'Rebase & Conflict Resolution', 'desc' => 'Menjaga riwayat commit tetap linear dan bersih serta penyelesaian konflik merge secara aman.'],
                ],
            ],
            'Composer' => [
                'phase' => '07 // Package & Dependency Management',
                'level' => 'Tooling & Autoloading',
                'description' => 'Dependency manager standar de-facto untuk ekosistem bahasa pemrograman PHP.',
                'documentation' => 'https://getcomposer.org/doc/',
                'checkpoints' => [
                    ['title' => 'Dependency Constraints', 'desc' => 'Pemahaman semantic versioning (^, ~, wildcard) dan penguncian dependensi via composer.lock.'],
                    ['title' => 'Autoload Optimization', 'desc' => 'Peningkatan performa produksi dengan perintah composer dump-autoload -o.'],
                    ['title' => 'Custom Scripts & Hooks', 'desc' => 'Automasi skrip post-install, linting, dan pre-commit check melalui composer scripts.'],
                ],
            ],
            'Postman' => [
                'phase' => '08 // API Testing & Documentation',
                'level' => 'Quality Assurance',
                'description' => 'Tool kolaborasi untuk pengujian, otomasi pengujian, dan dokumentasi antarmuka API.',
                'documentation' => 'https://learning.postman.com/',
                'checkpoints' => [
                    ['title' => 'Hierarki Collections & Folders', 'desc' => 'Pengorganisasian endpoint API berdasarkan modul fungsional sistem.'],
                    ['title' => 'Environment Variables', 'desc' => 'Pengelolaan variabel dinamis (Base URL, Bearer Auth Token, User ID) lintas environment.'],
                    ['title' => 'Automated Test Assertions', 'desc' => 'Pengujian otomatis status HTTP, schema JSON, dan waktu respon menggunakan script Postman.'],
                ],
            ],
            'Docker' => [
                'phase' => '09 // Containerization & DevOps',
                'level' => 'Infrastructure Reproducibility',
                'description' => 'Platform kontainerisasi untuk lingkungan pengembangan dan deployment yang konsisten tanpa ketergantungan OS lokal.',
                'documentation' => 'https://docs.docker.com/',
                'checkpoints' => [
                    ['title' => 'Docker Engine & CLI', 'desc' => 'Manajemen images, containers, persistent volumes, dan internal networking.'],
                    ['title' => 'Multi-Stage Dockerfile', 'desc' => 'Pembuatan Dockerfile efisien untuk runtime PHP 8.x + FPM dengan footprint minimal.'],
                    ['title' => 'Docker Compose LEMP Stack', 'desc' => 'Orkestrasi multi-container: Nginx, PHP-FPM, MySQL, dan Redis dalam 1 file manifest.'],
                ],
            ],
            'Blade Templating' => [
                'phase' => '10 // Frontend Integration Layer',
                'level' => 'Server-Side Rendering',
                'description' => 'Mesin templating bawaan Laravel yang ekspresif, ringan, dan cepat untuk rendering antarmuka pengguna.',
                'documentation' => 'https://laravel.com/docs/blade',
                'checkpoints' => [
                    ['title' => 'Component-Driven Architecture', 'desc' => 'Pembangunan komponen reusable dengan props, attributes, dan slots (anonymous & class-based).'],
                    ['title' => 'Layout Inheritance', 'desc' => 'Struktur layout konsisten dengan master templates, header slots, dan modular subviews.'],
                    ['title' => 'Directives & Data Binding', 'desc' => 'Pengendalian alur kondisional, loop collection, dan sanitasi output XSS secara otomatis.'],
                ],
            ],
            'Tailwind CSS' => [
                'phase' => '11 // Utility-First UI Styling',
                'level' => 'Design System Implementation',
                'description' => 'Utility-first CSS framework untuk pembangunan antarmuka visual modern secara cepat dan konsisten.',
                'documentation' => 'https://tailwindcss.com/docs',
                'checkpoints' => [
                    ['title' => 'Modern Layouts (Flex & Grid)', 'desc' => 'Penyusunan tata letak responsif, sticky headers, dan micro-grids tanpa stylesheet custom.'],
                    ['title' => 'Dark Carbon Design System', 'desc' => 'Pengaturan palet tema gelap kustom berbasis variabel warna arsitektural.'],
                    ['title' => 'Responsive Breakpoints', 'desc' => 'Penyelarasan tampilan seamless lintas perangkat seluler, tablet, hingga desktop lebar.'],
                ],
            ],
            'Alpine.js' => [
                'phase' => '12 // Declarative Client Interactivity',
                'level' => 'Reactive Micro-Interactions',
                'description' => 'Framework JavaScript ringan untuk menambahkan reaktivitas dan interaksi langsung di markup Blade.',
                'documentation' => 'https://alpinejs.dev/',
                'checkpoints' => [
                    ['title' => 'State Management Lokal', 'desc' => 'Pengelolaan state reaktif langsung di komponen Blade via x-data dan x-model.'],
                    ['title' => 'Event Handling & Modals', 'desc' => 'Pengendalian modal popup, dropdown menus, dan dismiss via Escape atau klik di luar.'],
                    ['title' => 'Transitions & Animation', 'desc' => 'Animasi transisi halus menggunakan x-transition untuk pengalaman UI yang polished.'],
                ],
            ],
        ];
    }
}

