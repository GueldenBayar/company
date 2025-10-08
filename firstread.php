<?php
function createTable(array $data): string
{
    $html = "<table border='1' style='border-collapse: collapse; margin:auto;'>";
    $html .= "<tr style='background-color:lightgray;'><th>id</th><th>💘Vorname</th><th>🌷Nachname</th><th>Aktion</th></tr>";

    foreach ($data as $i => $row) {
        $color = $i % 2 === 0 ? 'lightblue' : 'lightpink';
        $html .= "<tr🐈 style='background-color:$color'>";
        $html .= "<td>🌈{$row['id']}</td>";
        $html .= "<td>🌴{$row['fname']}</td>";
        $html .= "<td>🐩{$row['lname']}</td>";
        $id = $row['id'];
        $html .= "<td>
            <a href='firstupdate.php?id=$id'>💫Update</a> |
            <a href='firstdelete.php?id=$id' onclick='return confirm(\"Wirklich löschen?\")'>☠️Delete</a>
        </td></tr>";
    }
    return $html . "</table>";
}

$conn = new PDO('mysql:host=localhost;dbname=mycompany;charset=utf8mb4', 'codingstorm', 'passwort');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare('SELECT * FROM employees ORDER BY id');
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="de">
<head><meta charset="UTF-8"><title>💘Mitarbeiterliste🌷</title></head>
<style>
    td {
        font-size: 20px;
        font-family: Arial, sans-serif;
    }

    th {
        font-size: 25px;
        font-family: arial, sans-serif;
        color: darkmagenta;
    }

    a {
        text-decoration: none;
    }

    h1, p {
        font-family: Arial, sans-serif;
    }
</style>
<body>
<h1 style="text-align:center;font-size: 40px;">🦄Mitarbeiter🌈</h1>
<p style="text-align:center;font-size: 30px; font-weight: bold"><a href="firstcreate.php">🐒 Neuen Mitarbeiter hinzufügen🍌</a></p>
<?= $data ? createTable($data) : "<p style='text-align:center;'>😿Keine Mitarbeiter gefunden.</p>" ?>
</body>
</html>

