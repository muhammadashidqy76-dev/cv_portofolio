<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('learning_log_entries', function (Blueprint $table) {
            // 'laravel' atau 'cloud_engineering' — divalidasi di Form Request
            $table->string('category')->default('laravel')->after('tag');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('learning_log_entries', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};
