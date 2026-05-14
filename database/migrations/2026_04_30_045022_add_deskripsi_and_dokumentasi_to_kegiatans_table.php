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
        Schema::table('kegiatans', function (Blueprint $row) {
            $row->text('deskripsi')->nullable()->after('materi');
            $row->json('dokumentasi')->nullable()->after('gambar_utama'); // Untuk menyimpan array path gambar (maks 6)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatans', function (Blueprint $row) {
            $row->dropColumn(['deskripsi', 'dokumentasi']);
        });
    }
};
