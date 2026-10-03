<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('extracurriculars', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ekskul', 40);
            $table->unsignedInteger('id_guru')->nullable();
            $table->foreign('id_guru')
                  ->references('id')
                  ->on('teachers')
                  ->cascadeOnUpdate()
                  ->nullOnDelete();

            $table->string('jadwal_latihan', 40)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('gambar', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('extracurriculars');
    }
};