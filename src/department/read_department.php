<?php
function createTable(array $data): string
{
    $html = "<table border='1' style='border-collapse: collapse; margin:auto;'>";
    $html .= "<tr style='background-color:lightgray;'>";
    $html .= "<th>ID</th><th>Abteilungsname</th><th>Hiring?</th><th>Work Mode</th><th>Aktion</th></tr>";

    foreach ($data as $i => $row) {
        $color = $i % 2 === 0 ? 'lightgreen' : 'lightyellow';
        $html .= "<tr style='background-color:$color'>";
        $id = htmlspecialchars($row['id']);
        $dept = htmlspecialchars($row['department_name'] ?? '');

        // Hiring anzeigen als ✅ / ❌
        if (isset($row['hiring']) && $row['hiring']) {
            $hiring = '✅ Yes';
        } else {
            $hiring = '❌ No';
        }


        // Work mode hübsch mit Symbol
        $wm = $row['work_mode'] ?? '';
        if ($wm === 'onsite') {
            $work_mode = '🏢 Onsite';
        } elseif ($wm === 'hybrid') {
            $work_mode = '🌈 Hybrid';
        } elseif ($wm === 'remote') {
            $work_mode = '🏠 Remote';
        } else {
            $work_mode = htmlspecialchars($wm);
        }

        // Zeileninhalt
        $html .= "
            <td>$id</td>
            <td>$dept</td>
            <td>$hiring</td>
            <td>$work_mode</td>
            <td>
                <a href='deptupdate.php?id=$id'>Update</a> |
                <a href='deptdelete.php?id=$id' onclick='return confirm(\"Wirklich löschen?\")'>Delete</a>
            </td>
        </tr>";
    }

    return $html . "</table>";
}

// Verbindung zur DB 💖
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
<p style="text-align:center;"><a href="create_department.php">🌞 Neue Abteilung hinzufügen</a></p>
<?= $data ? createTable($data) : "<p style='text-align:center;'>Keine Abteilungen gefunden.</p>" ?>
</body>
</html>
