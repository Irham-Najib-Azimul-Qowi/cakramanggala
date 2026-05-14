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
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->index('tahun');
            $table->index('sifat');
            $table->index('tanggal_pelaksanaan');
        });

        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->index('jurusan');
            $table->index('status');
            $table->index('created_at');
        });

        Schema::table('pesans', function (Blueprint $table) {
            $table->index('is_read');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropIndex(['tahun']);
            $table->dropIndex(['sifat']);
            $table->dropIndex(['tanggal_pelaksanaan']);
        });

        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropIndex(['jurusan']);
            $table->dropIndex(['status']);
            $table->dropIndex(['created_at']);
        });

        Schema::table('pesans', function (Blueprint $table) {
            $table->dropIndex(['is_read']);
            $table->dropIndex(['created_at']);
        });
    }
};
