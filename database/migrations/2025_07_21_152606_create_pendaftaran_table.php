<?php
// File: database/migrations/xxxx_xx_xx_create_pendaftaran_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nim')->unique();
            $table->enum('jurusan', ['Teknik', 'Akuntansi', 'Administrasi Bisnis']);
            $table->string('program_studi');
            $table->enum('jenis_kelamin', ['Perempuan', 'Laki-laki']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('no_hp');
            $table->text('alamat');
            $table->text('organisasi_yang_pernah_diikuti')->nullable();
            $table->text('alasan_bergabung');
            $table->string('foto_diri')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftaran');
    }
};