<?php
require_once __DIR__ . '/../db/database.php';
$base = $base ?? rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['department_name'] ?? '');
    $hiring = isset($_POST['hiring']) && $_POST['hiring'] === '1';
    $work_mode = $_POST['work_mode'] ?? '';

    if (create($name, $hiring, $work_mode)) {
        header('Location: ' . $base . '/src/department/read');
        exit;
    } else {
        $error = "Fehler beim Erstellen!";
    }
}

require_once __DIR__ . '/../../view/department/create.php';



