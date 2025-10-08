<?php
// Verbindung zur Datenbank
$conn = new PDO('mysql:host=localhost;dbname=mycompany;charset=utf8mb4', 'codingstorm', 'passwort');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Prüfen, ob eine ID übergeben wurde
$id = $_GET['id'] ?? null;
if (!$id) exit('ID fehlt');

// Wenn Formular abgesendet wurde, update durchführen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare('UPDATE department SET name=? WHERE id=?');
    $stmt->execute([$_POST['department_name'], $id]);
    header('Location: deptread.php');
    exit;
}

// Datensatz laden
$stmt = $conn->prepare('SELECT * FROM department WHERE id=?');
$stmt->execute([$id]);
$department = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$department) exit('Abteilung nicht gefunden');
?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Abteilung bearbeiten</title>
</head>
<body>
<h1 style="text-align:center;">Abteilung bearbeiten</h1>
<form method="post" style="text-align:center;">
    Name: <input type="text" name="name" value="<?= htmlspecialchars($department['name'] ?? '') ?>" required><br><br>
    <button type="submit">Aktualisieren</button>
</form>
</body>
</html>

