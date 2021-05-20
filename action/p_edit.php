<?php
require_once "db.php";
$db = new Dbase();

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];

$sql = $db->sql("UPDATE `products` SET `Name`='$name',`Price`='$price' WHERE id = '$id'");
header("Location:../Mod.php");

?>