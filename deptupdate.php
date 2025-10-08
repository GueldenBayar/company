<?php
$conn = new PDO('mysql:host=localhost;dbname=mycompany;charset=utf8mb4', 'codingstorm', 'passwort');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['id'] ?? null;
if (!$id) exit('ID fehlt 🥺');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare('UPDATE department SET department_name=:department_name, hiring=:hiring, work_mode=:work_mode WHERE id=:id');
    $hiring = $_POST['hiring'] === '1' ? 1 : 0;
    $stmt->bindParam(':department_name', $_POST['department_name'], PDO::PARAM_STR);
    $stmt->bindParam(':hiring', $hiring, PDO::PARAM_BOOL);
    $stmt->bindParam(':work_mode', $_POST['work_mode'], PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    header('Location: deptread.php');
    exit;
}

$stmt = $conn->prepare('SELECT * FROM department WHERE id=:id');
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$department = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$department) exit('Abteilung nicht gefunden 😢');
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
    <label>Abteilungsname:</label><br>
    <input type="text" name="department_name" value="<?= htmlspecialchars($department['department_name']) ?>" required><br><br>

    <fieldset style="display:inline-block; text-align:left;">
        <legend>Hiring?</legend>
        <label><input type="radio" name="hiring" value="1" <?= $department['hiring'] ? 'checked' : '' ?>> Yes</label><br>
        <label><input type="radio" name="hiring" value="0" <?= !$department['hiring'] ? 'checked' : '' ?>> No</label>
    </fieldset><br><br>

    <fieldset style="display:inline-block; text-align:left;">
        <legend>Work Mode</legend>
        <label><input type="radio" name="work_mode" value="onsite" <?= $department['work_mode']=='onsite'?'checked':'' ?>> Onsite</label><br>
        <label><input type="radio" name="work_mode" value="hybrid" <?= $department['work_mode']=='hybrid'?'checked':'' ?>> Hybrid</label><br>
        <label><input type="radio" name="work_mode" value="remote" <?= $department['work_mode']=='remote'?'checked':'' ?>> Remote</label>
    </fieldset><br><br>

    <button type="submit">Aktualisieren</button><br><br>
    <a href="deptread.php">Zurück zur Übersicht</a>
</form>
</body>
</html>
