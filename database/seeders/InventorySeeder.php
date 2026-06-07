<?php

namespace Database\Seeders;

use App\Models\Alat;
use App\Models\AppUser;
use App\Models\Kegiatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Mobile Admin
        $admin = AppUser::create([
            'name' => 'admin',
            'email' => 'admin@cakramanggala.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create Member
        AppUser::create([
            'name' => 'Member Perkapp',
            'email' => 'member.perkapp@cakramanggala.com',
            'password' => Hash::make('perkapp123'),
            'role' => 'member',
        ]);

        // Create Tools
        $alats = [
            ['name' => 'Tenda Dome 4P', 'category' => 'Camping', 'total_qty' => 15, 'available_qty' => 15],
            ['name' => 'Carrier 60L', 'category' => 'Camping', 'total_qty' => 10, 'available_qty' => 10],
            ['name' => 'Kompor Portable', 'category' => 'Masak', 'total_qty' => 8, 'available_qty' => 8],
            ['name' => 'Nesting', 'category' => 'Masak', 'total_qty' => 12, 'available_qty' => 12],
            ['name' => 'HT Baofeng', 'category' => 'Komunikasi', 'total_qty' => 20, 'available_qty' => 20],
        ];

        foreach ($alats as $alatData) {
            Alat::create($alatData);
        }

        // Create Activities
        $kegiatan = Kegiatan::create([
            'name' => 'Pendakian Wajib XXX',
            'description' => 'Pendakian rutin untuk anggota baru.',
            'date' => now()->addDays(7),
            'status' => 'ongoing',
            'created_by' => $admin->id,
        ]);

        // Add some tools to activity
        $tenda = Alat::where('name', 'Tenda Dome 4P')->first();
        \App\Models\KegiatanAlat::create([
            'kegiatan_id' => $kegiatan->id,
            'alat_id' => $tenda->id,
            'qty' => 5
        ]);
        $tenda->available_qty -= 5;
        $tenda->save();

        $ht = Alat::where('name', 'HT Baofeng')->first();
        \App\Models\KegiatanAlat::create([
            'kegiatan_id' => $kegiatan->id,
            'alat_id' => $ht->id,
            'qty' => 10
        ]);
        $ht->available_qty -= 10;
        $ht->save();
    }
}
