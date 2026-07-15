<?php
header('Content-Type: text/plain');
$logFile = __DIR__ . '/../storage/logs/laravel.log';
if (file_exists($logFile)) {
    $lines = file($logFile);
    $lastLines = array_slice($lines, -400);
    echo implode("", $lastLines);
} else {
    echo "Laravel log file not found at " . $logFile;
}
