<?php
require_once __DIR__ . '/../db/database.php';
$pdo = getConnection();
$base = $base ?? rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

if (!$id) {
    echo 'Keine ID angegeben.';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['department_name'] ?? '');
    $hiring = isset($_POST['hiring']) && $_POST['hiring'] === '1' ? 1 : 0;
    $mode = $_POST['work_mode'] ?? '';

    $stmt = $pdo->prepare('UPDATE department SET department_name=?, hiring=?, work_mode=? WHERE id=?');
    $stmt->execute([$name, $hiring, $mode, $id]);

    header('Location: ' . $base . '/department/read');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM department WHERE id=?');
$stmt->execute([$id]);
$dep = $stmt->fetch();

if (!$dep) {
    echo 'Abteilung nicht gefunden.';
    exit;
}
?>
<!doctype html>
<html lang="de">
<head><meta charset="utf-8"><title>Abteilung bearbeiten</title></head>
<body>
<h1>Abteilung bearbeiten</h1>

<form method="post">
    <label>Name: <input type="text" name="department_name" value="<?= htmlspecialchars($dep['department_name']) ?>" required></label><br><br>

    <fieldset>
        <legend>Hiring?</legend>
        <label><input type="radio" name="hiring" value="1" <?= $dep['hiring'] ? 'checked' : '' ?>> Yes</label>
        <label><input type="radio" name="hiring" value="0" <?= !$dep['hiring'] ? 'checked' : '' ?>> No</label>
    </fieldset><br>

    <fieldset>
        <legend>Work Mode</legend>
        <label><input type="radio" name="work_mode" value="onsite" <?= $dep['work_mode']==='onsite' ? 'checked' : '' ?>> Onsite</label>
        <label><input type="radio" name="work_mode" value="hybrid" <?= $dep['work_mode']==='hybrid' ? 'checked' : '' ?>> Hybrid</label>
        <label><input type="radio" name="work_mode" value="remote" <?= $dep['work_mode']==='remote' ? 'checked' : '' ?>> Remote</label>
    </fieldset><br>

    <button type="submit">Speichern</button>
</form>

<p><a href="<?= htmlspecialchars($base . '/department/read') ?>">Zurück</a></p>
</body>
</html>

