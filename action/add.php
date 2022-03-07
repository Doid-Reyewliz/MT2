<?php

if(isset($_POST['name'], $_POST['catg'], $_POST['gender'], $_POST['price'], $_POST['code'])){
    require_once "db.php";
    $db = new Dbase();

    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $catg = $_POST['catg'];
    $price = $_POST['price'];
    $code = $_POST['code'];
    $image = $_FILES['image']['name'];

    move_uploaded_file($_FILES['image']['tmp_name'], '../image/' . $image);
    $sql =  $db->sql("INSERT INTO `products`(`product_id`, `Name`, `Image`, `Category`,`Gender`, `Price`, `Code`) VALUES ('','$name','$image','$catg',';gender','$price','$code')");
    header("Location: ../Mod.php");
}
else{
    header("Location: ../Mod.php?error=One or More fields are empty");
}
