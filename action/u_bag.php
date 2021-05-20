<?php
session_start();
require_once "db.php";

$db = new Dbase();

$mail = $_SESSION['mail'];
$num = $_POST['num'];
$code = $_POST['code'];

$sql = $db->sql("UPDATE `basket` SET `number`='$num' WHERE user_mail = '$mail' AND product_code = '$code'");
?>