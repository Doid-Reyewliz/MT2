<?php

if((isset($_POST['name'], $_POST['catg'], $_POST['price'], $_FILES['file']))){
    require_once "db.php";
    $db = new Dbase();

    $name = $_POST['name'];
    $catg = $_POST['catg'];
    $price = $_POST['price'];
    $num = $_POST['number'];
    $code = $_POST['code'];
    $image = $_FILES['file']['name'];

    move_uploaded_file($_FILES['file']['tmp_name'], '../image/' . $_FILES['file']['name']);
    $sql =  $db->sql("INSERT INTO `products`(`id`, `Name`, `Image`, `Category`, `Price`, `Quantity`, `Code`) VALUES ('','$name','$image','$catg','$price','$num','$code')");
}
else{
    header("Location: Mod.php?error=One or More fields are empty");
}
