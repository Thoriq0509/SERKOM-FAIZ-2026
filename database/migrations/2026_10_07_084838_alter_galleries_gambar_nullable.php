<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->string('gambar')->nullable()->change();
            $table->string('link_video')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->string('gambar')->nullable(false)->change();
            $table->string('link_video')->nullable()->change();
        });
    }
};