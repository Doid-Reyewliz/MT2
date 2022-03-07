<?php
session_start();
require_once "db.php";
$db = new Dbase();

if (isset($_POST['select'])) {
    $id = $_POST['select'];

    $sql = $db->query("SELECT * FROM products WHERE product_id = '$id'");

    foreach ($sql as $row) {
        $image = "image/$row[Image]";
    }
    echo $image;
} elseif (isset($_POST['text'], $_POST['artext'])) {
    $product_id = $_POST['text'];
    $text = $_POST['artext'];
    $user_id = $_SESSION['id'];

    $upd = $db->sql("UPDATE `orders` SET `comment`='$text' WHERE `user_id` = '$user_id' AND `product_id` = '$product_id'");

    if ($upd === TRUE) {
        echo ("Your feedback was added!!!");
    } else {
        echo ("You don't have order to this product");
    }
}
