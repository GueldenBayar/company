<?php
$conn = new PDO('mysql:host=localhost;dbname=company;charset=utf8mb4', 'phpstorm', '123456');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first = $_POST['firstname'];
    $last = $_POST['lastname'];
    $stmt = $conn->prepare('INSERT INTO employees (firstname, lastname) VALUES (?, ?)');
    $stmt->execute([$first, $last]);
    header('Location: firstread.php');
    exit;
}
?>
<!doctype html>
<html lang="de">
<head><meta charset="UTF-8"><title>Neuer Mitarbeiter</title></head>
<body>
<h1 style="text-align:center;">Neuen Mitarbeiter anlegen</h1>
<form method="post" style="text-align:center;">
    <label>Vorname: </label><input name="firstname" required><br><br>
    <label>Nachname: </label><input name="lastname" required><br><br>
    <button type="submit">Speichern</button>
</form>
<p style="text-align:center;"><a href="firstread.php">⬅️ Zurück</a></p>
</body>
</html>
