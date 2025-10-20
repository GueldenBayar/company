<!doctype html>
<html lang="de">
<head><meta charset="utf-8"><title>Abteilung bearbeiten</title></head>
<body>
<h1>Abteilung bearbeiten</h1>

<form method="post">
    <label>Name: <input type="text" name="department_name" value="<?= htmlspecialchars($dep['department_name']) ?>" required></label><br><br>

    <fieldset>
        <legend>Hiring?</legend>
        <label><input type="radio" name="hiring" value="1" <?= $dep['hiring'] ? 'checked' : '' ?>> Yes</label>
        <label><input type="radio" name="hiring" value="0" <?= !$dep['hiring'] ? 'checked' : '' ?>> No</label>
    </fieldset><br>

    <fieldset>
        <legend>Work Mode</legend>
        <label><input type="radio" name="work_mode" value="onsite" <?= $dep['work_mode']==='onsite' ? 'checked' : '' ?>> Onsite</label>
        <label><input type="radio" name="work_mode" value="hybrid" <?= $dep['work_mode']==='hybrid' ? 'checked' : '' ?>> Hybrid</label>
        <label><input type="radio" name="work_mode" value="remote" <?= $dep['work_mode']==='remote' ? 'checked' : '' ?>> Remote</label>
    </fieldset><br>

    <button type="submit">Speichern</button>
</form>

<p><a href="<?= htmlspecialchars($base . '/department/read') ?>">Zurück</a></p>
</body>
</html>
