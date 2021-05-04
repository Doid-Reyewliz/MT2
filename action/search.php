<?php
session_start();
require_once "db.php";
$db = new Dbase();

$output = "";

//for Admin
if($_SESSION['role'] == 2){
    if(isset($_POST['query'])){
        $search = $_POST['query'];
        $sql = $db->sql("SELECT * FROM products WHERE Name LIKE '%$search%' OR Category LIKE '%$search%'");
    }
    else{
        $sql = $db->sql("SELECT * FROM products ORDER BY id ASC");
    }
    
    if(mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($sql)){
            $output .=  "<div class='card'>
                            <div class='imgBx'>
                                <img src='image/{$row['Image']}'>
                                <h2>{$row['Name']}</h2>
                            </div>
                            <div class='content'>
                                <div class='size'>
                                    <h3>Size: </h3>
                                    <span>40</span>
                                    <span>41</span>
                                    <span>42</span>
                                    <span>43</span>
                                </div>
                                <div class='color'>
                                    <h3>Color: </h3>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <button class='rem' data-id='{$row['Code']}' type='submit'>Remove</button>
                            </div>
                        </div>";
        }
        echo $output;
    }
    else{
        echo "<h3>No values</h3>";
    }
}

//for User
else{
    if(isset($_POST['query'])){
        $search = $_POST['query'];
        $sql = $db->sql("SELECT * FROM products WHERE Name LIKE '%$search%' OR Category LIKE '%$search%'");
    }
    else{
        $sql = $db->sql("SELECT * FROM products ORDER BY id ASC");
    }

    if(mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($sql)){
            $output .=  "<div class='card'>
                            <div class='imgBx'>
                                <img src='image/{$row['Image']}'>
                                <h2>{$row['Name']}</h2>
                            </div>
                            <div class='content'>
                                <div class='size'>
                                    <h3>Size: </h3>
                                    <span>40</span>
                                    <span>41</span>
                                    <span>42</span>
                                    <span>43</span>
                                </div>
                                <div class='color'>
                                    <h3>Color: </h3>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <form action='' method='post'>
                                    <input type='hidden' name='code' type='text' value='{$row['Code']}'>
                                    <button id='btn' type='submit' onclick='snack();'>Add To Cart</button>
                                </form>
                            </div>
                        </div>";
        }
        echo $output;
    }
    else{
        echo "<h3>No values</h3>";
    }
}

?>