<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->string('email')->nullable();
        });

        Schema::table('penguruses', function (Blueprint $table) {
            $table->string('nim')->nullable();
            $table->string('email')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropColumn('email');
        });

        Schema::table('penguruses', function (Blueprint $table) {
            $table->dropColumn(['nim', 'email']);
        });
    }
};
