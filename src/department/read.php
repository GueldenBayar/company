<?php
require_once __DIR__ . '/../db/database.php';


$base = $base ?? rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
$departments = findAll();

require_once __DIR__ . '/../../view/department/read.php';
?>
