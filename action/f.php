<?php
include "dbase.php";

$log = $_POST['log'];
$quest = $_POST['quest'];
$ans = $_POST['ans'];

if(empty($log)){
    header("Location:forg.php?error=Email is empty");
}
elseif(empty($quest)){
    header("Location:forg.php?error=Question is empty");
}
elseif(empty($ans)){
    header("Location:forg.php?error=Answer is empty");
}
else{
    $get = "SELECT * FROM sign_up WHERE Login = '$log' AND Question = '$quest' AND Answer = '$ans'";
    $result = mysqli_query($con, $get);
    $row = mysqli_fetch_assoc($result);

    if (($row['Login'] != $log) or ($row['Question'] != $quest) or ($row['Answer'] != $ans)){
        header("Location:forg.php?error=Please check that the fields are correct");
    }
    else{
        update();
    }
}

function update(){
    global $con, $log, $quest, $ans;
    $pass = $_POST['pass'];
    $rpass = $_POST['rpass'];

    if(strlen($pass) < 6){
        header("Location:reg.php?error=The length of password must be greater than 5");
    }
    elseif($pass != $rpass){
        header("Location:forg.php?error=Passwords must be the same");
    }
    elseif(!empty($pass)){
        $set = "UPDATE `sign_up` SET `Password`='$pass' WHERE Login = '$log' AND Question = '$quest' AND Answer = '$ans'";
        if (mysqli_query($con, $set) == true){
            header("Location: index.php?error= Password updated");
        }
    }
    else{
        header("Location:forg.php?error=Password is empty");
    }
}

?>
