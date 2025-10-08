<?php
$conn = new PDO('mysql:host=localhost;dbname=mycompany;charset=utf8mb4', 'codingstorm', 'passwort');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare('INSERT INTO department (department_name) VALUES (?)');
    $stmt->execute([$_POST['department_name']]);
    header('Location: deptread.php');
    exit;
}
?>
<!doctype html>
<html lang="de">
<head><meta charset="UTF-8"><title>Neue Abteilung hinzufügen</title></head>
<body>
<h1 style="text-align:center;">Neue Abteilung hinzufügen</h1>
<form method="post" style="text-align:center;">
    Name: <input type="text" name="department_name" required><br><br>
    <button type="submit">Speichern</button>
</form>
</body>
</html>
