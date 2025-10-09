<?php
$conn = new PDO('mysql:host=localhost;dbname=mycompany;charset=utf8mb4', 'codingstorm', 'passwort');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare('INSERT INTO department (department_name, hiring, work_mode) VALUES (:department_name, :hiring, :work_mode)');
    $hiring = $_POST['hiring'] === '1' ? 1 : 0;
    $stmt->bindParam(':department_name', $_POST['department_name'], PDO::PARAM_STR);
    $stmt->bindParam(':hiring', $hiring, PDO::PARAM_BOOL);
    $stmt->bindParam(':work_mode', $_POST['work_mode'], PDO::PARAM_STR);
    $stmt->execute();
    header('Location: deptread.php');
    exit;
}
?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Neue Abteilung hinzufügen</title>
</head>
<body>
<h1 style="text-align:center;">Neue Abteilung hinzufügen</h1>

<form method="post" style="text-align:center;">
    <label>Name: <input type="text" name="department_name" required></label><br><br>

    <fieldset style="display:inline-block; text-align:left;">
        <legend>Hiring?</legend>
        <label><input type="radio" name="hiring" value="1" checked> Yes</label><br>
        <label><input type="radio" name="hiring" value="0"> No</label>
    </fieldset><br><br>

    <fieldset style="display:inline-block; text-align:left;">
        <legend>Work Mode</legend>
        <label><input type="radio" name="work_mode" value="onsite" checked> Onsite</label><br>
        <label><input type="radio" name="work_mode" value="hybrid"> Hybrid</label><br>
        <label><input type="radio" name="work_mode" value="remote"> Remote</label>
    </fieldset><br><br>

    <button type="submit">Speichern</button><br><br>
    <a href="deptread.php">Zurück zur Übersicht</a>
</form>
</body>
</html>

