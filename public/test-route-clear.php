<?php
echo "Files in bootstrap/cache:<br>";
$files = scandir(__DIR__ . '/../bootstrap/cache');
foreach ($files as $file) {
    if ($file !== '.' && $file !== '..') {
        echo "- $file<br>";
        unlink(__DIR__ . '/../bootstrap/cache/' . $file);
    }
}
if (function_exists('opcache_reset')) {
    opcache_reset();
    echo "OPCache reset successful!<br>";
}
