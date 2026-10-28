<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tambahkan kolom multi-bahasa baru (Column-Based)
        Schema::table('projects', function (Blueprint $table) {
            $table->string('title_id')->nullable()->after('id');
            $table->string('title_en')->nullable()->after('title_id');
            $table->text('problem_statement_id')->nullable()->after('complexity_order');
            $table->text('problem_statement_en')->nullable()->after('problem_statement_id');
            $table->text('architecture_details_id')->nullable()->after('problem_statement_en');
            $table->text('architecture_details_en')->nullable()->after('architecture_details_id');
        });

        // 2. Salin data yang sudah ada agar tidak hilang (Data Preservation)
        if (Schema::hasColumn('projects', 'title')) {
            DB::table('projects')->update([
                'title_id' => DB::raw('title'),
                'title_en' => DB::raw('title'),
            ]);
        }

        if (Schema::hasColumn('projects', 'problem_statement')) {
            DB::table('projects')->update([
                'problem_statement_id' => DB::raw('problem_statement'),
                'problem_statement_en' => DB::raw('problem_statement'),
            ]);
        }

        if (Schema::hasColumn('projects', 'architecture_details')) {
            DB::table('projects')->update([
                'architecture_details_id' => DB::raw('architecture_details'),
                'architecture_details_en' => DB::raw('architecture_details'),
            ]);
        } elseif (Schema::hasColumn('projects', 'architecture_decision_summary')) {
            DB::table('projects')->update([
                'architecture_details_id' => DB::raw('architecture_decision_summary'),
                'architecture_details_en' => DB::raw('architecture_decision_summary'),
            ]);
        }

        // 3. Hapus kolom lama
        Schema::table('projects', function (Blueprint $table) {
            $columnsToDrop = [];

            if (Schema::hasColumn('projects', 'title')) {
                $columnsToDrop[] = 'title';
            }
            if (Schema::hasColumn('projects', 'problem_statement')) {
                $columnsToDrop[] = 'problem_statement';
            }
            if (Schema::hasColumn('projects', 'architecture_details')) {
                $columnsToDrop[] = 'architecture_details';
            }
            if (Schema::hasColumn('projects', 'architecture_decision_summary')) {
                $columnsToDrop[] = 'architecture_decision_summary';
            }

            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Buat kembali kolom struktur awal
        Schema::table('projects', function (Blueprint $table) {
            $table->string('title')->nullable()->after('id');
            $table->text('problem_statement')->nullable()->after('complexity_order');
            $table->text('architecture_details')->nullable()->after('problem_statement');
        });

        // 2. Kembalikan data dari kolom multi-bahasa
        if (Schema::hasColumn('projects', 'title_id')) {
            DB::table('projects')->update([
                'title' => DB::raw('COALESCE(title_id, title_en)'),
            ]);
        }

        if (Schema::hasColumn('projects', 'problem_statement_id')) {
            DB::table('projects')->update([
                'problem_statement' => DB::raw('COALESCE(problem_statement_id, problem_statement_en)'),
            ]);
        }

        if (Schema::hasColumn('projects', 'architecture_details_id')) {
            DB::table('projects')->update([
                'architecture_details' => DB::raw('COALESCE(architecture_details_id, architecture_details_en)'),
            ]);
        }

        // 3. Hapus kolom multi-bahasa
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'title_id',
                'title_en',
                'problem_statement_id',
                'problem_statement_en',
                'architecture_details_id',
                'architecture_details_en',
            ]);
        });
    }
};
