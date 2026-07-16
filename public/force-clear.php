<?php
if (function_exists('opcache_reset')) {
    @opcache_reset();
}

$files = [
    __DIR__ . '/../bootstrap/cache/config.php',
    __DIR__ . '/../bootstrap/cache/routes-v7.php',
    __DIR__ . '/../bootstrap/cache/services.php',
    __DIR__ . '/../bootstrap/cache/packages.php',
];

$output = "Force Clearing Laravel Cache:\n";
foreach ($files as $file) {
    if (file_exists($file)) {
        if (@unlink($file)) {
            $output .= "SUCCESS: Deleted " . basename($file) . "\n";
        }
    }
}

try {
    require __DIR__.'/../vendor/autoload.php';
    $app = require_once __DIR__.'/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();

    // Run Migrations
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    $output .= "SUCCESS: Migrations run: " . trim(\Illuminate\Support\Facades\Artisan::output()) . "\n";

    // Clear Cache
    \Illuminate\Support\Facades\Cache::flush();
    $output .= "SUCCESS: Laravel cache flushed.\n";

} catch (\Exception $e) {
    $output .= "WARNING: " . $e->getMessage() . "\n";
}

echo nl2br($output);
