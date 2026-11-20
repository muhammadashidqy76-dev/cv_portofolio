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
            $table->json('external_resources')->nullable()->after('external_url_title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roadmap_checkpoints', function (Blueprint $table) {
            $table->dropColumn('external_resources');
        });
    }
};
