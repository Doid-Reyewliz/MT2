<!DOCTYPE html>
<html>

<head>
    <title>Reset</title>
    <link rel="stylesheet" type="text/css" href="sign.css">
    <link rel="shortcut icon" href="https://img.icons8.com/fluent/48/000000/forgot-password.png" />
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
                    <h2>Reset</h2>
                    <?php if (isset($_GET['error'])) { ?>
                        <span class="error"><?php echo $_GET['error']; ?></span>
                    <?php } ?>
                    <form action="action/f.php" method="POST">
                        <input id="log" name="log" type="email" placeholder="Email">
                        <select name="quest" id="quest">
                            <option value="" disabled selected>Choose Question</option>
                            <option value="Name of your first pet">Name of your first pet</option>
                            <option value="Your University">Your University</option>
                            <option value="Favorite country">Favorite country</option>
                        </select>
                        <input name="ans" id="ans" type="text" placeholder="Your Answer">
                        <input name="pass" id="pass" type="password" placeholder="New Password"> <br>
                        <input name="rpass" id="pass" type="password" placeholder="Reset New Password"> <br>

                        <input id="submit" type="submit" value="Submit"> <br>
                        <p>Have an accouunt ? <a href="index.php">Sign in</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>