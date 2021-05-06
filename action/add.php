<?php

if(isset($_POST['name'], $_POST['catg'], $_POST['price'], $_POST['code'])){
    require_once "db.php";
    $db = new Dbase();

    $name = $_POST['name'];
    $catg = $_POST['catg'];
    $price = $_POST['price'];
    $code = $_POST['code'];
    $image = $_FILES['image']['name'];

    move_uploaded_file($_FILES['image']['tmp_name'], '../image/' . $_FILES['image']['name']);
    $sql =  $db->sql("INSERT INTO `products`(`id`, `Name`, `Image`, `Category`, `Price`, `Code`) VALUES ('','$name','$image','$catg','$price','$code')");
    header("Location: Mod.php");
}
else{
    header("Location: Mod.php?error=One or More fields are empty");
}
