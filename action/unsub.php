<?php

if((isset($_POST['code']) and isset($_POST['mail']))){
    require_once "action/db.php";;

    $u_email = $_POST['mail'];
    $c_code = $_POST['code'];

    $db = new Dbase();
    $sql =  $db->sql("DELETE FROM `user_course` WHERE user_mail = '$u_email' AND course_code = '$c_code'");
    header("Location: MyC.php");
}
