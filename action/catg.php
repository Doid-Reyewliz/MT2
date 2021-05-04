<?php
require_once "db.php";
$db = new Dbase();

$cat = $_POST['catg'];

$sql = $db->sql("SELECT * FROM products WHERE Category = $cat");

?>