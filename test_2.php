<?php
    require_once "action/db.php";
    $db = new Dbase();

    $db->query("CALL p(5)");

    $result = $db->query("SELECT Name FROM users");

    
?>
