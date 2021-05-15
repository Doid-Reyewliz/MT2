<?php
session_start();
require_once "db.php";
$db = new Dbase();

if(isset($_POST['select'])){
    $name = $_POST['select'];

    $sql = $db->query("SELECT * FROM products WHERE Name = '$name'");

    foreach($sql as $row){
        $image = "image/$row[Image]";
    }
    echo $image;
}
elseif(isset($_POST['text'], $_POST['artext'])){
    $text = $_POST['text'];
    $artext = $_POST['artext'];
    $mail = $_SESSION['mail'];

    $sql = $db->sql("INSERT INTO `feedback`(`id`, `user`, `product_name`, `text`) VALUES ('','$mail','$text','$artext')");
}

?>