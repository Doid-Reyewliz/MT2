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
            <li class="active"><a href="Mod.php">Products</a></li>
            <!-- <div id="google_translate_element"></div> -->
        </ul>
    </nav>

    <nav class="nav_buttons">
        <a href="Profile.php">
            <img class="prof_im" src="<?php echo 'prof_image/' . $_SESSION['image']; ?>">
            <p class="rainbow rainbow_text_animated"><?php echo $_SESSION['name']; ?></p>
        </a>
        <a href="Bag.php"><img class="basket" src="https://img.icons8.com/fluent/48/000000/shopping-basket-2.png" /></a>
        <a href="index.php"><img src="https://img.icons8.com/fluent/48/000000/exit.png" /></a>
    </nav>  
</header>

<body>
    <div class="content">
        <h1>Manage Courses</h1>
        <div id="search">
            <input name="search" class="search" type="text" autocomplete="off" placeholder=" Search">
        </div>
        <?php if (isset($_GET['edit'])) {echo "<span class='edit'; style='width: 300px; margin-left: 40%; padding-top: 0; font-size: 18px;'>" . $_GET['edit'] . "</span>";}?>
        <br>
        <div class="products">
            <div class="card">
                <form class="add_new" action="action/add.php" method="POST">
                    <input name="name" type="text" placeholder="Name" autocomplete="off">
                    <input name="catg" type="text" placeholder="Category" autocomplete="off">
                    <label>Product Image: (864x600)</label><input name="image" type="file">
                    <input name="price" type="type" placeholder="Price">
                    <input name="number" type="number" min="1" max="10" placeholder="Quantity">
                    <input name="code" type="text" placeholder="Code" autocomplete="off">
                    <button type="submit">Add</button>
                    <?php if (isset($_GET['error'])) {
                        echo "<span class='error'>" . $_GET['error'] . "</span>";
                    } ?>
                </form>
            </div>
            <?php
            if (isset($_POST['search'])) {
                require_once "action/db.php";
                $db = new Dbase();

                $text = $_POST['search'];
                $product = $db->query("SELECT * FROM products WHERE Name LIKE '%$text%' OR Company LIKE '%$text%'");

                foreach ($product as $key => $value) {
                ?>
                <div class="card">
                    <div class="imgBx">
                        <img src="<?php echo 'image/' . $product[$key]['Image']; ?>" alt="">
                        <h2><?php echo $product[$key]["Name"]; ?></h2>
                    </div>
                    <div class="content">
                        <div class="size">
                            <h3>Size: </h3>
                            <span>40</span>
                            <span>41</span>
                            <span>42</span>
                            <span>43</span>
                        </div>
                        <div class="color">
                            <h3>Color: </h3>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <form action="action/del.php" method="post">
                            <input type="hidden" name="code" type="text" value="<?php echo $product[$key]['Code']; ?>">
                            <button class="edit" data-id="<?php echo $product[$key]["Code"]?>" type="submit">Edit</button>
                        </form>
                    </div>
                </div>
                <?php
                }
            } else {
                require_once "action/db.php";
                $db = new Dbase();

                $product = $db->query("SELECT * FROM products ORDER BY id ASC");
                if (!empty($product)) {
                    foreach ($product as $key => $value) {
                ?>
                <div class="card">
                    <div class="imgBx">
                        <img src="<?php echo 'image/' . $product[$key]['Image']; ?>" alt="">
                        <h2><?php echo $product[$key]["Name"]; ?></h2>
                    </div>
                    <div class="content">
                        <div class="size">
                            <h3>Size: </h3>
                            <span>40</span>
                            <span>41</span>
                            <span>42</span>
                            <span>43</span>
                        </div>
                        <div class="color">
                            <h3>Color: </h3>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <form action="action/del.php" method="post">
                            <input type="hidden" name="code" type="text" value="<?php echo $product[$key]['Code']; ?>">
                            <button class="edit" data-id="<?php echo $product[$key]["Code"]?>" type="submit">Edit</button>
                        </form>
                    </div>
                </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
<?php
} }else {
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

    </html>