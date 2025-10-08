<?php
$conn = new PDO('mysql:host=localhost;dbname=company;charset=utf8mb4', 'phpstorm', '123456');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = (int)($_GET['id'] ?? 0);
$stmt = $conn->prepare('SELECT * FROM employees WHERE id = ?');
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    die("Mitarbeiter nicht gefunden.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first = $_POST['firstname'];
    $last = $_POST['lastname'];
    $stmt = $conn->prepare('UPDATE employees SET firstname = ?, lastname = ? WHERE id = ?');
    $stmt->execute([$first, $last, $id]);
    header('Location: firstread.php');
    exit;
}
?>
<!doctype html>
<html lang="de">
<head><meta charset="UTF-8"><title>Mitarbeiter bearbeiten</title></head>
<body>
<h1 style="text-align:center;">Mitarbeiter bearbeiten</h1>
<form method="post" style="text-align:center;">
    <label>Vorname: </label>
    <input name="firstname" value="<?= htmlspecialchars($row['firstname']) ?>" required><br><br>
    <label>Nachname: </label>
    <input name="lastname" value="<?= htmlspecialchars($row['lastname']) ?>" required><br><br>
    <button type="submit">Speichern</button>
</form>
<p style="text-align:center;"><a href="firstread.php">⬅️ Zurück</a></p>
</body>
</html>
