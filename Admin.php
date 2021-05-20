<?php
session_start();
if ($_SESSION['role'] == 3) {

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
            <li class="active"><a href="Admin.php">Products</a></li>
            <li><a href="Users.php">Users</a></li>
            <!-- <div id="google_translate_element"></div> -->
        </ul>
    </nav>

    <nav class="nav_buttons">
        <a href="Profile.php">
            <img class="prof_im" src="<?php echo 'prof_image/' . $_SESSION['image']; ?>">
            <p class='rainbow rainbow_text_animated'> <?php echo $_SESSION['name']; ?></p>
        </a>
        <a href="Bag.php"><img class="basket" src="https://img.icons8.com/fluent/48/000000/shopping-basket-2.png" /></a>
        <a href="index.php"><img src="https://img.icons8.com/fluent/48/000000/exit.png" /></a>
    </nav>
</header>

<body>
    <button onclick="topFunction()" id="top_btn"><img src="https://img.icons8.com/fluent/50/ffffff/circled-chevron-up.png"/></button>
    <article id="products">
        <h1>Products</h1>

        <div id="search">
            <input name="search" class="search" type="text" autocomplete="off" placeholder=" Search">
        </div>

        <div class="products"></div>
    </article>

<?php
} else {
    echo "<body style='background: linear-gradient(to top right, rgb(78, 219, 120), rgb(45, 34, 146)); display:flex; flex-direction:column; padding: 30% 30%; padding-top:15%;'>
    <img src='image/200.gif'>
    <a style='
    align-self:center;
    text-align:center;
    width: 30%;
    color: #fff;
    padding: .6%;
    margin-top: 4%;
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
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
</script>
</html>