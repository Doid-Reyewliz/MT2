<?php
session_start();
if ($_SESSION['role'] == 2) {

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Settings</title>
    <link rel="stylesheet" type="text/css" href="page.css">
    <link rel="shortcut icon" href="https://img.icons8.com/fluent/48/000000/settings.png" />
</head>

<header>
    <nav class="nav_text">
        <ul class="list">
            <img class="logo" src="image/logo_white.png" alt="">
            <li><a href="Home.php">Home</a></li>
            <li class="active"><a href="Products.php">Products</a></li>
            <li><a href="Users.php">Users</a></li>
            <!-- <div id="google_translate_element"></div> -->
        </ul>
    </nav>

    <nav class="nav_buttons">
        <a href="Profile.php">
            <img class="prof_im" src="<?php echo 'prof_image/' . $_SESSION['image']; ?>">
            <p><?php echo $_SESSION['name']; ?></p>
        </a>
        <a href="Bag.php"><img class="basket" src="https://img.icons8.com/fluent/48/000000/shopping-basket-2.png" /></a>
        <a href="index.php"><img src="https://img.icons8.com/fluent/48/000000/exit.png" /></a>
    </nav>
</header>

<article id="products">
    <h1>Products</h1>
    <ul class="categ">
        <li><form method="POST"><input hidden type="text" name="men" value="Men"><button type="submit">Men</button></form></li>
        <li><form method="POST"><input hidden type="text" name="women" value="Women"><button type="submit">Women</button></form></li>
        <li><form method="POST"><input hidden type="text" name="kids" value="Kids"><button type="submit">Kids</button></form></li>
    </ul>

    <div id="search">
            <input name="search" class="search" type="text" autocomplete="off" placeholder=" Search">
    </div>

    <div class="products"></div>

</article>
<div id="snackbar">Added To Cart</div>

<?php
} else {
    echo "<body style= 'background-image: linear-gradient(to bottom left, #ffa249, #9e00f6);'><h1 style='
    color: #fff;
    margin-top: 15%;
    margin-left: 23%;
    width: 50%;
    padding: 2%;
    text-align: center;
    background: #9e00f6;
    backdrop-filter: blur(5px);
    border-radius: 20px;
    background: rgba(255, 255, 255, .1);
    box-shadow: 0 25px 45px rgba(0, 0, 0, .1);
    border: 3px solid rgba(255, 255, 255, .5);
    border-right: 3px solid rgba(255, 255, 255, .2);
    border-bottom: 3px solid rgba(255, 255, 255, .2);

    '>How did you end up here? <br>Anyway, you don't have an <b>access</b> to this page !<h1>
    <a style='
    margin-left: 41%;
    color: #fff;
    padding: .6%;
    margin-top: 1%;
    text-decoration:none; background: #9e00f6;
    backdrop-filter: blur(5px);
    border-radius: 10px;
    background: rgba(255, 255, 255, .1);
    box-shadow: 0 25px 45px rgba(0, 0, 0, .1);
    border: 3px solid rgba(255, 255, 255, .5);
    border-right: 3px solid rgba(255, 255, 255, .2);
    border-bottom: 3px solid rgba(255, 255, 255, .2);' href='Home.php'>Go to Home page </a>
    
    </body>";
}
    ?>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
//remove
$(document).ready(function(){
    $('.rem').click(function(){
        var el = this;
        var deleteprod = $(this).data('id');
        var confirmalert = confirm("Are you sure?");

        if (confirmalert == true) {
        $.ajax({
            url: 'action/del.php',
            type: 'POST',
            data: { code:deleteprod },
            success: function(response){
                $(el).closest('.card').fadeOut(800,function(){
                $(this).remove();
                });
            }
            });
        }
    });
});

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

</html>