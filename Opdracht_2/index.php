<?php

declare(strict_types=1);

$root = __DIR__ . DIRECTORY_SEPARATOR;

define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('APP_PATH', $root . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);
include $root . DIRECTORY_SEPARATOR . 'monthConverter.php';
include $root . DIRECTORY_SEPARATOR . 'CSVProcessor.php';


if (!is_dir(FILES_PATH)) {
    die('FILES_PATH is not a valid directory.');
}

$files = array_diff(scandir(FILES_PATH), ['.', '..']);

if (isset($_GET['file']) && in_array($_GET['file'], $files)) {
    $filePath = FILES_PATH . $_GET['file'];
    include APP_PATH . 'app.php';
} else {
    echo "
    <!DOCTYPE html>
    <html lang='nl'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Kies een Bestand</title>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
        <style>
            .custom-button {
                background-color: #6c757d;
                color: white;
                text-align: center;
                width: 100%;
                border: 2px solid #343a40;
                border-radius: 5px;
                font-size: 1.25rem;
                padding: 10px;
            }
            .custom-button:hover {
                background-color: #5a6268;
            }
        </style>
    </head>
    <body>
        <div class='container mt-5'>
            <h1 class='text-center'>Kies een bestand:</h1>
            <div class='list-group'>";

    foreach ($files as $file) {
        echo "<a href='?file=" . urlencode($file) . "' class='list-group-item custom-button'>$file</a>";
    }

    echo "
            </div>
        </div>
        <script src='https://code.jquery.com/jquery-3.5.1.slim.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
    </body>
    </html>";
}