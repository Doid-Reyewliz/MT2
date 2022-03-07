<?php
    require_once "action/db.php";
    $db = new Dbase();

    $db->query
    ("CREATE FUNCTION select_q(
        filt VARCHAR(20))
        BEGIN 
            SELECT * FROM products WHERE Gender = filt OR Category = filt;
        END
    ");
?>