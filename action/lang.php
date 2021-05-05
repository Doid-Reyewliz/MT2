<?php
$lang = "en";
if(isset($_POST["lang"])) {
    $lang = $_POST["lang"];
    setcookie ( 'language', $lang, time() + 60*60*24*30);
    header( "Location: /previous_page_url.php" );
}
?>