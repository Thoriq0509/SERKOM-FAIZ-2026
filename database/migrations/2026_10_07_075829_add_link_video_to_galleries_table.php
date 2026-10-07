<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('galleries', 'link_video')) {
            Schema::table('galleries', function (Blueprint $table) {
                $table->string('link_video')->nullable()->after('gambar');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('galleries', 'link_video')) {
            Schema::table('galleries', function (Blueprint $table) {
                $table->dropColumn('link_video');
            });
        }
    }
};