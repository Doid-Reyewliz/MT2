<?php
session_start();
if($_SESSION['role'] == 4) header("Location:../Products.php");

else if(isset($_POST['product_id'])){
    require_once "db.php";
    $db = new Dbase();

    $count = 1;

    $user_id = $_SESSION['id'];
    $product_id = $_POST['product_id'];
    $size = $_POST['size'];

    $check = $db->sql("SELECT * FROM basket WHERE user_id = '$user_id' AND product_id = '$product_id'");

    if(mysqli_num_rows($check) > 0){
        while($row = mysqli_fetch_assoc($check)){
            $count += $row['number'];
        }

        $db->sql("UPDATE basket SET number = $count WHERE user_id = '$user_id' AND product_id = '$product_id'");
    }
    else{
        $db->sql("INSERT INTO basket(`user_id`, `product_id`, `size`, `number`) VALUES ('$user_id', '$product_id', '$size', '$count')");
    }
    header("Location:../Products.php");
}

else if (isset($_POST['quant'])){
    require_once "db.php";
    $db = new Dbase();

    $user_id = $_SESSION['id'];
    $product_id = $_POST['p_id'];
    $size = $_POST['size'];
    $quant = $_POST['quant'];

    $db->sql("UPDATE basket SET number = $quant WHERE product_id = '$product_id' AND user_id = '$user_id' AND size = '$size'");
}

?>