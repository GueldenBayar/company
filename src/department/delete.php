<?php
require_once __DIR__ . '/../db/database.php';
$pdo = dbcon();
$base = $base ?? rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

if ($id) {
    $stmt = $pdo->prepare('DELETE FROM department WHERE id=?');
    $stmt->execute([$id]);
}

header('Location: ' . $base . '/department/read');
exit;
