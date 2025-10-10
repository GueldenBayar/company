<?php
require_once __DIR__ . '/../db/database.php';
$pdo = getConnection();

$base = $base ?? rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['department_name'] ?? '');
    $hiring = isset($_POST['hiring']) && $_POST['hiring'] === '1' ? 1 : 0;
    $work_mode = $_POST['work_mode'] ?? '';

    $stmt = $pdo->prepare('INSERT INTO department (department_name, hiring, work_mode) VALUES (:name, :hiring, :mode)');
    $stmt->execute([':name' => $name, ':hiring' => $hiring, ':mode' => $work_mode]);

    header('Location: ' . $base . '/department/read');
    exit;
}
?>
<!doctype html>
<html lang="de">
<head><meta charset="utf-8"><title>Abteilung erstellen</title></head>
<body>
<h1>Neue Abteilung erstellen</h1>

<form method="post">
    <label>Name: <input type="text" name="department_name" required></label><br><br>

    <fieldset>
        <legend>Hiring?</legend>
        <label><input type="radio" name="hiring" value="1" checked> Yes</label>
        <label><input type="radio" name="hiring" value="0"> No</label>
    </fieldset><br>

    <fieldset>
        <legend>Work Mode</legend>
        <label><input type="radio" name="work_mode" value="onsite" checked> Onsite</label>
        <label><input type="radio" name="work_mode" value="hybrid"> Hybrid</label>
        <label><input type="radio" name="work_mode" value="remote"> Remote</label>
    </fieldset><br>

    <button type="submit">Speichern</button>
</form>

<p><a href="<?= htmlspecialchars($base . '/department/read') ?>">Zurück</a></p>
</body>
</html>

