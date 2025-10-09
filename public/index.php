<?php
// public/index.php

$url = $_GET['url'] ?? '';
$parts = explode('/', trim($url, '/'));

$entity = $parts[0] ?? '';
$action = $parts[1] ?? '';
$id     = $parts[2] ?? null;

$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

// Startseite
if ($entity === '' || $entity === null) {
    echo '<h1>Willkommen 👋</h1>';
    echo '<p><a href="' . $base . '/department/read">Zu den Abteilungen</a></p>';
    exit;
}

// Abteilungs-Routing
if ($entity === 'department') {
    $path = __DIR__ . '/../src/department/';

    switch ($action) {
        case 'create':
            require $path . 'create.php';
            break;
        case 'read':
        case '':
            require $path . 'read.php';
            break;
        case 'update':
            require $path . 'update.php';
            break;
        case 'delete':
            require $path . 'delete.php';
            break;
        default:
            http_response_code(404);
            echo '404 - Seite nicht gefunden';
    }
    exit;
}

http_response_code(404);
echo '404 - Seite nicht gefunden';
