<?php
session_start();
include_once "action/db.php";
$db = new Dbase();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Contact Us</title>
    <link rel="shortcut icon" href="https://img.icons8.com/fluent/48/000000/add-shopping-cart.png" />
    <link rel="stylesheet" href="page.css">
</head>

<header>
    <nav class="nav_text">
        <ul class="list">
            <img class="logo" src="image/logo_white.png" alt="">
            <li><a href="Home.php">Home</a></li>
            <li><a href="Products.php">Products</a></li>
            <li class="active"><a href="Contact_Us.php">Contact Us</a></li>
        </ul>
    </nav>

    <nav class="nav_buttons">
        <a <?php if ($_SESSION['role'] != 4) { ?> href="Profile.php" <?php } ?>>
            <img class="prof_im" src="<?php echo 'prof_image/' . $_SESSION['image']; ?>">
            <p <?php if($_SESSION['role'] == 2){ echo "class='rainbow rainbow_text_animated'";} ?>><?php echo $_SESSION['name']; ?></p>
        </a>
        <?php if ($_SESSION['role'] == 4) { ?><a href="index.php"><img src="https://img.icons8.com/fluent/48/000000/exit.png" /></a><?php } 
        else {?>
        <a href="Bag.php"><img class="basket" src="https://img.icons8.com/fluent/48/000000/shopping-basket-2.png" /></a>
        <a href="index.php"><img src="https://img.icons8.com/fluent/48/000000/exit.png" /></a>
        <?php }?>
    </nav>
</header>

<body>
    <h1>FeedBack</h1>
    <div class="coment">
        <form class="p_search" action="action/com.php" method="POST">
            <select name="select" id="sel">
                <option disabled selected>Choose Snicker</option>
                <?php 
                    $sql=$db->sql("SELECT * FROM products");
                    foreach($sql as $row){
                        echo "<option value='{$row['Name']}'>{$row['Name']}</option>";
                    }
                ?>
            </select>
            <button id="prod" type="submit">Search</button>
        </form>
        <div class="div">
            <div>
                <img id="img" src="">
            </div>
            <form class="com" action="action/com.php" method="POST">
                <textarea name="text" id="artext" cols="30" rows="10" placeholder="Text..."></textarea>
                <input hidden type="text" id="text" value="">
                <button id="sub" type="submit">Sent</button>
            </form>
        </div>
    </div>
    <h1>Contacs</h1>
    <div>

    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#prod').click(function(){
        var name = $('#sel').val();

        $.ajax({
            url:'action/com.php',
            method:'POST',
            cache: false,
            data:{select:name},
            success:function(response){
                $('#img').attr("src", response);
            }
        });
    });

    $('#sub').click(function(){
        var artext = $('#artext').val();
        var text = $('#sel').val();

        $.ajax({
            url:'action/com.php',
            method:'POST',
            cache: false,
            data:{
                artext:artext,
                text:text
            },
            success:function(response){
                alert("Your feedback was added!!!");
            }
        });
    });
});

</script>

<footer>
    <div class="foot">
        <div class="contact">
            <div class="text">
                <a>GIFT CARDS</a>
                <a>PROMOEIONS</a>
                <a>FIND A STORE</a>
                <a>SIGN UP FOR EMAIL</a>
                <a>BECOME A MEMBER</a>
                <a>SEND US FEEDBACK</a>
            </div>
            <div class="get_help">
                <a class="help">GET HELP</a>
                <p>Order Status</p>
                <p>Shipping and Delivery</p>
                <p>Returns</p>
                <p>Payment Option</p>
                <p>Contact Us</p>
            </div>
            <div class="about">
                <a class="help">ABOUT NIKE</a>
                <p>News</p>
                <p>Careers</p>
                <p>Investors</p>
                <p>Purpose</p>
            </div>
        </div>

        <div class="s_media">
            <div class="social">
                <a href="https://www.facebook.com/nike"><img src="https://img.icons8.com/fluent/48/000000/telegram-app.png" /></a>
                <a href="https://www.instagram.com/nike/"><img src="https://img.icons8.com/fluent/48/000000/facebook-new.png" /></a>
                <a href="https://www.youtube.com/user/nike"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png" /></a>
                <a href="https://twitter.com/Nike"><img src="https://img.icons8.com/fluent/48/000000/gmail.png" /></a>
            </div>
            <div class="location">
                <img src="https://img.icons8.com/fluent/48/000000/maps.png" />
                <p>United States</p>
                <span> &copy; 2021 Nike, Inc All. Rights Reserved</span>
            </div>
        </div>
    </div>
</footer>