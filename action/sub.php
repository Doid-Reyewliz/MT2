<?php
if((isset($_POST['code']) and isset($_POST['mail']))){
    require_once "action/db.php";;
    $db = new Dbase();
    
    $u_email = $_POST['mail'];
    $c_code = $_POST['code'];

    $select = $db->sql("SELECT * FROM user_course WHERE user_mail = '$u_email' AND course_code = '$c_code'");
    
    if(mysqli_num_rows($select) == 0){
        $sql = $db->sql("INSERT INTO `user_course`(`id`, `user_mail`, `course_code`) VALUES ('', '$u_email', '$c_code')");
        header("Location: Market.php");
    }
    else{
        header("Location:Market.php?error=You're already subscribed!!!");
    }
}
