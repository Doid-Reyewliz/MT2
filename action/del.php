<?php
require_once "db.php";
$db = new Dbase();

if(isset($_POST['code'])){
    $code = $_POST['code'];

    $u_c = $db->sql("DELETE FROM `basket` WHERE product_id = '$product_id'");
    $sql = $db->sql("DELETE FROM `products` WHERE product_id = '$product_id'");
    header("Location:../Admin.php");
}

if(isset($_POST['user_id'])){
    $user_id = $_POST['user_id'];

    echo $user_id;

    $db->sql("CALL delete_user('$user_id')");
}

if(isset($_POST['f_u'], $_POST['f_n'])){
    $u_id = $_POST['u_id'];
    $p_id = $_POST['p_id'];

    $sql = $db->query("UPDATE orders SET comment='' WHERE user_id = '$u_id' AND product_id='$p_id'");
}

if(isset($_POST['product_id'])){
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id'];

    $sql = $db->sql("DELETE FROM basket WHERE user_id= '$user_id' AND product_id='$product_id'");
}
?>