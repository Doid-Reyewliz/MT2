<?php

session_start();

if (isset($_SESSION['id'])) {

    require_once "action/db.php";
    $db = new Dbase();

    $id = $_SESSION['id'];
    $sql = $db->query("SELECT * FROM `users` WHERE user_id = $id");

    foreach($sql as $key => $value) {
        $login = $sql[$key]['Login'];
        $name = $sql[$key]['Name'];
        $pass = $sql[$key]['Password'];
        $gen = $sql[$key]['Gender'];
        $bday = $sql[$key]['Birthday'];
        $addr = $sql[$key]['Address'];
        $phone = $sql[$key]['Phone'];
        $que = $sql[$key]['Question'];
        $ans = $sql[$key]['Answer'];
        $img = $sql[$key]['Image'];
    }
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Edit Profile</title>
        <link rel="stylesheet" type="text/css" href="sign.css">
        <link rel="shortcut icon" href="https://img.icons8.com/fluent/48/000000/pencil-tip.png"/>
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
                            <h2>Edit Profile</h2>
                            <form action="action/e.php" method="POST">
                                <input name="log" id="log" type="email" value="<?php echo $login; ?>">
                                <input name="name" id="name" type="text" value="<?php echo $name; ?>">

                                <input name="pass" id="pass" type="text" placeholder="Password" value="<?php echo $pass; ?>"><br>

                                <input name="gen" type="radio" id="gen" value="Male" <?php if ($gen == "Male") { echo "checked";} ?>>
                                <label>Male</label>
                                <input name="gen" type="radio" id="gen" value="Female" <?php if ($gen == "Female") { echo "checked";} ?>>
                                <label>Female</label>
                                <input name="gen" type="radio" id="gen" value="Other" <?php if ($gen == "Other") { echo "checked";} ?>>
                                <label>Other</label>

                                <label for="bday">Birthday:</label>
                                <input id="bday" name="bday" type="date" value="<?php echo $bday; ?>">

                                <label for="addr">Address:</label>
                                <input id="addr" name="addr" type="text" value="<?php echo $addr; ?>">

                                <label for="phone">Phone:</label>
                                <input id="phone" name="phone" type="tel" pattern="+7-[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}" value="<?php echo $phone; ?>">

                                <select name="quest" id="quest">
                                    <option disabled selected>Choose Question</option>
                                    <option value="Name of your first pet" selected="<?php if ($que == "Name of your first pet") {echo "selected";} ?>">Name of your first pet</option>
                                    <option value="Your University" selected="<?php if ($que == "Your University") {echo "selected";} ?>">Your University</option>
                                    <option value="Favorite country" selected="<?php if ($que == "Favorite country") {echo "selected";} ?>">Favorite country</option>
                                </select>

                                <input name="ans" id="ans" type="text" placeholder="Your Answer" value="<?php echo $ans; ?>">

                                <div class="but">
                                    <input id="submit" type="submit" value="Submit">
                                    <input id="reset" type="reset" value="Reset">
                                    <a class='back' href='Profile.php'>Back</a>
                                </div>
                            </form>
                    </div>
                </div>
        </section>
    </body>

    </html>
<?php
} else {
    header("Location: Home.php");
    exit();
}

?>