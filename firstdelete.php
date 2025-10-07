<?php
#--------------------------hier kommt ein delete button

$conn = new PDO('mysql:host=localhost;dbname=mycompany', 'codingstorm', 'passwort');
$sql = 'DELETE FROM employee where id= :id';
$id = $_GET['id']