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
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->string('judul_kegiatan');
            $table->date('tanggal_pelaksanaan');
            $table->text('materi')->nullable();
            $table->string('tempat');
            $table->string('kapel_pj'); // Ketua Pelaksana/Penanggung Jawab
            $table->enum('sifat', ['internal', 'eksternal']);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};