<!doctype html>
<html lang="de">
<head><meta charset="utf-8"><title>Abteilung erstellen</title></head>
<body>
<h1>Neue Abteilung erstellen</h1>

<form method="post">
    <label>Name: <input type="text" name="department_name" required></label><br><br>

    <fieldset>
        <legend>Hiring?</legend>
        <label><input type="radio" name="hiring" value="1" checked> Yes</label>
        <label><input type="radio" name="hiring" value="0"> No</label>
    </fieldset><br>

    <fieldset>
        <legend>Work Mode</legend>
        <label><input type="radio" name="work_mode" value="onsite" checked> Onsite</label>
        <label><input type="radio" name="work_mode" value="hybrid"> Hybrid</label>
        <label><input type="radio" name="work_mode" value="remote"> Remote</label>
    </fieldset><br>

    <button type="submit">Speichern</button>
</form>

<p><a href="<?= htmlspecialchars($base) ?>/department/read">Zurück</a></p>
</body>
</html>