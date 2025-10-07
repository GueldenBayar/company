<?php
// Verbindung zur Datenbank
$conn = new PDO('mysql:host=10.101.105.110;dbname=mycompany', 'codingstorm', 'passwort');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Wenn Formular abgeschickt wurde
if (isset($_POST['firstname']) && isset($_POST['lastname'])) {
    $stmt = $conn->prepare("INSERT INTO employee (fname, lname) VALUES (:fname, :lname)");
    $stmt->execute([
        ':fname' => $_POST['firstname'], #$stmt = bindParam(':fname', $fname); $stmt = bindParam(':lname', $lname);
        ':lname' => $_POST['lastname']
    ]);
    echo "<p style='color:green;'>New Employee successfully added!</p>";
}
//echo "<pre>";
//if($_SERVER["REQUEST_METHOD"] === 'GET'){

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Employee</title>
</head>
<body>
<h1>Neuen Employee hinzufügen</h1>
<form action="" method="post">
    <input type="text" name="firstname" placeholder="Vorname" required>
    <input type="text" name="lastname" placeholder="Nachname" required>
    <button type="submit">Absenden</button>
</form>
</body>

</html>
<!---->
<!--    --><?php
//} elseif ($_SERVER["REQUEST_METHOD"] === 'POST') {
// $conn = new PDO('mysql:host=10.101.105.110;dbname=mycompany', 'codingstorm', 'passwort');
// $stmt = $conn->prepare('INSERT INTO employees (fname, lname) VALUES ');
//    echo "hier soll es in die DB";
//}
//echo "</pre>";
//?>