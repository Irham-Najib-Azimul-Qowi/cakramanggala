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
        Schema::create('kegiatan_alat', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('kegiatan_id')->constrained('kegiatan')->onDelete('cascade');
            $table->foreignUuid('alat_id')->constrained('alat')->onDelete('cascade');
            $table->integer('qty');
            $table->timestamps(); // created_at is included in timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_alat');
    }
};
