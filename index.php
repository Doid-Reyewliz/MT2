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
                <div class="form">
                    <h2>Login</h2>
                    <form action="action/lg.php" method="POST">
                        <?php if (isset($_GET['error'])) { ?>
                            <span class="error"><?php echo $_GET['error']; ?></span>
                        <?php }
                        if (isset($_GET['cor'])) { ?>
                            <span class="cor"><?php echo $_GET['cor']; ?></span>
                        <?php }
                        if(isset($_COOKIE["log"]) && isset($_COOKIE["pass"])){?>
                            <input name="log" id="log" type="email" placeholder="Email" value="<?php echo $_COOKIE["log"]; ?>">
                            <input name="pass" id="pass" type="password" placeholder="Password" value="<?php echo $_COOKIE["pass"]; ?>">
                        <?php }
                        else{ ?>
                            <input name="log" id="log" type="email" placeholder="Email">
                            <input name="pass" id="pass" type="password" placeholder="Password">
                        <?php } ?>
                        <button name="submit" id="submit" type="submit">Submit</button>
                        <p>Forget Password ? <a href="Forgot.php">Reset</a></p>
                        <p>Don't have an accouunt ? <a href="Register.php">Sign Up</a></p>
                    </form>
                    <form class="f_guest" action="action/lg.php" method="POST" name="form">
                        <input hidden type="text" name="g_log" value="guest@mail.com">
                        <input hidden type="text" name="g_pass" value=" ">
                        <label>or</label>
                        <button class="guest" type="submit">Continue as Guest</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>