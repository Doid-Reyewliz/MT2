<?php
if(isset($_POST['code'])){
    session_start();
    require_once "db.php";
    $db = new Dbase();

    $count = 1;

    $user_mail = $_SESSION['mail'];
    $code = $_POST['code'];

    $check = $db->sql("SELECT * FROM basket WHERE user_mail = '$user_mail' AND product_code = '$code'");

    if(mysqli_num_rows($check) > 0){
        while($row = mysqli_fetch_assoc($check)){
            $count += $row['number'];
        }

        $sql = $db->sql("UPDATE basket SET number = $count WHERE user_mail = '$user_mail' AND product_code = '$code'");
    }
    else{
        $sql = $db->sql("INSERT INTO basket(`id`, `user_mail`, `product_code`, `number`) VALUES ('', '$user_mail', '$code', '$count')");
    }
    header("Location:../Products.php");
}
?>