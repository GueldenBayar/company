<?php
// Verbindung zur Datenbank aufbauen
$host = '10.101.105.110';
$dbname = 'mycompany';
$username = 'codingstorm';
$password = 'passwort';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbindung fehlgeschlagen: " . $e->getMessage());
}

// Wenn "delete_id" übergeben wurde → Mitarbeiter löschen
if (isset($_GET['delete_id'])) {
    $id = (int)$_GET['delete_id'];

    // Mitarbeiter löschen
    $stmt = $conn->prepare("DELETE FROM employee WHERE id = :id");
    $stmt->execute([':id' => $id]);

    // IDs neu nummerieren
    $conn->exec("SET @count = 0;");
    $conn->exec("UPDATE employee SET id = (@count := @count + 1) ORDER BY id;");
    $conn->exec("ALTER TABLE employee AUTO_INCREMENT = 1;");

    echo "<p style='color:red; text-align:center;'>Mitarbeiter mit ID $id wurde gelöscht.</p>";
}

// Alle Mitarbeiter abrufen
$sql = "SELECT * FROM employee";
$stmt = $conn->prepare($sql);
$stmt->execute();

//PDO::FETCH_ASSOC -->gib als assoziiatives array zurück
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Employee Daten</title>
    <style>
        table {
            border-collapse: collapse;
            margin: 20px auto;
            width: 80%;
            font-family: Arial, sans-serif;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: lightgray;
        }
        /* Abwechselnde Farben */
        tr:nth-child(even) {
            background-color: lightpink;
        }
        tr:nth-child(odd) {
            background-color: lightblue;
        }
        tr:hover {
            background-color: #ccc;
        }
    </style>
</head>
<body>
<h1 style="text-align:center;">Employee Daten</h1>

<?php if (count($rows) > 0): ?>
    <table>
        <tr>
            <?php foreach (array_keys($rows[0]) as $colName): ?>
                <th><?= htmlspecialchars($colName) ?></th>
            <?php endforeach; ?>
            <th>Aktion</th>
        </tr>

        <?php foreach ($rows as $row): ?>
            <tr>
                <?php foreach ($row as $value): ?>
                    <td><?= htmlspecialchars($value) ?></td>
                <?php endforeach; ?>
                <td>
                    <a href="?delete_id=<?= urlencode($row['id']) ?>"
                       onclick="return confirm('Willst du diesen Mitarbeiter wirklich löschen?');">
                        Delete
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p style="text-align:center;">Keine Daten gefunden.</p>
<?php endif; ?>

</body>
</html>
