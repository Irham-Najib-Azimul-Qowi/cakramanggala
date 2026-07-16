<?php

// public/sync-pengurus.php

try {
    require __DIR__.'/../vendor/autoload.php';
    $app = require_once __DIR__.'/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();

    $penguruses = \App\Models\Pengurus::all();
    $synced = 0;
    $ignored = 0;

    foreach ($penguruses as $p) {
        // Skip Dosen Pembina (urutan 0)
        if ($p->urutan === 0) {
            $ignored++;
            continue;
        }

        if (empty($p->nim)) {
            $ignored++;
            continue;
        }

        // Rule: maulana ilyasa dan jakwan itu angkatan 12 , pengurus lainnya angkatan 13
        $nameLower = strtolower($p->nama);
        $angkatan = '13';
        if (str_contains($nameLower, 'maulana ilyasa') || str_contains($nameLower, 'jakwan')) {
            $angkatan = '12';
        }

        \App\Models\Anggota::updateOrCreate(
            ['nim' => $p->nim],
            [
                'nama' => $p->nama,
                'email' => $p->email,
                'angkatan' => $angkatan,
                'status' => 'anggota',
                'foto' => $p->foto
            ]
        );

        $synced++;
    }

    echo "SUCCESS: Sync complete!<br>Synced: $synced pengurus<br>Ignored (Pembina/no NIM): $ignored";

} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
