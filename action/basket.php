<?php
if(isset($_POST['code'])){
    session_start();
    require_once "db.php";
    $db = new Dbase();

    $count = 1;

    $code = $_POST['code'];
    $user_mail = $_SESSION['mail'];

    $select = $db->sql("SELECT * FROM basket WHERE user_mail = $user_mail AND product_code = $code");

    if(mysqli_num_rows("$select") == 0){
        $sql = $db->sql("INSERT INTO `basket`(`id`, `user_mail`, `product_code`, `number`) VALUES ('', $user_mail, $code, $count");
    }
    else{
        $sql = $db->sql("UPDATE `basket` SET number = $count WHERE user_mail = $user_mail AND product_code = $code");
    }
    exit;
}
?>