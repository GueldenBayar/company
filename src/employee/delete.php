<?php
$conn = new PDO('mysql:host=localhost;dbname=mycompany;charset=utf8mb4', 'codingstorm', 'passwort');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['id'] ?? null;
if (!$id) exit('ID fehlt');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare('UPDATE employees SET fname=?, lname=? WHERE id=?');
    $stmt->execute([$_POST['fname'], $_POST['lname'], $id]);
    header('Location: /employee/read');
    exit;
}

$stmt = $conn->prepare('SELECT * FROM employees WHERE id=?');
$stmt->execute([$id]);
$employee = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$employee) exit('Mitarbeiter nicht gefunden');
?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Mitarbeiter bearbeiten</title>
</head>
<body>
<h1 style="text-align:center;">Mitarbeiter bearbeiten</h1>
<form method="post" style="text-align:center;">
    Vorname: <input type="text" name="fname" value="<?= htmlspecialchars($employee['fname']) ?>" required><br><br>
    Nachname: <input type="text" name="lname" value="<?= htmlspecialchars($employee['lname']) ?>" required><br><br>
    <button type="submit">Aktualisieren</button>
</form>
</body>
</html>
