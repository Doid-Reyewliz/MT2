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
                        <form action="action/lg.php" method="POST" name="form">
                            <input type="hidden" name="log" value="guest@mail.com">
                            <input type="hidden" name="pass" value=" ">
                            <button type="submit">Enter as Guest</button>
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
<script>
function guest(selectedtype){
    document.form.log.value = selectedtype;
    document.form.pass.value = selectedtype;
    document.form.submit();
}
</script>

</html>