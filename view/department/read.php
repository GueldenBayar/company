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
<p><a href="<?= htmlspecialchars($base) ?>">➕ Neue Abteilung</a></p>


    <table border="1" cellpadding="6">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Hiring</th>
            <th>Work Mode</th>
            <th>Aktionen</th>
        </tr>
        <?php foreach ($departments as $dep): ?>
            <tr>
                <td><?= htmlspecialchars($dep['id']) ?></td>
                <td><?= htmlspecialchars($dep['department_name']) ?></td>
                <td><?= $dep['hiring'] ? '✅' : '❌' ?></td>
                <td><?= htmlspecialchars($dep['work_mode']) ?></td>
                <td>
                    <a href="<?= htmlspecialchars($base . '/department/view/' . $dep['id']) ?>">🔍</a>
                    <a href="<?= htmlspecialchars($base . '/department/update/' . $dep['id']) ?>">✏️</a>
                    <a href="<?= htmlspecialchars($base . '/department/delete/' . $dep['id']) ?>" onclick="return confirm('Wirklich löschen?')">🗑️</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
