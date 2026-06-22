<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CatatanPerjalanan;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImportCatatanPerjalanan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-catatan-perjalanan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import parsed travel logs from JSON and copy original files to public storage';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $jsonPath = base_path('catatan_perjalanan_parsed.json');
        if (!File::exists($jsonPath)) {
            $this->error("JSON file not found at {$jsonPath}. Please run the python parser script first.");
            return 1;
        }

        $data = json_decode(File::get($jsonPath), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error("Failed to decode JSON: " . json_last_error_msg());
            return 1;
        }

        // Find default admin user
        $user = User::where('role', 'admin')->first() ?? User::first();
        if (!$user) {
            $this->error("No admin or normal user found in the database. Please run seeders first.");
            return 1;
        }

        $this->info("Found user: {$user->name} ({$user->email}) to attribute logs to.");
        $this->info("Starting import of " . count($data) . " items...");

        $storageDir = storage_path('app/public/catatan_perjalanan');
        if (!File::exists($storageDir)) {
            File::makeDirectory($storageDir, 0755, true);
        }

        $importedCount = 0;
        $skippedCount = 0;

        foreach ($data as $item) {
            $judul = $item['judul'];
            $penulis = $item['penulis'];
            $angkatan = $item['angkatan'] ?? null;
            $tanggal = $item['tanggal_perjalanan'] ?? null;
            $lokasi = $item['lokasi'] ?? null;
            $konten = $item['konten'];
            $originalFilename = $item['original_filename'];

            $slug = Str::slug($judul);
            
            // Check if already exists in DB
            $existing = CatatanPerjalanan::where('judul', $judul)
                ->orWhere('slug', $slug)
                ->first();

            if ($existing) {
                $this->comment("Skipping already existing: {$judul}");
                $skippedCount++;
                continue;
            }

            // Copy file to public storage
            $sourceFile = base_path('catatan_perjalanan/' . $originalFilename);
            $targetFilePath = null;
            if (File::exists($sourceFile)) {
                // Ensure unique name in target directory
                $safeName = Str::random(8) . '_' . $originalFilename;
                $targetFile = $storageDir . '/' . $safeName;
                File::copy($sourceFile, $targetFile);
                $targetFilePath = 'catatan_perjalanan/' . $safeName;
            } else {
                $this->warn("Source file not found: {$sourceFile}");
            }

            // Save to DB
            CatatanPerjalanan::create([
                'judul' => $judul,
                'slug' => $slug . '-' . Str::random(5),
                'penulis' => $penulis,
                'angkatan' => $angkatan,
                'tanggal_perjalanan' => $tanggal ? date('Y-m-d', strtotime($tanggal)) : null,
                'lokasi' => $lokasi,
                'konten' => $konten ?: 'Konten kosong.',
                'file_path' => $targetFilePath,
                'status' => 'published',
                'user_id' => $user->id,
                'views' => 0
            ]);

            $this->info("Imported: {$judul} by {$penulis}");
            $importedCount++;
        }

        $this->info("Import completed successfully!");
        $this->info("Imported: {$importedCount}, Skipped: {$skippedCount}");

        return 0;
    }
}
