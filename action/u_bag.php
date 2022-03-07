<?php
session_start();
require_once "db.php";

$db = new Dbase();

$user_id = $_SESSION['id'];
$num = $_POST['num'];
$product_id = $_POST['product_id'];

$sql = $db->sql("UPDATE `basket` SET `number`='$num' WHERE user_id = '$user_id' AND product_id = '$product_id'");
?>