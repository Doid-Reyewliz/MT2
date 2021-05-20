<?php
session_start();
if($_SESSION['role'] == 4) header("Location:../Products.php");

elseif(isset($_POST['code'])){
    require_once "db.php";
    $db = new Dbase();

    $count = 1;

    $user_mail = $_SESSION['mail'];
    $code = $_POST['code'];
    $size = $_POST['size'];

    $check = $db->sql("SELECT * FROM basket WHERE user_mail = '$user_mail' AND product_code = '$code'");

    if(mysqli_num_rows($check) > 0){
        while($row = mysqli_fetch_assoc($check)){
            $count += $row['number'];
        }

        $sql = $db->sql("UPDATE basket SET number = $count WHERE user_mail = '$user_mail' AND product_code = '$code'");
    }
    else{
        $sql = $db->sql("INSERT INTO basket(`id`, `user_mail`, `product_code`, `size`, `number`) VALUES ('', '$user_mail', '$code', '$size', '$count')");
    }
    header("Location:../Products.php");
}

?>