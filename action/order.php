<?php
if(isset($_POST['code'])){
    session_start();
    require_once "db.php";
    $db = new Dbase();

    $code = $_POST['code'];
    $user_mail = $_SESSION['mail'];

    $sql = $db->sql("INSERT INTO `orders`(`id`, `user_mail`, `product_code`, `number`, `date`, `time`, `status`) VALUES ('', $user_mail, $code, 1, CURRENT_DATE(), CURRENT_TIME(), 'In Processing')");
    $del = $db->sql("DELETE FROM basket WHERE user_mail = $user_mail AND product_code = $code");

    exit;
}
?>