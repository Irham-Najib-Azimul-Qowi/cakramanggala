<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('catatan_perjalanans', function (Blueprint $table) {
            $table->uuid('kegiatan_id')->nullable();
            $table->string('gambar')->nullable();
            
            // In SQLite, adding foreign keys directly in table alter may require care, 
            // so we define it as uuid and set up relation in PHP model or define FK conditionally.
        });
    }

    public function down(): void
    {
        Schema::table('catatan_perjalanans', function (Blueprint $table) {
            $table->dropColumn(['kegiatan_id', 'gambar']);
        });
    }
};
