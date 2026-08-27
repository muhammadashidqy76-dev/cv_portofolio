# Changelog

Semua perubahan penting di project ini dicatat di sini. Format mengacu ke
[Keep a Changelog](https://keepachangelog.com/), ringkas dan per-fitur/per-fix —
bukan per-commit (untuk itu lihat `git log`).

## [Unreleased]

### Added
- Migration `add_credential_fields_to_journey_entries_table`: menambahkan kolom `credential_type` (default 'course'), `certificate_file_path` (nullable), dan `verification_url` (nullable) ke tabel `journey_entries`.
- Migration `add_status_to_tech_stack_items_table`: menambahkan kolom `status` (constrained string, default `not_started`, nilai valid: `not_started`/`in_progress`/`finished`) ke tabel `tech_stack_items`.
- Model `TechStackItem`: tambah `status` ke `$fillable`, constants `STATUS_FINISHED/IN_PROGRESS/NOT_STARTED`, accessor `getStatusColorClassAttribute()` (mapping ke Tailwind class emerald/amber/rose-400), dan scopes `scopeFinished()`, `scopeInProgress()`, `scopeNotStarted()`.
- Model `TechStackItem`: tambah accessor `getStatusBadgeClassesAttribute()` — mengembalikan array `['text', 'bg', 'border']` berisi Tailwind class badge pill per status (emerald/amber/rose-400, opacity-10/20 untuk bg dan border).
- `TechStackItemRequest`: tambah validasi `status` (`required`, `in:not_started,in_progress,finished`) — validasi di Form Request, bukan di level database, sesuai konvensi project.

### Changed
- `tech-stack.blade.php`: badge pill kini fully dynamic — background, border, warna icon SVG, dan warna teks label semuanya dari `$item->status_badge_classes` (emerald=finished, amber=in_progress, rose=not_started). Radius, padding, dan spacing badge tidak berubah. Fallback aman ke rose array saat data dari placeholder.
- Factories dan Seeders untuk Project, TechStackItem, JourneyEntry, dan LearningLogEntry serta konfigurasi DatabaseSeeder.
- Resource Controllers, Form Requests, dan Resource Routes untuk CRUD backend (Project, TechStackItem, JourneyEntry, LearningLogEntry).
- Konten spesifik Featured Project #1 ("StockGuard — E-Commerce Checkout Engine") pada ProjectSeeder.
- Dokumentasi Hero Section (Beranda) di bawah Navbar pada `AGENTS.md`.
- Component `hero-section.blade.php` (Section 1 dari portfolio) dengan dark mode default, responsive two-column layout, dan code editor mockup PHP.
- Component `featured-projects.blade.php` (Section 2 dari portfolio) menampilkan 3 card project diurutkan berdasar kompleksitas (Browser mockup untuk Monolith/CMS, JSON API block untuk Headless Backend).
- Component `tech-stack.blade.php` (Section 3 dari portfolio) disesuaikan secara presisi mengikuti mock-up referensi visual dan gaya header Section 2 (badge red-400, font mono badge jumlah teknologi, border navy dark, dan ikon kustom tiap tech pill).
- Rule `.agents/rules/ui-consistency.md` (Always On) mendokumentasikan token-token UI (warna, font, radius, shadow, spacing, dan motif komponen berulang) sebagai standar konsistensi visual.
- Component `journey-section.blade.php` (Section 4 dari portfolio) menampilkan timeline pembelajaran self-directed dengan pola learned → applied → result, visual window mockup, dan fitur collapsible (Alpine.js).
- Component `learning-log-section.blade.php` (Section 5 dari portfolio) menampilkan catatan teknis dengan badge tag Exploring / Production-Ready, visual window mockup, dan fitur collapsible (Alpine.js).
- Component `navbar.blade.php` (Sticky Navigation Bar) dengan backdrop blur responsif saat scroll, anchor links smooth scroll ke seluruh section, window-dot motif logo, dan mobile hamburger menu (Alpine.js).
- Fitur Scrollspy pada `navbar.blade.php` menggunakan Intersection Observer API bawaan (dibungkus Alpine.js) untuk highlight otomatis link yang sedang aktif di viewport (Projects, Tech Stack, Journey, Learning Log) baik pada desktop maupun mobile menu.
- Custom error pages (404, 403, 419, 429, 500, 503) di `resources/views/errors/` dengan layout minimal, motif window-mockup 3-dot, dan pesan manusiawi — tanpa expose detail teknis Laravel ke user.
- Component `footer.blade.php` (Footer penutup) dengan visual boundary penegas akhir halaman, social links sinkron dengan Hero section, copyright dinamis, dan tagline teknologi.

### Fixed
- Memperbaiki rendering gambar preview Card 1 (StockGuard) menggunakan URL placeholder bertema gelap (`placehold.co`).
- Memperbarui konten Card 2 dengan data nyata "OrderSync API — Multi-Channel Order Aggregator" (mengabaikan placeholder bracket TBD).
- Memperbaiki breakpoint responsive Navbar: nav-links horizontal dan tombol GitHub tampil di layar desktop (`md` ke atas), sedangkan tombol hamburger dan mobile dropdown menu hanya aktif di layar kecil (di bawah `md`).
- Memperbaiki konsistensi spacing vertikal Journey & Learning Log (menyelaraskan `mb-12` header, `mt-8` accordion, `gap-6` grid) serta memperbaiki alignment ikon + teks pada summary accordion agar tidak saling overlap (menambahkan `shrink-0` dan explicit flex gap).

### Changed
- Memperbaiki hirarki section header dan proporsi ukuran card pada Featured Projects Section agar lebih ringkas dan tidak terlalu rapat.
- Menambahkan 2 tombol aksi ("Detail" untuk info lengkap & "Live Demo" untuk tautan eksternal) pada footer setiap project card.
- Redesign penuh Featured Projects card: preview `h-28`, problem statement inline tanpa box, skala tipografi proporsional, footer minimalis dengan impact metric & dual button.
- Update `AGENTS.md` dan `.agents/rules/content-cms-rules.md`: penegasan bahwa Hero Section bersifat statis (hardcoded Blade) tanpa memerlukan data model/migration.
- Standarisasi "Spacing & Rhythm System" pada `.agents/rules/ui-consistency.md` dan penerapan polish pass spasi konsisten (section padding, grid gap, card padding, dan prinsip proximity) pada seluruh 5 section komponen.

---

<!--
Template entry (pindahkan ke atas [Unreleased] jadi versi baru saat rilis/milestone):

## [x.y.z] - YYYY-MM-DD
### Added
- Fitur/model/route baru yang ditambahkan

### Changed
- Perubahan behavior dari yang sudah ada

### Fixed
- Bug yang diperbaiki

Setiap entry idealnya 1 baris, jelas, dan kalau relevan sebut nama fitur/model
(mis. "Added JourneyEntry model + migration untuk timeline Journey section").
-->