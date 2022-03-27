<?php
session_start();
require_once "db.php";
$db = new Dbase();

$output = "";

//Admin
if($_SESSION['role'] == 3){
    if(isset($_POST['query'])){
        $search = $_POST['query'];
        $sql = $db->sql("SELECT * FROM products WHERE Name LIKE '%$search%' OR Gender = '$search' OR Category = '$search'");
    } else $sql = $db->sql("SELECT * FROM products");

    if(mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($sql)){
            $output .= "<div class='card'>
                            <div class='imgBx'>
                                <img src='image/{$row['Image']}'>
                                <h2>{$row['Name']}</h2>
                            </div>
                            <div class='content'>
                                <div class=\"size\">
                                    <h3>Size: </h3>
                                    <div>
                                        <label>
                                            <input type='radio' name='size' value='41'>
                                            <p class='fa'>41</p>
                                        </label>
                                        <label>
                                            <input type='radio' name='size' value='42'>
                                            <p class='fa'>42</p>
                                        </label>
                                        <label>
                                            <input type='radio' name='size' value='43'>
                                            <p class='fa'>43</p>
                                        </label>
                                        <label>
                                            <input type='radio' name='size' value='44'>
                                            <p class='fa'>44</p>
                                        </label>
                                    </div>
                                </div>
                                <div class='price'>
                                    <h3>$ {$row['Price']}</h3>
                                </div>
                                <form action='action/del.php' method='post'>
                                    <input hidden type='text' name='id' value='{$row['product_id']}'>
                                    <button class='rem' data-id='{$row['product_id']}'>Remove</button>
                                </form>
                            </div>
                        </div>";
        }
        echo $output;
        exit;
    }
    else{
        echo "<h1>¯\_(ツ)_/¯</h1>";
        exit;
    }
}

//Moderator
if($_SESSION['role'] == 2){
    if(isset($_POST['query'])){
        $search = $_POST['query'];
        $sql = $db->sql("SELECT * FROM products WHERE Name LIKE '%$search%' OR Gender = '$search' OR Category = '$search'");
    } else $sql = $db->sql("SELECT * FROM products ORDER BY product_id ASC");

    if(mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($sql)){
            $output .=  "<form action='action/p_edit.php' method='POST' class='card'>
                                <div class='imgBx'>
                                    <img src='image/{$row['Image']}'>
                                    <input text='name' name='name' value=\"$row[Name]\"></input>
                                </div>

                                <div class='content'>
                                    <div class='price'>
                                        <input type='number' name='price' value=\"$row[Price]\"></input>
                                    </div>
                                    <div>
                                        <input hidden type='text' name='id' value=\"$row[product_id]\"></input>
                                        <button class='edit' data-id='{$row['product_id']}' type='submit'>Edit</button>
                                    </div>
                                </div>
                        </form>";
        }
        echo $output;
        exit;
    }
    else{
        echo "<h1>¯\_(ツ)_/¯</h1>";
        exit;
    }
}

//User
else{
    if(isset($_POST['query'])){
        $search = $_POST['query'];
        
        $sql = $db->sql("CALL search_by($search)");
    } 
    else if(isset($_POST['sort_select'])){
        $sort = $_POST['sort_select'];
        
        $sql = $db->sql("SELECT * FROM products ORDER BY Price $sort");
    }
    else if(isset($_POST['filter_select'])){
        $filter = $_POST['filter_select'];
        
        if($filter == ' '){
            $sql = $db->sql("SELECT * FROM products");
        }
        
        else if(strlen($filter) > 5){
            $ranges = explode("-", $filter);
        
            $from = $ranges[0];
            $to = $ranges[1];
        
            $sql = $db->sql("SELECT * FROM products WHERE Price BETWEEN $from AND $to");
        }

        else{
            $sql = $db->sql("SELECT * FROM products WHERE Gender = '$filter' OR Category = '$filter'");
        }


    }
    else $sql = $db->sql("SELECT * FROM products WHERE NOT Quantity = '0'");

    if(mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($sql)){
            $output .= "<div class='card'>
                            <div class='imgBx'>
                                <img src='image/{$row['Image']}'>
                                <h2>{$row['Name']}</h2>
                            </div>
                            <div class='content'>
                                <form action='action/basket.php' method='post'>
                                    <div class=\"size\">
                                        <h3>Size: </h3>
                                        <div>
                                            <label>
                                                <input type='radio' name='size' value='41'>
                                                <p class='fa'>41</p>
                                            </label>
                                            <label>
                                                <input type='radio' name='size' value='42'>
                                                <p class='fa'>42</p>
                                            </label>
                                            <label>
                                                <input type='radio' name='size' value='43'>
                                                <p class='fa'>43</p>
                                            </label>
                                            <label>
                                                <input type='radio' name='size' value='44'>
                                                <p class='fa'>44</p>
                                            </label>
                                        </div>
                                    </div>
                                    <div class='price'>
                                        <h3>$ {$row['Price']}</h3>
                                    </div>
                                    <div>
                                        <input hidden name='product_id' type='text' value='{$row['product_id']}'>
                                        <button id='btn' type='submit'>Add To Cart</button>
                                    </div>
                                </form>
                            </div>
                        </div>";
        }
        echo $output;
        exit;
    }
    else{
        echo "<h1>¯\_(ツ)_/¯</h1>";
        exit;
    }
}
?>