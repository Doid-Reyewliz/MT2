<?php
session_start();
if($_SESSION['role'] == 3){
    if(isset($_POST['admin'])){
        $_SESSION['role'] = 3;
        header("Location: Admin.php");
    }
    if(isset($_POST['mod'])){
        $_SESSION['role'] = 2;
        header("Location: Mod.php");
    }
    if(isset($_POST['user'])){
        $_SESSION['role'] = 1;
        header("Location: Home.php");
    }
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Sign In</title>
        <link rel="stylesheet" type="text/css" href="sign.css">
        <link rel="shortcut icon" href="https://img.icons8.com/fluent/48/000000/enter-2.png"/>
    </head>

    <body>
        <section>
            <div class="box">
                <div class="square" style="--i:0;"></div>
                <div class="square" style="--i:1;"></div>
                <div class="square" style="--i:2;"></div>
                <div class="square" style="--i:3;"></div>
                <div class="square" style="--i:4;"></div>
                <div class="container">
                    <div class="choose">
                        <form action="" method="POST">
                            <button name='admin'>As Admin</button>
                            <button name='mod'>As Moderator</button>
                            <button name='user'>As User</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
    </html>
    <?php
}
else header("Location:index.php");
?>