<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

// Load bootstrap
require __DIR__.'/../bootstrap/app.php';

$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: text/plain');

echo "Database Status Check:\n";
try {
    $pdo = DB::connection()->getPdo();
    echo "SUCCESS: Connected to database.\n";
    
    $tables = DB::select('SHOW TABLES');
    echo "Tables in database:\n";
    foreach ($tables as $table) {
        $table_array = (array)$table;
        echo "- " . reset($table_array) . "\n";
    }
    
    if (Schema::hasTable('settings')) {
        echo "SUCCESS: Settings table exists.\n";
        $settings = DB::table('settings')->get();
        echo "Settings count: " . $settings->count() . "\n";
        foreach ($settings as $setting) {
            echo "  [{$setting->key}]: " . substr(strip_tags($setting->value), 0, 50) . "...\n";
        }
    } else {
        echo "WARNING: Settings table does NOT exist.\n";
        echo "Running php artisan migrate --force...\n";
        $exitCode = Artisan::call('migrate', ['--force' => true]);
        echo "Artisan migrate exit code: " . $exitCode . "\n";
        echo "Artisan output:\n" . Artisan::output() . "\n";
    }
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
