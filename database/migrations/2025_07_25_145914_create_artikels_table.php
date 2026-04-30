<?php
// File: database/migrations/2025_01_XX_XXXXXX_create_artikels_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable(); // Ringkasan artikel
            $table->longText('konten');
            $table->string('gambar_utama')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Penulis
            $table->integer('views')->default(0);
            $table->timestamps();
            
            $table->index(['status', 'created_at']);
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};