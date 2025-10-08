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
        $color = $i % 2 === 0 ? 'lightblue' : 'lightpink';
        $html .= "<tr style='background-color:$color'>";
        foreach ($row as $value) {
            $html .= "<td>$value</td>";
        }
        $id = $row['id'];
        $html .= "<td>
            <a href='firstupdate.php?id=$id'>Update</a> |
            <a href='firstdelete.php?id=$id' onclick='return confirm(\"Wirklich löschen?\")'>Delete</a>
        </td></tr>";
    }
    return $html . "</table>";
}

$conn = new PDO('mysql:host=localhost;dbname=company;charset=utf8mb4', 'phpstorm', '123456');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare('SELECT * FROM employees ORDER BY id');
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="de">
<head><meta charset="UTF-8"><title>Mitarbeiterliste</title></head>
<body>
<h1 style="text-align:center;">Mitarbeiter</h1>
<p style="text-align:center;"><a href="firstcreate.php">➕ Neuen Mitarbeiter hinzufügen</a></p>
<?= $data ? createTable($data) : "<p style='text-align:center;'>Keine Mitarbeiter gefunden.</p>" ?>
</body>
</html>
