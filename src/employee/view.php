<?php
//echo 'Die komplette aufgerufene URI ist: ';
//var_dump($_SERVER['REQUEST_URI']);
//
//$pathParts = explode('/', $_SERVER['REQUEST_URI']);
//
//echo '<br><br>Die URI wurde in folgende Teile zerlegt: ';
//echo '<pre>'; // <pre> sorgt für eine schönere Darstellung des Arrays
//print_r($pathParts);
//echo '</pre>';
//
////testen, welchen Teil ich brauche
//$id = end($pathParts);
//echo "<br>Mit end() bekomme ich die ID: " . $id;
//
////optional: wenn die ID nicht das letzte Teil ist
////echo "<br>Der vierte Teil ist: " . $pathParts[3];
////echo "<br>Der fünfte Teil ist: " . $pathParts[4];
//
//die(); //stoppt das Skript hier, damit wir unsere Test Ausgaben sehen

$pathParts = explode('/', $_SERVER['REQUEST_URI']);
$id = end($pathParts); //holt sich letzten teil der URL

if (!is_numeric($id)) {
    die("Ungültige ID.");
}

$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$employee = null;
$dbError = null;

try {
    $conn = new PDO('mysql:host=10.101.105.110;dbname=mycompany;charset=utf8mb4', 'codingstorm', 'passwort');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $conn->prepare('SELECT * FROM employees WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $dbError = $e->getMessage();
}

if (!$employee && !$dbError) {
    //Wenn kein Fehler, aber auch kein Mitarbeiter gefunden wurde
    http_response_code(404);
    $dbError = "Mitarbeiter mit ID {$id} nicht gefunden.";
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300..700&display=swap" rel="stylesheet">
    <style> body { font-family: "Fira Code", sans-serif; padding: 20px; } </style>
</head>
<body>
    <p><a href="<?= $base ?>/employee/read">Zurück zur Übersicht</a></p>

    <?php if ($dbError): ?>
    <h1 style="color: red;">Fehler</h1>
    <p><?= htmlspecialchars($dbError) ?></p>
<?php else: ?>
    <h1>🦄Mitarbeiter: <?= htmlspecialchars($employee['fname']) ?> <?= htmlspecialchars($employee['lname']) ?></h1>

    <p><strong>ID:</strong><?= htmlspecialchars($employee['id']) ?></p>
    <p><strong>Vorname:</strong><?= htmlspecialchars($employee['fname']) ?></p>
    <p><strong>Nachname:</strong><?= htmlspecialchars($employee['lname']) ?></p>

    <hr>

    <h3>Aktionen</h3>
    <p>
        <a href="<?= $base ?>/employee/update/<?= $employee['id'] ?>">💫 Update</a>
        <a href="<?= $base ?>/employee/delete/<?= $employee['id'] ?>" onclick="return confirm('wirklich löschen ?')">☠️ Delete</a>
    </p>
   <?php endif; ?>
</body>
</html>


