<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_profiles', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement()->primary();
            $table->string('nama_sekolah', 40);
            $table->string('kepala_sekolah', 40)->nullable();
            $table->string('foto', 100)->nullable();
            $table->string('logo', 100)->nullable();
            $table->string('npsn', 10)->nullable();
            $table->text('alamat')->nullable();
            $table->string('kontak', 15)->nullable();
            $table->text('visi_misi')->nullable();
            $table->year('tahun_berdiri')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_profiles');
    }
};