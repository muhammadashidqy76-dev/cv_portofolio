<?php

namespace Database\Seeders;

use App\Models\LearningLogEntry;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LearningLogEntrySeeder extends Seeder
{
    public function run(): void
    {
        $headless = Project::where('slug', 'ordersync-api-multi-channel-order-aggregator')->first();
        $cms = Project::where('slug', 'modular-portfolio-cms')->first();

        $entries = [
            // Track 1: Laravel Ecosystem & Architecture
            [
                'title'      => 'Breeze vs Sanctum: Membedah State Cookie vs Stateless Token',
                'slug'       => 'breeze-vs-sanctum-membedah-state-cookie-vs-stateless-token',
                'content'    => 'Eksperimen membedah arsitektur otentikasi di Laravel. Membandingkan kapan harus memakai session-based cookie dengan Breeze untuk web monolith vs API token stateless dengan Sanctum untuk SPA/Mobile.',
                'body'       => <<<'MD'
Saya mulai penasaran ketika mengerjakan proyek API backend. Dokumentasi Laravel menyebutkan dua paket autentikasi utama — **Breeze** dan **Sanctum** — tapi tidak langsung menjelaskan kapan harus memilih salah satunya.

## Apa Bedanya Secara Fundamental?

Perbedaan intinya ada di bagaimana server "mengingat" siapa yang sedang login.

**Breeze** menggunakan **session cookie**. Setiap kali pengguna login, server membuat sebuah sesi dan menyimpannya (biasanya di database atau file). Browser kemudian menyimpan cookie kecil yang berisi ID sesi tersebut. Di setiap request berikutnya, server mencocokkan cookie itu dengan data sesi yang disimpan.

**Sanctum** menggunakan **API token stateless**. Server membuat token panjang dan memberikannya ke klien. Klien menyimpan token ini sendiri (biasanya di `localStorage` atau memory aplikasi) dan mengirimkannya di header setiap request. Server tidak menyimpan "state" — ia hanya memverifikasi bahwa token valid.

## Kapan Pakai Breeze?

Gunakan Breeze jika aplikasi Anda adalah **monolith tradisional** di mana Blade merender semua halaman. Pengguna mengakses web lewat browser biasa.

Contoh: portofolio ini sendiri adalah web Blade — login admin tidak butuh API token sama sekali.

## Kapan Pakai Sanctum?

Gunakan Sanctum jika Anda membangun **SPA (React/Vue)** atau **aplikasi mobile** yang berkomunikasi dengan backend Laravel lewat API.

Di OrderSync API, saya memilih Sanctum karena klien yang akan mengkonsumsi API adalah aplikasi eksternal. Konfigurasinya di level routing sangat sederhana:

```php
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);
});
```

## Kesimpulan

Pilihan antara Breeze dan Sanctum bukan soal mana yang lebih baik, tapi soal **konteks arsitektur aplikasi Anda**. Breeze untuk web Blade tradisional, Sanctum untuk API yang dikonsumsi klien eksternal.
MD,
                'tag'        => LearningLogEntry::TAG_PRODUCTION_READY,
                'category'   => LearningLogEntry::CATEGORY_LARAVEL,
                'related_project_id' => $headless?->id,
                'published_at' => '2026-06-15',
                'status'     => 'published',
            ],
            [
                'title'      => 'Penerapan Form Requests & API Resources untuk Clean Controller',
                'slug'       => 'penerapan-form-requests-api-resources-untuk-clean-controller',
                'content'    => 'Catatan mengenai pemisahan tanggung jawab (Separation of Concerns). Memindahkan validasi rumit ke Form Requests dan formatting payload JSON ke API Resources agar controller tetap ramping.',
                'body'       => <<<'MD'
Salah satu hal yang langsung saya sadari ketika belajar Laravel lebih dalam adalah betapa mudahnya controller menjadi gemuk (*fat controller*) jika tidak disiplin dari awal.

## Masalah yang Saya Temui

Di proyek pertama, satu method controller bisa berisi 40–50 baris: validasi input, query database, format response JSON, hingga penanganan error — semuanya campur aduk. Ini membuat kode sulit dibaca dan sangat sulit di-test.

## Solusi Pertama: Form Request

Laravel memiliki kelas `FormRequest` yang dirancang khusus untuk memisahkan logika validasi dari controller. Caranya:

```php
php artisan make:request StoreOrderRequest
```

Lalu isi aturan validasinya di sana:

```php
public function rules(): array
{
    return [
        'customer_id'  => ['required', 'exists:customers,id'],
        'items'        => ['required', 'array', 'min:1'],
        'items.*.sku'  => ['required', 'string'],
        'items.*.qty'  => ['required', 'integer', 'min:1'],
    ];
}
```

Controller jadi tinggal menerima data yang sudah tervalidasi:

```php
public function store(StoreOrderRequest $request): JsonResponse
{
    $order = Order::create($request->validated());
    // ...
}
```

## Solusi Kedua: API Resource

Untuk formatting output JSON, saya pakai `JsonResource`. Ini memastikan struktur response API selalu konsisten, tidak peduli perubahan apapun di model.

```php
php artisan make:resource OrderResource
```

Hasilnya controller menjadi sangat ramping dan setiap bagian punya tanggung jawabnya sendiri.

## Takeaway

Separation of Concerns bukan hanya konsep abstrak — di Laravel, ia sudah disediakan alat konkretnya: `FormRequest` untuk input, `Resource` untuk output. Manfaatkan keduanya sejak awal.
MD,
                'tag'        => LearningLogEntry::TAG_PRODUCTION_READY,
                'category'   => LearningLogEntry::CATEGORY_LARAVEL,
                'related_project_id' => $cms?->id,
                'published_at' => '2026-08-25',
                'status'     => 'published',
            ],
            // Track 2: Cloud Engineering & Infrastructure
            [
                'title'      => 'Eksplorasi Redis Caching untuk API Rate Limiting & Session Store',
                'slug'       => 'eksplorasi-redis-caching-untuk-api-rate-limiting-session-store',
                'content'    => 'Catatan pengujian latensi pemindahan driver session dan rate throttling dari MySQL ke Redis in-memory server lokal. Latensi throttling terpangkas dari 15ms menjadi kurang dari 2ms.',
                'body'       => <<<'MD'
Ketika OrderSync API mulai menerima beban simulasi yang lebih tinggi, saya mulai memperhatikan bahwa operasi rate limiting terasa lambat. Setiap kali middleware throttle dijalankan, ada query ke database untuk memeriksa dan memperbarui hit count.

## Akar Masalahnya

Laravel throttle middleware secara default menggunakan cache driver yang dikonfigurasi di `.env`. Jika `CACHE_STORE=database`, setiap pengecekan rate limit berarti satu operasi baca-tulis ke MySQL. Untuk endpoint yang dipanggil ratusan kali per menit, ini menjadi bottleneck nyata.

## Mengapa Redis?

Redis adalah **in-memory data store** — ia menyimpan data di RAM, bukan di disk. Operasi baca-tulis Redis berkisar di **sub-millisecond**, jauh lebih cepat dari query MySQL yang harus melalui disk I/O.

## Cara Implementasinya

Pertama, install driver:

```bash
composer require predis/predis
```

Kemudian ubah konfigurasi di `.env`:

```
CACHE_STORE=redis
SESSION_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379
```

Tidak ada perubahan kode sama sekali di controller atau middleware. Laravel menangani semuanya secara transparan.

## Hasil Pengujian

Setelah perpindahan driver, saya ukur kembali latensi middleware throttle:

| Driver | Latensi rata-rata |
|--------|-------------------|
| MySQL  | ~15ms             |
| Redis  | < 2ms             |

Penurunan latensi hampir **90%** hanya dengan mengubah satu baris konfigurasi.

## Catatan Penting

Redis menyimpan data di memory — artinya data hilang jika server restart. Ini oke untuk cache dan session, tapi **jangan simpan data permanen di Redis tanpa backup**.
MD,
                'tag'        => LearningLogEntry::TAG_PRODUCTION_READY,
                'category'   => LearningLogEntry::CATEGORY_CLOUD,
                'related_project_id' => $headless?->id,
                'published_at' => '2026-06-01',
                'status'     => 'published',
            ],
            [
                'title'      => 'Containerization PHP 8.3 & Nginx dengan Docker Multi-Stage Build',
                'slug'       => 'containerization-php-83-nginx-dengan-docker-multi-stage-build',
                'content'    => 'Bedah optimasi ukuran Docker image untuk Laravel. Memisahkan tahapan composer install dengan production image berbasis Alpine Linux, memangkas ukuran dari 800MB menjadi 135MB siap rilis.',
                'body'       => <<<'MD'
Salah satu eksperimen yang paling menarik selama mengerjakan proyek Portfolio CMS adalah mencoba mengemas aplikasi Laravel ke dalam Docker container yang siap production.

## Masalah Awal: Image yang Terlalu Besar

Dockerfile pertama yang saya tulis sangat naif — cukup salin semua file dan jalankan. Hasilnya, ukuran image mencapai **800MB lebih**. Ini jelas tidak ideal untuk deployment.

Penyebab utamanya: semua dependensi development (termasuk tools Composer, PHPUnit, dan cache instalasi) ikut terbawa ke dalam image production.

## Solusi: Multi-Stage Build

Docker mendukung konsep **multi-stage build** — kita bisa memisahkan proses build menjadi beberapa "tahap" dan hanya mengambil hasil akhir yang diperlukan.

```dockerfile
# ── TAHAP 1: Composer (hanya untuk install dependencies) ──
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

# ── TAHAP 2: Production Image ──
FROM php:8.3-fpm-alpine AS production

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

# Salin HANYA vendor yang sudah diinstall dari tahap sebelumnya
COPY --from=vendor /app/vendor ./vendor
COPY . .

RUN php artisan config:cache && php artisan route:cache
```

## Hasilnya

| Pendekatan     | Ukuran Image |
|----------------|--------------|
| Single-stage   | ~820MB       |
| Multi-stage    | ~135MB       |

Penghematan ukuran hampir **84%**, yang berarti waktu push ke registry dan pull di server production jauh lebih singkat.

## Yang Saya Pelajari

Multi-stage build adalah praktik standar di industry untuk containerization. Kuncinya: pisahkan "alat untuk membangun" dari "hasil yang dijalankan". Hanya bawa yang benar-benar dibutuhkan saat runtime.
MD,
                'tag'        => LearningLogEntry::TAG_EXPLORING,
                'category'   => LearningLogEntry::CATEGORY_CLOUD,
                'related_project_id' => $cms?->id,
                'published_at' => '2026-09-02',
                'status'     => 'published',
            ],
        ];

        foreach ($entries as $entryData) {
            LearningLogEntry::updateOrCreate(
                ['slug' => $entryData['slug']],
                $entryData
            );
        }
    }
}
