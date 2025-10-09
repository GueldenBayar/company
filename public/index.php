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
    echo '<h1>Welcome 👋</h1>';
    echo '<p><a href="' . $base . '/department/read">Zu den Abteilungen</a></p>';
    echo '<p><a href="' . $base . '/employee/read">Zu den Mitarbeitern</a></p>';
    exit;
}

// Routing für Departments
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
            $id = $parts[2] ?? null;
            require $path . 'update.php';
            break;
        case 'delete':
            $id = $parts[2] ?? null;
            require $path . 'delete.php';
            break;
        default:
            http_response_code(404);
            echo '404 - Seite nicht gefunden';
    }
    exit;
}

// Routing für Employees
if ($entity === 'employee') {
    $path = __DIR__ . '/../src/employee/';
    switch ($action) {
        case 'create':
            require $path . 'create.php';
            break;
        case 'read':
        case '':
            require $path . 'read.php';
            break;
        case 'update':
            $id = $parts[2] ?? null; // 🔥 ID hier setzen!
            require $path . 'update.php';
            break;
        case 'delete':
            $id = $parts[2] ?? null; // 🔥 auch hier
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

