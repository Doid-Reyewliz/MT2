<?php
session_start();
require_once "db.php";
$db = new Dbase();

$output = "";

//Admin
if($_SESSION['role'] == 3){
    if(isset($_POST['query'])){
        $search = $_POST['query'];
        $sql = $db->sql("SELECT * FROM products WHERE Name LIKE '%$search%' OR Category = '$search'");
    } else $sql = $db->sql("SELECT * FROM products");

    if(mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($sql)){
            $output .= "<div class='card'>
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
                                <div class='price'>
                                    <h3>$ {$row['Price']}</h3>
                                </div>
                                <form action='action/del.php' method='post'>
                                    <input hidden type='text' name='code' value='{$row['Code']}'>
                                    <button class='rem' data-id='{$row['Code']}'>Remove</button>
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
        $sql = $db->sql("SELECT * FROM products WHERE Name LIKE '%$search%' OR Category = '$search'");
    } else $sql = $db->sql("SELECT * FROM products ORDER BY id ASC");

    if(mysqli_num_rows($sql) > 0){
        while($row = mysqli_fetch_assoc($sql)){
            $output .=  "<div class='card'>
                            <div class='imgBx'>
                                <img src='image/{$row['Image']}'>
                                <input text='name' name='name' value=\"$row[Name]\"></input>
                            </div>

                            <div class='content'>
                                <div class='price'>
                                    <input type='number' name='price' value=\"$row[Price]\"></input>
                                </div>
                                <form action='action/add.php' method='POST'>
                                    <input hidden type='text' name='id' value=\"$row[id]\"></input>
                                    <button class='edit' data-id='{$row['Code']}' type='submit'>Edit</button>
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

//User
else{
    if(isset($_POST['query'])){
        $search = $_POST['query'];
        $sql = $db->sql("SELECT * FROM products WHERE Name LIKE '%$search%' OR Category = '$search'");
    } else $sql = $db->sql("SELECT * FROM products ORDER BY id ASC");

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
                                <div class=\"container\">
                                    <input type=\"radio\" name=\"radio\">
                                    <span class=\"checkmark\"></span>
                                </div>
                                <div class=\"container\">
                                    <input type=\"radio\" name=\"radio\">
                                    <span class=\"checkmark\"></span>
                                </div>
                                <div class=\"container\">
                                    <input type=\"radio\" name=\"radio\">
                                    <span class=\"checkmark\"></span>
                                </div>
                                <div class=\"container\">
                                    <input type=\"radio\" name=\"radio\">
                                    <span class=\"checkmark\"></span>
                                </div>
                            </div>
                                <div class='price'>
                                    <h3>$ {$row['Price']}</h3>
                                </div>
                                <form action='action/basket.php' method='post'>
                                    <input hidden name='code' type='text' value='{$row['Code']}'>
                                    <button id='btn' type='submit' onclick='snack();'>Add To Cart</button>
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

<script>
//Remove For Admin
$(document).ready(function(){
    $('.rem').click(function(){
        var el = this;
        var deleteprod = $(this).data('id');
        var confirmalert = confirm("Delete this course?");

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
</script>