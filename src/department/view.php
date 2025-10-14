<?php
$pathParts = explode('/', $_SERVER['REQUEST_URI']);
$id = end($pathParts); //holt letzten Teil der URL

if (!is_numeric($id)) {
    die("ungültige ID!");
}

$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$department = null;
$dbError = null;

try {
    $conn = new PDO('mysql:host=10.101.105.110;dbname=mycompany;charset=utf8mb4','codingstorm','passwort');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare('SELECT * FROM department where id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $department = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $dbError = $e->getMessage();
}

if (!$department && !$dbError) {
    http_response_code(404);
    $dbError = "Department mit ID {$id} nicht gefunden.";
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Departments🏢</title>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300..700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Fira Code", sans-serif;
            padding 20px;
        }
    </style>
</head>
<body>
    <p><a href="<?= $base ?>/department/read">Zurück zur Übersicht</a></p>

    <?php if($dbError): ?>
    <h1 style="color: darkmagenta;">😭FEHLER</h1>
    <p><?= htmlspecialchars($dbError) ?></p>
    <?php else: ?>
    <h1>🏢Departments: </h1>
    <p><strong>ID:</strong><?= htmlspecialchars($department['id']) ?></p>
    <p><strong>Department-Name:</strong><?= htmlspecialchars($department['department_name'])?></p>
    <p><strong>Hiring:</strong><?= htmlspecialchars($department['hiring'] ? '🍀 Yes' : '☠️ No') ?></p>
    <p><strong>Work Mode:</strong><?= htmlspecialchars($department['work_mode']) ?></p>

    <hr>

    <h3>Edit</h3>
    <p>
    <a href="<?=  htmlspecialchars($base . '/department/update/' . $department['id'])?>">✏️Bearbeiten</a>
    <a href="<?= htmlspecialchars($base . '/department/delete/' . $department['id']) ?>" onclick="return confirm('Wirklich löschen?')">🗑️Löschen</a>
    </p>
    <?php endif; ?>
</body>
</html>
