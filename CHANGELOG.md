# Changelog

Semua perubahan penting di project ini dicatat di sini. Format mengacu ke
[Keep a Changelog](https://keepachangelog.com/), ringkas dan per-fitur/per-fix —
bukan per-commit (untuk itu lihat `git log`).

## [Unreleased]

### Added
- Mekanisme collapse/expand di level halaman utama untuk menyembunyikan section Journey & Learning Log secara default, dengan trigger toggle tunggal di antara section Experience dan Footer serta animasi staggered (Journey expand lebih dulu dan Learning Log menyusul; saat collapse Learning Log menutup lebih dulu sebelum Journey).
- Feature tests `WorkExperienceTest.php`: validasi model, accessors (`duration_label`, badge classes), scopes (`published`, `current`, `chronological`), form requests, CRUD API endpoints, dan graceful frontend visibility pada welcome page.
- `WorkExperienceSeeder`: seeder dengan 1 entri data dummy sementara untuk keperluan preview visual section Work Experience (perlu diganti data asli sebelum deploy).
- Component `work-experience-section.blade.php`: section publik untuk pengalaman kerja & magang yang tersembunyi secara graceful jika belum ada entri berstatus published, terintegrasi pada `welcome.blade.php`.
- `WorkExperienceController`: Resource Controller CRUD backend untuk data pengalaman kerja/magang (`index`, `store`, `show`, `update`, `destroy`) dan registrasi route resource `work-experience` di `routes/web.php`.
- Form Requests `StoreWorkExperienceRequest` & `UpdateWorkExperienceRequest`: validasi `employment_type` (`in:internship,full_time,part_time,freelance`), `status` (`in:published,draft`), `start_date`, dan conditional validation untuk `end_date` (required jika `is_current` false).
- Model `WorkExperience`: fillables, casts, constants (`TYPE_INTERNSHIP/FULL_TIME/PART_TIME/FREELANCE`, `STATUS_PUBLISHED/DRAFT`), scopes (`scopePublished`, `scopeCurrent`, `scopeChronological`), dan accessors (`duration_label`, `employment_type_badge_classes`, `employment_type_label`).
- Migration `create_work_experiences_table`: membuat tabel `work_experiences` dengan kolom `company_name`, `position`, `employment_type` (default `internship`), `start_date`, `end_date`, `is_current`, `description`, `location`, `display_order`, dan `status` (default `draft`).
- Asset placeholder SVG logo issuer (`laracasts.svg`, `udemy.svg`, `bnsp.svg`, `default.svg`) di `public/images/issuer-logos/` sebagai aset dummy sementara.
- Model `JourneyEntry`: tambah accessor `getIssuerLogoAttribute()` untuk me-mapping nama `source` ke path asset logo SVG di `public/images/issuer-logos/` dengan fallback ke `default.svg`.
- Favicon `public/images/logo-web.svg` diterapkan ke semua layout (`welcome.blade.php`, `layouts/app.blade.php`, `layouts/guest.blade.php`, `errors/layout.blade.php`) via `<link rel="icon" type="image/svg+xml">`.
- Migration `add_credential_fields_to_journey_entries_table`: menambahkan kolom `credential_type` (default `course`), `certificate_file_path`, dan `verification_url`, serta mengubah kolom narasi `learned` dan `result` menjadi nullable.
- Model `JourneyEntry`: tambah `credential_type`, `certificate_file_path`, dan `verification_url` ke `$fillable`, constants `TYPE_COURSE/CERTIFICATION/DIPLOMA`, accessor `has_narrative`, dan query scopes `scopeCourses()`, `scopeCertifications()`, `scopeDiplomas()`.
- `JourneyEntryRequest`: tambah validasi `credential_type` (`in:course,certification,diploma`), jadikan `learned`, `result`, `applied_project_id` nullable, validasi format gambar/pdf `certificate_file_path`, dan format URL `verification_url`.
- Migration `add_status_to_tech_stack_items_table`: menambahkan kolom `status` (constrained string, default `not_started`, nilai valid: `not_started`/`in_progress`/`finished`) ke tabel `tech_stack_items`.
- Model `TechStackItem`: tambah `status` ke `$fillable`, constants `STATUS_FINISHED/IN_PROGRESS/NOT_STARTED`, accessor `getStatusColorClassAttribute()` (mapping ke Tailwind class emerald/amber/rose-400), dan scopes `scopeFinished()`, `scopeInProgress()`, `scopeNotStarted()`.
- Model `TechStackItem`: tambah accessor `getStatusBadgeClassesAttribute()` — mengembalikan array `['text', 'bg', 'border']` berisi Tailwind class badge pill per status (emerald/amber/rose-400, opacity-10/20 untuk bg dan border).
- `TechStackItemRequest`: tambah validasi `status` (`required`, `in:not_started,in_progress,finished`) — validasi di Form Request, bukan di level database, sesuai konvensi project.

### Fixed
- fix: seragamkan ukuran logo issuer di card Journey (`w-8 h-8`, `shrink-0`, `object-contain`, `rounded-md`) agar konsisten untuk semua tipe card dan resolusi gambar.

### Changed
- `journey-section.blade.php`: menyederhanakan tampilan card untuk semua tipe kredensial (termasuk `course`) menjadi format ringkas 3-kolom grid (`grid-cols-1 md:grid-cols-2 lg:grid-cols-3`) sejajar (badge tipe, judul kredensial, issuer/source, tanggal, tombol dokumen/verifikasi) dan menghapus rendering blok narasi 3-kolom (Learned/Applied/Result) dari UI agar lebih cepat di-scan recruiter (perubahan visual saja, kolom data `learned`, `applied_project_id`, dan `result` tetap tersimpan aman di database).
- `JourneyEntrySeeder.php` & `JourneyEntryFactory.php`: diperbarui untuk menyertakan `credential_type`, `certificate_file_path`, dan `verification_url` serta contoh data riwayat sertifikasi resmi (BNSP).
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