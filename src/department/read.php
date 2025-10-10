<?php
require_once __DIR__ . '/../db/database.php';
$pdo = getConnection();
$base = $base ?? rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

$rows = $pdo->query('SELECT * FROM department ORDER BY id')->fetchAll();
?>
<!doctype html>
<html lang="de">
<head><meta charset="utf-8"><title>Abteilungen</title></head>
<style>
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
            <th>Aktion</th>
        </tr>
        <?php foreach ($rows as $r): ?>
            <tr>
                <td><?= htmlspecialchars($r['id']) ?></td>
                <td><?= htmlspecialchars($r['department_name']) ?></td>
                <td><?= $r['hiring'] ? '✅ Yes' : '❌ No' ?></td>
                <td><?= htmlspecialchars($r['work_mode']) ?></td>
                <td>
                    <a href="<?= htmlspecialchars($base . '/department/update/' . $r['id']) ?>">✏️ Bearbeiten</a> |
                    <a href="<?= htmlspecialchars($base . '/department/delete/' . $r['id']) ?>" onclick="return confirm('Wirklich löschen?')">🗑️ Löschen</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
</body>
</html>

