<?php
require_once __DIR__ . '/../db/database.php';
$pdo = dbcon();
$base = $base ?? rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

if (!$id) {
    echo 'Keine ID angegeben.';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['department_name'] ?? '');
    $hiring = isset($_POST['hiring']) && $_POST['hiring'] === '1' ? 1 : 0;
    $mode = $_POST['work_mode'] ?? '';

    $stmt = $pdo->prepare('UPDATE department SET department_name=?, hiring=?, work_mode=? WHERE id=?');
    $stmt->execute([$name, $hiring, $mode, $id]);

    header('Location: ' . $base . '/department/read');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM department WHERE id=?');
$stmt->execute([$id]);
$dep = $stmt->fetch();

if (!$dep) {
    echo 'Abteilung nicht gefunden.';
    exit;
}
?>


