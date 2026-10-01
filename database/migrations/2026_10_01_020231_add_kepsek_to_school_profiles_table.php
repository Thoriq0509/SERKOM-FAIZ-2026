<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('school_profiles', function (Blueprint $table) {
            $table->string('foto_kepsek', 100)->nullable()->after('kepala_sekolah');
            $table->text('sambutan_kepsek')->nullable()->after('foto_kepsek');
        });
    }

    public function down(): void
    {
        Schema::table('school_profiles', function (Blueprint $table) {
            $table->dropColumn(['foto_kepsek', 'sambutan_kepsek']);
        });
    }
};