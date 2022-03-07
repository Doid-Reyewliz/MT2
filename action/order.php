<?php
session_start();
require_once "db.php";
$db = new Dbase();

$user_id = $_SESSION['id'];

$sel = $db->sql("SELECT * FROM basket WHERE user_id = \"$user_id\"");

if(mysqli_num_rows($sel) > 0){
    while($row = mysqli_fetch_assoc($sel)){
        $product_ = $row['product_id'];
        $number = $row['number'];

        $sql = $db->sql("INSERT INTO orders (`order_id`, `user_id`, `product_id`, `number`, `date`, `time`, `status`) VALUES ('', '$user_id', '$product_id', '$number', CURRENT_DATE(), CURRENT_TIME(), 'In Process')");
    }
}
$del = $db->sql("DELETE FROM `basket` WHERE user_id = \"$user_id\"");
header("Location:../Bag.php?stat=Succses");

?>