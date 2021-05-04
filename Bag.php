<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="shortcut icon" href="https://img.icons8.com/fluent/48/000000/home-page.png" />
    <link rel="stylesheet" href="page.css">
</head>

<header>
    <nav class="nav_text">
        <ul class="list">
            <img class="logo" src="image/logo_white.png" alt="">
            <li><a href="Home.php">Home</a></li>
            <?php if ($_SESSION['role'] == 2) { ?>
                <li><a href="Admin.php">Courses</a></li>
                <li><a href="Users.php">Users</a></li>
            <?php } elseif ($_SESSION['role'] == 3) { ?>
                <li><a href="Mod.php">Courses</a></li>
            <?php } else { ?>
                <li><a href="Products.php">Products</a></li>
                <li><a href="Contact Us.php">Market</a></li>
            <?php } ?>
        </ul>
    </nav>

    <nav class="nav_buttons">
        <a class="active" href="Bag.php"><img class="basket" src="https://img.icons8.com/fluent/48/000000/shopping-basket-2.png" /></a>
        <a href="Profile.php"><img src="https://img.icons8.com/fluent/48/000000/user-male-circle.png" /></a>
        <a href="index.php"><img src="https://img.icons8.com/fluent/48/000000/exit.png" /></a>
    </nav>
</header>

<body>
    <section class="order">
        <div class="b_products">
            <div class="product">
                <img src="image/air_f_1_l_m.png" alt="">
                <h3>Air Force 1 Low</h3>
                <p>$50</p>
                <div class="number">
                    <button><img src="https://img.icons8.com/fluent/48/000000/minus.png"/></button>
                    <p>1</p>
                    <button><img src="https://img.icons8.com/fluent/48/000000/add.png"/></button>
                </div>
            </div>
        </div>
        <div class="total">
            <p>Total: $10000</p>
            <button>Order</button>
        </div>
    </section>
</body>

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

<script src="final.js"></script>

</html>