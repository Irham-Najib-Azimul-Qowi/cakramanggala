<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // 1. Update existing data where email is empty/null using nim@student.pnm.ac.id
        DB::statement("UPDATE pendaftaran SET email = CONCAT(nim, '@student.pnm.ac.id') WHERE (email IS NULL OR email = '') AND nim IS NOT NULL AND nim != ''");
        DB::statement("UPDATE anggotas SET email = CONCAT(nim, '@student.pnm.ac.id') WHERE (email IS NULL OR email = '') AND nim IS NOT NULL AND nim != ''");
        DB::statement("UPDATE penguruses SET email = CONCAT(nim, '@student.pnm.ac.id') WHERE (email IS NULL OR email = '') AND nim IS NOT NULL AND nim != ''");

        // 2. Adjust columns on pendaftaran table
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->string('nim')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->string('nim')->nullable(false)->change();
        });
    }
};
