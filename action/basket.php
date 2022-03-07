<?php
session_start();
if($_SESSION['role'] == 4) header("Location:../Products.php");

elseif(isset($_POST['id'])){
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

        $sql = $db->sql("UPDATE basket SET number = $count WHERE user_id = '$user_id' AND product_id = '$product_id'");
    }
    else{
        $sql = $db->sql("INSERT INTO basket(`basket_id`, `user_id`, `product_id`, `size`, `number`) VALUES ('', '$user_id', '$product_id', '$size', '$count')");
    }
    header("Location:../Products.php");
}

?>