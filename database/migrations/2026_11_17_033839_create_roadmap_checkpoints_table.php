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
        Schema::create('roadmap_checkpoints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('roadmap_role_id')->constrained('roadmap_roles')->cascadeOnDelete();
            $table->string('phase_name');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status')->default('in_progress'); // finished, in_progress, not_started
            $table->string('source_reference')->nullable();
            $table->foreignId('learning_log_entry_id')->nullable()->constrained('learning_log_entries')->nullOnDelete();
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roadmap_checkpoints');
    }
};
