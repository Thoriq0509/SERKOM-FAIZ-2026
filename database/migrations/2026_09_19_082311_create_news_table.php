<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();

            $table->string('judul', 50);

            $table->text('isi');

            $table->date('tanggal');

            $table->string('gambar', 100)->nullable();

            $table->enum(
                'status',
                [
                    'Publish',
                    'Draft',
                ]
            )->default('Publish');

            // ==========================================
            // ID USER
            // ==========================================
            // Harus sama tipe dengan users.id_user
            $table->unsignedInteger('id_user');

            $table->foreign('id_user')
                ->references('id_user')
                ->on('users')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};