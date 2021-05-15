<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Products</title>
    <link rel="shortcut icon" href="https://img.icons8.com/fluent/48/000000/add-shopping-cart.png"/>
    <link rel="stylesheet" href="page.css">
</head>

<header>
    <nav class="nav_text">
        <ul class="list">
            <img class="logo" src="image/logo_white.png" alt="">
            <li><a href="Home.php">Home</a></li>
            <li class="active"><a href="Products.php">Products</a></li>
            <li><a href="Contact_Us.php">Contact Us</a></li>
            <!-- <div id="google_translate_element"></div> -->
        </ul>
    </nav>

    <nav class="nav_buttons">
        <a <?php if ($_SESSION['role'] != 4) { ?> href="Profile.php" <?php } ?>>
            <img class="prof_im" src="<?php echo 'prof_image/' . $_SESSION['image']; ?>">
            <p <?php if($_SESSION['role'] == 3){ echo "class='rainbow rainbow_text_animated'";} ?>><?php echo $_SESSION['name']; ?></p>
        </a>
        <?php if ($_SESSION['role'] == 4) { ?><a href="index.php"><img src="https://img.icons8.com/fluent/48/000000/exit.png" /></a><?php } 
        else {?>
        <div>
            <a href="Bag.php"><img class="basket" src="https://img.icons8.com/fluent/48/000000/shopping-basket-2.png" /></a>
            <!-- <span><?php //echo $_SESSION['num']; ?></span> -->
        </div>
        <a href="index.php"><img src="https://img.icons8.com/fluent/48/000000/exit.png" /></a>
        <?php }?>
    </nav>
</header>

<body>
    <button onclick="topFunction()" id="top_btn"><img src="https://img.icons8.com/fluent/50/ffffff/circled-chevron-up.png"/></button>
    <article id="products">
        <h1>Products</h1>
        <ul class="categ">
            <li><button class="catg" data-id="Men" type="submit">Men</button></li>
            <li><button class="catg" data-id="Women" type="submit">Women</button></li>
            <li><button class="catg" data-id="Kids" type="submit">Kids</button></li>
        </ul>

        <div id="search">
            <input name="search" class="search" type="text" autocomplete="off" placeholder=" Search">
        </div>

        <div class="products"></div>

    </article>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
//to top button
var mybutton = document.getElementById("top_btn");
window.onscroll = function () {
  scrollFunction();
};
function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.visibility = "visible";
    } else {
        mybutton.style.visibility = "hidden";
    }
}
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

//search
$(document).ready(function(){
    loadData();
    function loadData(query){
        $.ajax({
            url : "action/search.php",
            type: "POST",
            chache: false,
            data:{query:query},
            success:function(response){
                $(".products").html(response);
            }
        });
    }

    $(".search").keyup(function(){
        var search = $(this).val();
        if (search !="") {
            loadData(search);
        }else{
            loadData();
        }
    });
});
</script>



<!--
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
-->

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