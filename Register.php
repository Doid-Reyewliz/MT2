<!DOCTYPE html>
<html>

<head>
    <title>Create Account</title>
    <link rel="stylesheet" type="text/css" href="sign.css">
    <link rel="shortcut icon" href="https://img.icons8.com/fluent/48/000000/add-user-male.png" />
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
                    <h2>Sign Up</h2>
                    <form action="action/rg.php" method="POST">
                        <?php if (isset($_GET['error'])) { ?>
                            <span class="error"><?php echo $_GET['error']; ?></span>
                        <?php } ?>
                        <input name="log" id="log" type="email" placeholder="Email">
                        <input name="name" id="name" type="text" placeholder="Username">

                        <input name="pass" id="pass" type="password" placeholder="Password"> <br>

                        <input name="gen" type="radio" id="gen" value="Male">
                        <label>Male</label>
                        <input name="gen" type="radio" id="gen" value="Female">
                        <label>Female</label>
                        <input name="gen" type="radio" id="gen" value="Other">
                        <label>Other</label>
                        <br>

                        <label for="bday">Birthday:</label>
                        <input id="bday" name="bday" type="date">

                        <label for="addr">Address:</label>
                        <input id="addr" name="addr" type="text">

                        <label for="phone">Phone:</label>
                        <input id="phone" name="phone" type="tel" pattern="+7[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}" placeholder="+7123-456-78-90" required>

                        <select name="quest" id="quest">
                            <option value="" disabled selected>Choose Question</option>
                            <option value="Name of your first pet">Name of your first pet</option>
                            <option value="Your University">Your University</option>
                            <option value="Favorite country">Favorite country</option>
                        </select>

                        <input name="ans" id="ans" type="text" placeholder="Your Answer">

                        <input id="submit" type="submit" value="Register">
                        <input id="reset" type="reset" value="Reset">
                        <br>

                        <p>Have an accouunt ? <a href="index.php">Sign In</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>