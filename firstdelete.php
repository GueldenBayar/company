<?php
$conn = new PDO('mysql:host=localhost;dbname=company;charset=utf8mb4', 'phpstorm', '123456');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = (int)($_GET['id'] ?? 0);
$stmt = $conn->prepare('DELETE FROM employees WHERE id = ?');
$stmt->execute([$id]);

header('Location: firstread.php');
exit;
?>
