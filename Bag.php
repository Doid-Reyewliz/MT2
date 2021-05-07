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
                <li><a href="Contact_Us.php">Contact Us</a></li>
            <?php } ?>
        </ul>
    </nav>

    <nav class="nav_buttons">
        <a href="Profile.php">
            <img class="prof_im" src="<?php echo 'prof_image/' . $_SESSION['image']; ?>">
            <p <?php if($_SESSION['role'] == 3){ echo "class='rainbow rainbow_text_animated'";} ?>><?php echo $_SESSION['name']; ?></p>
        </a>
        <a href="Bag.php"><img class="basket" src="https://img.icons8.com/fluent/48/000000/shopping-basket-2.png" /></a>
        <a href="index.php"><img src="https://img.icons8.com/fluent/48/000000/exit.png" /></a>
    </nav>
</header>

<body>
    <button onclick="topFunction()" id="top_btn"><img src="https://img.icons8.com/fluent/50/ffffff/circled-chevron-up.png"/></button>
    <h1>Your Bag</h1>
    <section class="order">
        <div class="b_products">
        <?php
        require_once "action/db.php";
        $db = new Dbase();

        $mail = $_SESSION['mail'];
        $count = 0;
        $price = 0;

        $select = $db->sql("SELECT * FROM basket WHERE user_mail = '$mail'");

        if(mysqli_num_rows($select) > 0){

            $sql = $db->query("SELECT basket.number, basket.product_code, products.Image, products.Name, products.Price FROM basket INNER JOIN products ON basket.product_code = products.Code WHERE basket.user_mail = '$mail'");

            foreach($sql as $row){
                $price = $row['Price'] * $row['number'];
                echo "<div class=\"product\">
                        <img src=\"image/{$row['Image']}\"?>
                        <h3>{$row['Name']}</h3>
                        <p>$$price</p>
                        <div class=\"number\">
                            <input hidden type=\"text\" class=\"code\" value=\"{$row['product_code']}\">
                            <button data-id=\"{$row['number']}\" id=\"minus\"><img src=\"https://img.icons8.com/fluent/48/000000/minus.png\"/></button>
                            <p id=\"number\">{$row['number']}</p>
                            <button data-id=\"{$row['number']}\" id=\"plus\"><img src=\"https://img.icons8.com/fluent/48/000000/add.png\"/></button>
                        </div>
                    </div>";
                $count += $price;
            }
        }
        else{
            echo "<h1 class='stat'>Your Bag is Empty</h1>";
        }
        ?>
        </div>
        <form class="total" action="action/order.php" method="POST">
            <p>Total: <span>$<?php echo $count; ?></span></p>
            <button type="submit">Order</button>
        </form>
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

<script>
//scroll on top
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

$("#minus").click(function(){
    var el = this;
    var buy = $(this).data('id');
    var code=$('.code').val();

    $.ajax({
        url:'action/basket.php',
        method:'POST',
        data:{ 
            minus:buy,
            code:code
        },
        success:function(response){
            $("#number").html(response);
        }
    });
});

$("#plus").click(function(){
    var el = this;
    var buy = $(this).data('id');
    var code=$('.code').val();

    $.ajax({
        url:'action/basket.php',
        method:'POST',
        data:{ 
            plus:buy,
            code:code
        },
        success:function(response){
            $("#number").html(response);
        }
    });
});

</script>

</html>