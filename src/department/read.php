<?php
require_once __DIR__ . '/../db/database.php';
$pdo = dbcon();
$base = $base ?? rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

$rows = $pdo->query('SELECT * FROM department ORDER BY id')->fetchAll();
?>
<!doctype html>
<html lang="de">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300..700&display=swap" rel="stylesheet">
    <meta charset="utf-8"><title>Abteilungen</title></head>

<style>

    .fira-code-uni {
                    font-family: "Fira Code", monospace;
                    font-optical-sizing: auto;
                    font-weight: 300;
                    font-style: normal;
                }

    body {
        font-family: "Fira Code";
    }

    tr:hover {
        background-color: #f0f0f0;
    }
</style>
<body>
<h1>Abteilungen</h1>
<p><a href="<?= htmlspecialchars($base . '/department/create') ?>">➕ Neue Abteilung</a></p>

<?php if (count($rows) === 0): ?>
    <p>Keine Abteilungen vorhanden.</p>
<?php else: ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Hiring</th>
            <th>Work Mode</th>
        </tr>
        <?php foreach ($rows as $r): ?>
            <?php ?>
            <tr style="cursor: pointer;" onclick="window.location.href='<?= htmlspecialchars($base . '/department/view/' . $r['id']) ?>'">
                <td><?= htmlspecialchars($r['id']) ?></td>
                <td><?= htmlspecialchars($r['department_name']) ?></td>
                <td><?= $r['hiring'] ? '✅ Yes' : '❌ No' ?></td>
                <td><?= htmlspecialchars($r['work_mode']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
</body>
</html>

