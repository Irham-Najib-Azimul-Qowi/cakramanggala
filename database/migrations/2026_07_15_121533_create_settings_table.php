<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Seed default settings values
        DB::table('settings')->insert([
            [
                'key' => 'hero_title',
                'value' => 'Mendaki Tinggi,<br><span>Menjaga Bumi</span>',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'hero_description',
                'value' => 'Wadah pembentukan karakter melalui alam bebas untuk mereka yang berani melangkah lebih jauh.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'hero_image',
                'value' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'hero_video',
                'value' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'key' => 'periode_pengurus',
                'value' => 'PERIODE 2024 — 2025',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
