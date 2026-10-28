<?php
/**
 * CSS Extraction & Refactoring Tool — untuk project Laravel Blade
 * -----------------------------------------------------------------
 * Memindai semua *.blade.php, mengekstrak setiap atribut style="...",
 * lalu mengelompokkannya jadi dua kategori:
 *
 *   - GLOBAL / SHARED CSS -> kombinasi declaration yang sama persis
 *     muncul di >= N file berbeda (default N=2) -> resources/css/extracted/global.css
 *   - PAGE-SPECIFIC CSS   -> hanya muncul di satu file
 *     -> resources/css/extracted/pages/{nama-file}.css
 *
 * Cara pakai:
 *   php extract-css.php                    # dry-run: generate CSS, blade TIDAK diubah
 *   php extract-css.php --apply            # generate CSS + tulis ulang blade (style -> class)
 *   php extract-css.php --views=resources/views/admin
 *   php extract-css.php --out=resources/css/extracted
 *   php extract-css.php --min-shared=3     # baru dianggap "shared" kalau muncul di >=3 file
 *
 * PENTING sebelum --apply:
 *   - Pastikan working tree bersih (git status) supaya bisa di-diff / revert.
 *   - style="{{ ... }}", style="@if(...) ... @endif", dll (mengandung syntax
 *     dinamis Blade) SENGAJA DILEWATI karena tidak bisa diekstrak jadi CSS statis.
 *   - Regex tag-matching ini menangani kasus HTML/Blade yang umum, tapi bukan
 *     parser HTML penuh. Untuk tag dengan atribut yang sangat tidak biasa
 *     (mis. ada karakter '>' di dalam value atribut), cek manual hasilnya.
 *   - Selalu review `git diff` setelah --apply sebelum commit.
 */

declare(strict_types=1);

// ---------------------------------------------------------------
// Konfigurasi dari argumen CLI
// ---------------------------------------------------------------
$options   = getopt('', ['apply', 'views:', 'out:', 'min-shared:']);
$viewsPath = rtrim($options['views'] ?? 'resources/views', '/');
$outPath   = rtrim($options['out'] ?? 'resources/css/extracted', '/');
$apply     = isset($options['apply']);
$minShared = (int) ($options['min-shared'] ?? 2);

if (!is_dir($viewsPath)) {
    fwrite(STDERR, "Direktori views tidak ditemukan: $viewsPath\n");
    exit(1);
}

// ---------------------------------------------------------------
// Helper functions
// ---------------------------------------------------------------

function findBladeFiles(string $dir): array
{
    $files = [];
    $rii = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS)
    );
    foreach ($rii as $file) {
        if ($file->isFile() && str_ends_with($file->getFilename(), '.blade.php')) {
            $files[] = $file->getPathname();
        }
    }
    sort($files);
    return $files;
}

/**
 * Ubah isi style="..." jadi array declaration ternormalisasi (sorted by property).
 * Return null kalau mengandung syntax dinamis Blade -> tidak aman diekstrak.
 */
function normalizeDeclarations(string $style): ?array
{
    if (preg_match('/\{\{.*?\}\}|\{!!.*?!!\}|@\w+/', $style)) {
        return null;
    }
    $decls = [];
    foreach (explode(';', $style) as $part) {
        $part = trim($part);
        if ($part === '' || !str_contains($part, ':')) {
            continue;
        }
        [$prop, $value] = array_map('trim', explode(':', $part, 2));
        if ($prop === '' || $value === '') {
            continue;
        }
        $decls[strtolower($prop)] = $value;
    }
    if (empty($decls)) {
        return null;
    }
    ksort($decls);
    return $decls;
}

function declarationsToCss(array $decls): string
{
    $lines = [];
    foreach ($decls as $prop => $value) {
        $lines[] = "  {$prop}: {$value};";
    }
    return implode("\n", $lines);
}

function slug(string $text): string
{
    $text = preg_replace('/\.blade\.php$/', '', $text);
    $text = preg_replace('/[^a-zA-Z0-9]+/', '-', $text);
    return trim(strtolower($text), '-');
}

// ---------------------------------------------------------------
// Step 1: Scan semua file, kumpulkan tiap occurrence inline style
// ---------------------------------------------------------------
$files = findBladeFiles($viewsPath);
if (empty($files)) {
    echo "Tidak ada file .blade.php ditemukan di $viewsPath\n";
    exit(0);
}

// key (hash dari declarations) => ['decls' => [...], 'files' => Set<path>, 'count' => int]
$occurrences = [];
// path => jumlah occurrence style di file itu (untuk laporan)
$fileOccCount = [];
$skippedDynamic = 0;

foreach ($files as $file) {
    $content = file_get_contents($file);
    if (!preg_match_all('/style\s*=\s*(["\'])(.*?)\1/is', $content, $matches, PREG_SET_ORDER)) {
        continue;
    }
    foreach ($matches as $m) {
        $styleValue = $m[2];
        $decls = normalizeDeclarations($styleValue);
        if ($decls === null) {
            $skippedDynamic++;
            continue;
        }
        $key = md5(json_encode($decls));
        if (!isset($occurrences[$key])) {
            $occurrences[$key] = ['decls' => $decls, 'files' => [], 'count' => 0];
        }
        $occurrences[$key]['files'][$file] = true;
        $occurrences[$key]['count']++;
        $fileOccCount[$file] = ($fileOccCount[$file] ?? 0) + 1;
    }
}

// ---------------------------------------------------------------
// Step 2: Klasifikasi shared vs page-specific + generate nama class
// ---------------------------------------------------------------
$sharedClasses = [];  // key => className (gc-1, gc-2, ...)
$pageClasses   = [];  // file => [ key => className ]
$sharedCounter = 1;
$pageCounters  = [];

foreach ($occurrences as $key => $data) {
    if (count($data['files']) >= $minShared) {
        $sharedClasses[$key] = 'gc-' . $sharedCounter++;
    }
}

foreach ($occurrences as $key => $data) {
    if (isset($sharedClasses[$key])) {
        continue;
    }
    foreach (array_keys($data['files']) as $file) {
        if (!isset($pageClasses[$file][$key])) {
            $pageCounters[$file] = ($pageCounters[$file] ?? 0) + 1;
            $pageClasses[$file][$key] = slug(basename($file)) . '-' . $pageCounters[$file];
        }
    }
}

// ---------------------------------------------------------------
// Step 3: Tulis file CSS hasil ekstraksi
// ---------------------------------------------------------------
if (!is_dir($outPath)) {
    mkdir($outPath, 0777, true);
}
if (!is_dir("$outPath/pages")) {
    mkdir("$outPath/pages", 0777, true);
}

$globalCss = "/* Auto-generated: shared CSS, muncul di >= {$minShared} file berbeda */\n\n";
foreach ($sharedClasses as $key => $className) {
    $decls = $occurrences[$key]['decls'];
    $fileCount = count($occurrences[$key]['files']);
    $globalCss .= "/* dipakai di {$fileCount} file */\n";
    $globalCss .= ".{$className} {\n" . declarationsToCss($decls) . "\n}\n\n";
}
file_put_contents("$outPath/global.css", $globalCss);

foreach ($pageClasses as $file => $classes) {
    $pageSlug = slug(basename($file));
    $css = "/* Auto-generated: page-specific CSS untuk {$file} */\n\n";
    foreach ($classes as $key => $className) {
        $decls = $occurrences[$key]['decls'];
        $css .= ".{$className} {\n" . declarationsToCss($decls) . "\n}\n\n";
    }
    file_put_contents("$outPath/pages/{$pageSlug}.css", $css);
}

// ---------------------------------------------------------------
// Step 4 (opsional): Tulis ulang Blade -> ganti style="..." jadi class="..."
// ---------------------------------------------------------------
function rewriteFileContent(string $content, string $file, array $sharedClasses, array $pageClasses): string
{
    // Pattern menangkap satu tag pembuka yang mengandung atribut style.
    // Grup: 1=nama tag, 2=atribut sebelum style, 3=quote, 4=isi style, 5=atribut sesudah style
    $pattern = '/<(\w[\w:\-]*)((?:[^<>]|"[^"]*"|\'[^\']*\')*?)\sstyle\s*=\s*(["\'])(.*?)\3((?:[^<>]|"[^"]*"|\'[^\']*\')*?)>/is';

    return preg_replace_callback($pattern, function (array $m) use ($file, $sharedClasses, $pageClasses) {
        $tag    = $m[1];
        $before = $m[2];
        $styleVal = $m[4];
        $after  = $m[5];

        $decls = normalizeDeclarations($styleVal);
        if ($decls === null) {
            return $m[0]; // style dinamis, biarkan apa adanya
        }
        $key = md5(json_encode($decls));
        $className = $sharedClasses[$key] ?? ($pageClasses[$file][$key] ?? null);
        if (!$className) {
            return $m[0];
        }

        $attrs = $before . $after; // atribut lain tanpa style

        if (preg_match('/\sclass\s*=\s*(["\'])(.*?)\1/is', $attrs, $cm)) {
            $merged = trim($cm[2] . ' ' . $className);
            $attrs = preg_replace(
                '/\sclass\s*=\s*(["\'])(.*?)\1/is',
                ' class="' . $merged . '"',
                $attrs,
                1
            );
        } else {
            $attrs = ' class="' . $className . '"' . $attrs;
        }

        return "<{$tag}{$attrs}>";
    }, $content);
}

$rewrittenFiles = 0;
if ($apply) {
    foreach ($files as $file) {
        if (!isset($fileOccCount[$file])) {
            continue;
        }
        $content = file_get_contents($file);
        $newContent = rewriteFileContent($content, $file, $sharedClasses, $pageClasses);
        if ($newContent !== $content) {
            file_put_contents($file, $newContent);
            $rewrittenFiles++;
        }
    }
}

// ---------------------------------------------------------------
// Laporan akhir
// ---------------------------------------------------------------
echo "=== CSS Extraction Report ===\n";
echo "Views path           : {$viewsPath}\n";
echo "File di-scan         : " . count($files) . "\n";
echo "Total inline style    : " . array_sum($fileOccCount) . "\n";
echo "Dilewati (dinamis)    : {$skippedDynamic}\n";
echo "Shared/global classes : " . count($sharedClasses) . "  -> {$outPath}/global.css\n";
echo "File dgn page-CSS     : " . count($pageClasses) . "  -> {$outPath}/pages/*.css\n";

if ($apply) {
    echo "Blade file ditulis ulang: {$rewrittenFiles}\n";
    echo "\nWAJIB: jalankan `git diff` sekarang dan cek hasilnya sebelum commit.\n";
} else {
    echo "\nMode dry-run — blade file TIDAK diubah.\n";
    echo "Cek dulu isi {$outPath}/global.css dan {$outPath}/pages/*.css,\n";
    echo "kalau sudah oke, jalankan ulang dengan flag --apply.\n";
}