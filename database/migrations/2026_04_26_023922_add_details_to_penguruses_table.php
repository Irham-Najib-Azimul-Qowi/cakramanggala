<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('penguruses', function (Blueprint $table) {
            $table->string('prodi_semester')->nullable()->after('jabatan');
            $table->string('instagram_url')->nullable()->after('prodi_semester');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penguruses', function (Blueprint $table) {
            $table->dropColumn(['prodi_semester', 'instagram_url']);
        });
    }
};
