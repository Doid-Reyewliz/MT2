<?php

if((isset($_POST['name']) && isset($_POST['catg']) && isset($_POST['price']) && !empty($_POST['code']))){
    require_once "db.php";
    $db = new Dbase();
    
    $name = $_POST['name'];
    $catg = $_POST['catg'];
    $price = $_POST['price'];
    $num = $_POST['number'];
    $code = $_POST['code'];

    $sql =  $db->sql("INSERT INTO `products`(`id`, `Name`, `Image`, `Category`, `Price`, `Quantity`, `Code`) VALUES ('','$name','$image','$catg','$price','$num','$code')");
    header("Location: Mod.php");
    
}
else{
    header("Location: Mod.php?error=One or More fields are empty");
}
