<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('journey_entries', function (Blueprint $table) {
            // Constrained string untuk jenis kredensial: 'course', 'certification', 'diploma'
            $table->string('credential_type')->default('course')->after('course_name');
            $table->string('certificate_file_path')->nullable()->after('result');
            $table->string('verification_url')->nullable()->after('certificate_file_path');

            // Jadikan kolom narasi nullable untuk mendukung kredensial tanpa pola learned -> applied -> result
            $table->text('learned')->nullable()->change();
            $table->text('result')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('journey_entries', function (Blueprint $table) {
            $table->dropColumn(['credential_type', 'certificate_file_path', 'verification_url']);
            $table->text('learned')->nullable(false)->change();
            $table->text('result')->nullable(false)->change();
        });
    }
};
