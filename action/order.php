<?php
session_start();
require_once "db.php";
$db = new Dbase();

$user_mail = $_SESSION['mail'];

$sel = $db->sql("SELECT * FROM basket WHERE user_mail = \"$user_mail\"");

if(mysqli_num_rows($sel) > 0){
    while($row = mysqli_fetch_assoc($sel)){
        $code = $row['product_code'];
        $number = $row['number'];

        $sql = $db->sql("INSERT INTO orders (`id`, `user_mail`, `product_code`, `number`, `date`, `time`, `status`) VALUES ('', '$user_mail', '$code', '$number', CURRENT_DATE(), CURRENT_TIME(), 'In Process')");
    }
}
$del = $db->sql("DELETE FROM `basket` WHERE user_mail = \"$user_mail\"");
header("Location:../Bag.php?stat=Succses");

?>