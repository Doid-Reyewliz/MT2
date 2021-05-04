<?php

session_start();
require_once "action/db.php";;
$db = new Dbase();
if(!empty($_GET["action"])){
    switch($_GET["action"]){
        case "add":
            $code = $db->query("SELECT * FROM course WHERE code = '" . $_GET["code"] . "'");
        break;

        case "remove":
            if(!empty($_SESSION["bag_item"])){
                foreach($_SESSION["bag_item"] as $k => $v){
                    if($_GET["code"] == $k) unset($_SESSION["bag_item"]);
                    if(empty($_SESSION["bag_item"])) unset($_SESSION["bag_item"]);
                }
            }
        break;

        case "empty":
            unset($_SESSION["bag_item"]);
        break;
    }
}
