<?php
require_once "db.php";

$db = new Dbase();

$log = $_POST['log'];
$quest = $_POST['quest'];
$ans = $_POST['ans'];

if(empty($log)){
    header("Location:Forgot.php?error=Email is empty");
}
elseif(empty($quest)){
    header("Location:Forgot.php?error=Question is empty");
}
elseif(empty($ans)){
    header("Location:Forgot.php?error=Answer is empty");
}
else{
    $get = $db->query("SELECT * FROM users WHERE Login = '$log' AND Question = '$quest' AND Answer = '$ans'");

    foreach($get as $key => $value){

        if (($get[$key]['Login'] != $log) or ($get[$key]['Question'] != $quest) or ($get[$key]['Answer'] != $ans)){
            header("Location:Forgot.php?error=Please check that the fields are correct");
        }
        else{
            update();
        }
    }
}

function update(){
    global $log, $quest, $ans, $db;
    $pass = $_POST['pass'];
    $rpass = $_POST['rpass'];

    if(strlen($pass) < 6){
        header("Location:Forgot.php?error=The length of password must be greater than 5");
    }
    elseif($pass != $rpass){
        header("Location:Forgot.php?error=Passwords must be the same");
    }
    elseif(!empty($pass)){
        $set = $db->sql("UPDATE users SET `Password`='$pass' WHERE Login = '$log' AND Question = '$quest' AND Answer = '$ans'");
        header("Location: index.php?error= Password updated");
    }
    else{
        header("Location:Forgot.php?error=Password is empty");
    }
}

?>
