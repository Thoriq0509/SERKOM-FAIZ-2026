<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('school_profiles', function (Blueprint $table) {
            $table->string('facebook')->nullable()->after('email');
            $table->string('instagram')->nullable()->after('facebook');
            $table->string('whatsapp')->nullable()->after('instagram');
        });
    }

    public function down(): void
    {
        Schema::table('school_profiles', function (Blueprint $table) {
            $table->dropColumn(['facebook', 'instagram', 'whatsapp']);
        });
    }
};