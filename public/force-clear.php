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
if (function_exists('opcache_reset')) {
    $output .= "SUCCESS: OPCache cleared.\n";
} else {
    $output .= "INFO: OPCache extension not loaded.\n";
}

foreach ($files as $file) {
    if (file_exists($file)) {
        if (@unlink($file)) {
            $output .= "SUCCESS: Deleted " . basename($file) . "\n";
        } else {
            $output .= "FAILED: Could not delete " . basename($file) . "\n";
        }
    } else {
        $output .= "INFO: Not found " . basename($file) . "\n";
    }
}

echo nl2br($output);
