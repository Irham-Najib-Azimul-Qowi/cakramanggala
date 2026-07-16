<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Insert default setting for angkatan_pendaftaran_default
        DB::table('settings')->updateOrInsert(
            ['key' => 'angkatan_pendaftaran_default'],
            [
                'value' => '14',
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        // Update default periode_pengurus setting to 'auto' if not set
        $exists = DB::table('settings')->where('key', 'periode_pengurus')->exists();
        if (!$exists) {
            DB::table('settings')->insert([
                'key' => 'periode_pengurus',
                'value' => 'auto',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('settings')->where('key', 'angkatan_pendaftaran_default')->delete();
    }
};
