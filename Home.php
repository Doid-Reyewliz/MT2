<?php session_start();?>
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
            <li class="active"><a href="Home.php">Home</a></li>
            <?php if ($_SESSION['role'] == 3) { ?>
                <li><a href="Admin.php">Products</a></li>
                <li><a href="Users.php">Users</a></li>
            <?php } elseif ($_SESSION['role'] == 2) { ?>
                <li><a href="Mod.php">Products</a></li>
            <?php } else { ?>
                <li><a href="Products.php">Products</a></li>
                <li><a href="Contact_Us.php">Contact Us</a></li>
            <?php } ?>
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
            <a href="Bag.php"><img class="ico" src="https://img.icons8.com/fluent/48/000000/shopping-basket-2.png" /></a>
            <!-- <span><?php //echo $_SESSION['num']; ?></span> -->
        </div>
        <a href="index.php"><img class="ico" src="https://img.icons8.com/fluent/48/000000/exit.png" /></a>
        <?php }?>
    </nav>
</header>

<body>
    <button onclick="topFunction()" id="top_btn"><img src="https://img.icons8.com/fluent/50/ffffff/circled-chevron-up.png"/></button>
    <span class="crcl"></span>
    <section>
        <h1 class="prod">New Releases</h1>
        <div class="slide">
            <div class="mySlides fade"><img src="image/slide1.jpg"></div>
            <div class="mySlides fade"><img src="image/slide2.jpg"></div>
            <div class="mySlides fade"><img src="image/slide3.jpg"></div>
            <div class="mySlides fade"><img src="image/slide4.jpg"></div>
        </div>
        <br>
        <div class="dots">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </section>
    <article id="products">
        <h1>New Products</h1>
        <div class="products">
        <?php
            require_once "action/db.php";
            $db = new Dbase();

            $product = $db->query("SELECT * FROM products ORDER BY product_id DESC");
            if (!empty($product)) {
                for ($i = 0; $i < 3; $i++) {
            ?>
                <div class="card">
                    <div class="imgBx">
                        <img class="ico" src="https://img.icons8.com/fluent/48/ffffff/new.png"/>
                        <img src="<?php echo 'image/' . $product[$i]['Image']; ?>" alt="">
                        <h2><?php echo $product[$i]["Name"]; ?></h2>
                    </div>
                    <div class="content">
                        <form action='action/basket.php' method='post'>
                        <div class="size">
                            <h3>Size: </h3>
                            <div>
                                <label>
                                    <input type="radio" name="size" value="41">
                                    <p class="fa">41</p>
                                </label>
                                <label>
                                    <input type="radio" name="size" value="42">
                                    <p class="fa">42</p>
                                </label>
                                <label>
                                    <input type="radio" name="size" value="43">
                                    <p class="fa">43</p>
                                </label>
                                <label>
                                    <input type="radio" name="size" value="44">
                                    <p class="fa">44</p>
                                </label>
                            </div>
                        </div>
                        <div class='price'>
                            <h3><?php echo "$ " . $product[$i]['Price'];?> </h3>
                        </div>
                        <?php if ($_SESSION['role'] != 4) { ?>
                        <div>
                            <input hidden name='code' type='text' value='<?php echo $product[$i]['product_id'];?>'>
                            <button id='btn' type='submit'>Add To Cart</button>
                        </div>
                        <?php } ?>
                        </form>
                    </div>
                </div>
            <?php
                }
            }
        ?>
        </div>
    </article>
    <h1>Feedbacks</h1>
    <div class="feed">
        <?php
            $sql = $db->sql("SELECT products.Image, products.product_id as product_id, users.Name, products.Name as p_name, users.user_id, orders.comment FROM orders INNER JOIN products ON orders.product_id = products.product_id INNER JOIN users ON orders.user_id = users.user_id WHERE orders.comment IS NOT NULL");

            if(mysqli_num_rows($sql) != 0){
                foreach($sql as $row){
                    echo    "<div class=\"back\">
                                <div>
                                    <img src=\"image/$row[Image]\">
                                    <p style='color:#fff;'><b>{$row['p_name']}</b></p>
                                </div>
                                <div>
                                    <span>{$row['Name']}</span>
                                    <p>{$row['comment']}</p>
                                </div>" .
                                (($_SESSION['id'] == $row['user_id'] || $_SESSION['role'] == 3)?"<button class='del' data-name='{$row['product_id']}' data-lg='{$row['user_id']}'><img src='https://img.icons8.com/fluent/48/000000/multiply.png'/></button>":"") .
                            "</div>";
                }
            }
            else echo   "<div class='back'>
                            <h3>No Feedbacks yet</h3>
                        </div>";
        ?>
    </div>
</body>

<script src="final.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('.del').click(function(){
        var el = this;
        var user_id = $(this).data('user_id');
        var product_id = $(this).data('product_id');
        var confirma = confirm("Are you sure?");

        if(confirma == true){
            $.ajax({
                url: 'action/del.php',
                type: 'POST',
                data: { 
                    u_id:user_id,
                    p_id:product_id
                },
                success: function(response){
                    $(el).closest('.back').fadeOut(800,function(){
                        $(this).remove();
                        $(".feed").html("<div class='back'><h3>No Feedbacks yet</h3></div   >");
                    });
                }
            });
        }
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
</html>