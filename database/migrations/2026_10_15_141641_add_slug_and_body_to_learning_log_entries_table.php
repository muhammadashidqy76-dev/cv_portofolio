<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('learning_log_entries', function (Blueprint $table) {
            // slug unik untuk URL publik /notes/{slug}
            $table->string('slug')->unique()->nullable()->after('title');
            // body menyimpan konten artikel penuh dalam format Markdown
            // content tetap sebagai ringkasan/excerpt yang tampil di card beranda
            $table->longText('body')->nullable()->after('content');
        });
    }

    public function down(): void
    {
        Schema::table('learning_log_entries', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn(['slug', 'body']);
        });
    }
};
