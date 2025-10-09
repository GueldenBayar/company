<?php
$conn = new PDO('mysql:host=localhost;dbname=mycompany;charset=utf8mb4', 'codingstorm', 'passwort');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $conn->prepare('DELETE FROM department WHERE id=?');
    $stmt->execute([$id]);
}
header('Location: read_department.php');
exit;
