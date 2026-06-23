<?php
$routesFile = __DIR__ . '/../bootstrap/cache/routes-v7.php';
$configFile = __DIR__ . '/../bootstrap/cache/config.php';

echo "Routes file exists: " . (file_exists($routesFile) ? "YES" : "NO") . "<br>";
if (file_exists($routesFile)) {
    if (unlink($routesFile)) {
        echo "Successfully deleted routes cache file!<br>";
    } else {
        echo "Failed to delete routes cache file!<br>";
    }
}

echo "Config file exists: " . (file_exists($configFile) ? "YES" : "NO") . "<br>";
if (file_exists($configFile)) {
    if (unlink($configFile)) {
        echo "Successfully deleted config cache file!<br>";
    } else {
        echo "Failed to delete config cache file!<br>";
    }
}

if (function_exists('opcache_reset')) {
    opcache_reset();
    echo "OPCache reset successful!<br>";
}
