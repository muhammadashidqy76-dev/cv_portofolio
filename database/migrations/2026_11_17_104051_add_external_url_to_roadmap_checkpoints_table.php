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
        Schema::table('roadmap_checkpoints', function (Blueprint $table) {
            $table->string('external_url')->nullable()->after('source_reference');
            $table->string('external_url_title')->nullable()->after('external_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roadmap_checkpoints', function (Blueprint $table) {
            $table->dropColumn(['external_url', 'external_url_title']);
        });
    }
};
