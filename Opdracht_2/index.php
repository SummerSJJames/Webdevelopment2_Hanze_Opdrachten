<?php

declare(strict_types=1);

$root = __DIR__ . DIRECTORY_SEPARATOR;

define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('APP_PATH', $root . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

if (!is_dir(FILES_PATH)) {
    die('FILES_PATH is not a valid directory.');
}

$files = array_diff(scandir(FILES_PATH), ['.', '..']);

if (isset($_GET['file']) && in_array($_GET['file'], $files)) {
    $filePath = FILES_PATH . $_GET['file'];
    include APP_PATH . 'app.php';
} else {
    echo "<h1>Kies een bestand:</h1>";
    echo "<ul>";
    foreach ($files as $file) {
        echo "<li><a href='?file=" . urlencode($file) . "'>$file</a></li>";
    }
    echo "</ul>";
}