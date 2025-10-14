<?php

$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

// DB initialisieren und Daten abfragen
$data = [];       // Default, damit $data immer existiert
$dbError = null;

try {
    $conn = new PDO('mysql:host=localhost;dbname=mycompany;charset=utf8mb4', 'codingstorm', 'passwort');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare('SELECT * FROM employees ORDER BY id');
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // DB-Fehler auffangen, Seite nicht abbrechen
    $dbError = $e->getMessage();
    $data = []; // sicherheitshalber leer lassen
}

// Funktion zur Erstellung der Tabelle
function createEmployeeTable(array $data, string $base): string
{
    $html = "<table border='1' style='border-collapse: collapse; margin:auto;'>";
    $html .= "<tr style='background-color:lightgray;'>
                <th>ID</th>
                <th>💘 Vorname</th>
                <th>🌷 Nachname</th>
              </tr>";

    foreach ($data as $i => $row) {
        $color = $i % 2 === 0 ? 'lightblue' : 'lightpink';
        $id = htmlspecialchars($row['id']);
        $fname = htmlspecialchars($row['fname']);
        $lname = htmlspecialchars($row['lname']);

        $viewUrl = "{$base}/employee/view/{$id}";
        $html .= "<tr style='background-color:$color; cursor: pointer;' onclick=\"window.location.href='{$viewUrl}'\">";
        $html .= "<td>🌈{$id}</td>";
        $html .= "<td>🌴{$fname}</td>";
        $html .= "<td>🐩{$lname}</td>";
        $html .= "</tr>";
    }

    $html .= "</table>";
    return $html;
}
?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>💘 Mitarbeiterliste 🌷</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300..700&display=swap" rel="stylesheet">
    <style>
        body { font-family: "Fira Code", sans-serif;}
        td { font-size: 20px; font-family: "Fira Code", sans-serif; }
        th { font-size: 25px; font-family: "Fira Code", sans-serif; color: darkmagenta; }
        a { text-decoration: none; color: blue;}
        tr:hover { background-color: #f0f0f0 !important;}

        .fira-code-uni {
                        font-family: "Fira Code", monospace;
                        font-optical-sizing: auto;
                        font-weight: 300;
                        font-style: normal;
                    }
    </style>
</head>
<body>
<h1 style="text-align:center;font-size:40px;">🦄 Mitarbeiter 🌈</h1>
<p style="text-align:center;font-size:30px;font-weight:bold;">
    <a href="<?php echo $base; ?>/employee/create">🐒 Neuen Mitarbeiter hinzufügen</a>
</p>

<div style="text-align:center;">
    <?php
    // DB-Fehler anzeigen (nur während Entwicklung)
    if ($dbError) {
        echo '<p style="color:red;">Datenbankfehler: ' . htmlspecialchars($dbError) . '</p>';
    }

    // Tabelle oder Hinweis ausgeben (keine Undefined-Variable mehr)
    if (!empty($data)) {
        echo createEmployeeTable($data, $base);
    } else {
        echo "<p>😿 Keine Mitarbeiter gefunden.</p>";
    }
    ?>
</div>
</body>
</html>


