<?php
// src/employee/read.php

// Optional: Fehleranzeigen während der Entwicklung
// ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

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
                <th>Aktion</th>
              </tr>";

    foreach ($data as $i => $row) {
        $color = $i % 2 === 0 ? 'lightblue' : 'lightpink';
        $id = htmlspecialchars($row['id']);
        $fname = htmlspecialchars($row['fname']);
        $lname = htmlspecialchars($row['lname']);

        $html .= "<tr style='background-color:$color'>";
        $html .= "<td>🌈{$id}</td>";
        $html .= "<td>🌴{$fname}</td>";
        $html .= "<td>🐩{$lname}</td>";
        $html .= "<td>
                    <a href='{$base}/employee/update/{$id}'>💫Update</a> |
                    <a href='{$base}/employee/delete/{$id}' onclick=\"return confirm('Wirklich löschen?')\">☠️Delete</a>
                  </td>";
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
    <style>
        td { font-size: 20px; font-family: Arial, sans-serif; }
        th { font-size: 25px; font-family: Arial, sans-serif; color: darkmagenta; }
        a { text-decoration: none; color: blue; font-weight: bold; }
    </style>
</head>
<body>
<h1 style="text-align:center;font-size:40px;">🦄 Mitarbeiter 🌈</h1>
<p style="text-align:center;font-size:30px;font-weight:bold;">
    <a href="<?php echo $base; ?>/employee/create">🐒 Neuen Mitarbeiter hinzufügen 🍌</a>
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


