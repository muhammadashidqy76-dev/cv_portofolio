<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('journey_entries', function (Blueprint $table) {
            $table->string('credential_type')->default('course')->after('course_name');
            $table->string('certificate_file_path')->nullable()->after('result');
            $table->string('verification_url')->nullable()->after('certificate_file_path');
        });
    }

    public function down(): void
    {
        Schema::table('journey_entries', function (Blueprint $table) {
            $table->dropColumn(['credential_type', 'certificate_file_path', 'verification_url']);
        });
    }
};
