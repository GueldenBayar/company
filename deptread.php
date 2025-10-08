<?php
function createTable(array $data): string
{
    $html = "<table border='1' style='border-collapse: collapse; margin:auto;'>";
    $html .= "<tr style='background-color:lightgray;'>";
    foreach ($data[0] as $key => $value) {
        $html .= "<th>$key</th>";
    }
    $html .= "<th>Aktion</th></tr>";

    foreach ($data as $i => $row) {
        $color = $i % 2 === 0 ? 'lightgreen' : 'lightyellow';
        $html .= "<tr style='background-color:$color'>";
        foreach ($row as $value) {
            $html .= "<td>$value</td>";
        }
        $id = $row['id'];
        $html .= "<td>
            <a href='deptupdate.php?id=$id'>Update</a> |
            <a href='deptdelete.php?id=$id' onclick='return confirm(\"Wirklich löschen?\")'>Delete</a>
        </td></tr>";
    }
    return $html . "</table>";
}

$conn = new PDO('mysql:host=localhost;dbname=mycompany;charset=utf8mb4', 'codingstorm', 'passwort');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare('SELECT * FROM department ORDER BY id');
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="de">
<head><meta charset="UTF-8"><title>Abteilungsliste💘💘</title></head>
<body>
<h1 style="text-align:center;">Abteilungen🦄🌈</h1>
<p style="text-align:center;"><a href="deptcreate.php">🌞 Neue Abteilung hinzufügen</a></p>
<?= $data ? createTable($data) : "<p style='text-align:center;'>Keine Abteilungen gefunden.</p>" ?>
</body>
</html>

