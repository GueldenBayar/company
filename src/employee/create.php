<?php
$conn = new PDO('mysql:host=localhost;dbname=mycompany;charset=utf8mb4', 'codingstorm', 'passwort');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare('INSERT INTO employees (fname, lname) VALUES (?, ?)');
    $stmt->execute([$_POST['fname'], $_POST['lname']]);
    header('Location: /employee/read');
    exit;
}
?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Neuen Mitarbeiter hinzufügen</title>
</head>
<body>
<h1 style="text-align:center;">Neuen Mitarbeiter hinzufügen</h1>
<form method="post" style="text-align:center;">
    Vorname: <input type="text" name="fname" required><br><br>
    Nachname: <input type="text" name="lname" required><br><br>
    <button type="submit">Speichern</button>
</form>
</body>
</html>
