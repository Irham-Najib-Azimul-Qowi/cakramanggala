<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, update existing 'internal' and 'eksternal' records to 'umum'
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
        // First, update any new values back to 'internal' to avoid errors during rollback
        DB::table('kegiatans')
            ->whereIn('sifat', ['gunung_hutan', 'panjat_tebing', 'umum'])
            ->update(['sifat' => 'internal']);

        Schema::table('kegiatans', function (Blueprint $table) {
            $table->enum('sifat', ['internal', 'eksternal'])->change();
        });
    }
};
