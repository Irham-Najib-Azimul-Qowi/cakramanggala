<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Change enum column to string first to prevent MySQL enum truncation errors
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->string('sifat')->change();
        });

        DB::table('kegiatans')
            ->whereIn('sifat', ['internal', 'eksternal'])
            ->update(['sifat' => 'umum']);

        Schema::table('kegiatans', function (Blueprint $table) {
            $table->enum('sifat', ['umum', 'gunung_hutan', 'panjat_tebing'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->string('sifat')->change();
        });

        DB::table('kegiatans')
            ->whereIn('sifat', ['gunung_hutan', 'panjat_tebing', 'umum'])
            ->update(['sifat' => 'internal']);

        Schema::table('kegiatans', function (Blueprint $table) {
            $table->enum('sifat', ['internal', 'eksternal'])->change();
        });
    }
};
