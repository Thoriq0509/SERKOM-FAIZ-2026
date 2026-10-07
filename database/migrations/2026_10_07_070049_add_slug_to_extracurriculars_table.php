<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('extracurriculars', 'slug')) {
            Schema::table('extracurriculars', function (Blueprint $table) {
                $table->string('slug')->unique()->nullable()->after('nama_ekskul');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('extracurriculars', 'slug')) {
            Schema::table('extracurriculars', function (Blueprint $table) {
                $table->dropColumn('slug');
            });
        }
    }
};