<?php
session_start();
require_once "action/db.php";

if (isset($_SESSION['id'])) {
     $id = $_SESSION['id'];
     $db = new Dbase();
     $sql = $db->query("SELECT users.Login, users.Password, users.Name, users.Gender, users.Birthday, users.Phone, users.Question, users.Answer, users.Address, rank.rank as Rank, users.End_of_discount, users.Image FROM users LEFT JOIN rank ON users.Rank_id = rank.rank_id WHERE users.user_id = '$id'");

     foreach($sql as $key){
          $login = $key['Login'];
          $name = $key['Name'];
          $pass = $key['Password'];
          $gen = $key['Gender'];
          $bday = $key['Birthday'];
          $addr = $key['Address'];
          $phone = $key['Phone'];
          $que = $key['Question'];
          $ans = $key['Answer'];
          $rank = $key['Rank'];
          $end_d = $key['End_of_discount'];
          $image = $key['Image'];
     }

     $sql_status = $db->query("SELECT * FROM orders WHERE user_id = '$id'");
     $sql_rank = $db->query("SELECT * FROM rank");
     $count = 0;
     
     if($sql_status != null){
          foreach ($sql_status as $stat => $value){
               $product_id = $sql_status[$stat]['product_id'];
               $number = $sql_status[$stat]['number'];
               $sql_price = $db->query("SELECT Price FROM products WHERE product_id = '$product_id'");
     
               foreach($sql_price as $price){
                   $count += $price['Price'] * $number;
               }

               $Orders = $db->query("SELECT COUNT(user_id) as county FROM orders WHERE user_id = '$id'");
               $Spent = $db->query("SELECT SUM(orders.number * products.Price) as sumy FROM orders INNER JOIN products ON orders.product_id = products.product_id WHERE orders.user_id = '$id'");

          }
          foreach($Orders as $t){
               $totalOrders = ($t['county']);
          }
     
          foreach($Spent as $t){
              $totalSpent = ($t['sumy']);
          }
     }
     
     foreach ($sql_rank as $all_ranks => $value){

          if($count >= $sql_rank[$all_ranks]['cost']){
               $discount = $sql_rank[$all_ranks]['discount'];
               $rank_id = $sql_rank[$all_ranks]['rank_id'];
               $rank_n = $sql_rank[$all_ranks]['rank'];

               //? $upd = $db->sql("UPDATE users SET Rank_id =  '$rank_id' AND End_of_discount = CURRENT_DATE() WHERE user_id = '$id'");
          }
     }

?>
<!DOCTYPE html>
<html>

<head>
     <title>Profile</title>
     <link rel="stylesheet" type="text/css" href="sign.css">
     <link rel="shortcut icon" href="https://img.icons8.com/fluent/48/000000/contact-card.png"/>
</head>

<body>
     <section>
          <div class="box">
               <div class="square" style="--i:0;"></div>
               <div class="square" style="--i:1;"></div>
               <div class="square" style="--i:2;"></div>
               <div class="square" style="--i:3;"></div>
               <div class="square" style="--i:4;"></div>
               <div class="container">
                    <div class="content">
                         <div class="profile">
                              <div class="load">
                                   <input type="file" name="file" class="prof_im" style="background-image: url('<?php echo 'prof_image/' . $_SESSION['image']; ?>')" >
                                   <button class="upload"><img src="https://img.icons8.com/fluent/48/000000/save.png"/></button>
                              </div>
                              <h2 class="prof"><span <?php if($_SESSION['role'] == 3){ echo "class='rainbow rainbow_text_animated'"; } ?>> <?php echo $name; ?> </span><a href="Edit.php"><img src="https://img.icons8.com/fluent/48/000000/pencil-tip.png"/></a></h2>
                         </div>

                         <div class="inf">
                              <p> 
                                   <?php
                                   echo nl2br("Login: <span>" . $login .
                                   "</span>\nPassword:<span> " . $pass .
                                   "</span>\nGender: <span>" . $gen .
                                   "</span>\nBirthday: <span>" . $bday .
                                   "</span>\nAddress: <span>" . $addr .
                                   "</span>\nPhone: <span>" . $phone .
                                   "</span>\nQuestion: <span>" . $que .
                                   "</span>\nAnswer: <span>" . $ans .
                                   "</span>\nRank: <span>" . $rank_n .
                                   "</span>\nDiscount: <span>" . $discount . "%" .
                                   "</span>\nTotal number of orders: <span>" . $totalOrders .
                                   "</span>\nTotal spent: <span>" . "$" . $totalSpent .
                                   "</span>\nEnd of discount: <span>" . $end_d);
                                   ?>
                              <p>
                         </div>
                         <div class="butt">
                              <a href="Home.php">Back</a>
                         </div>
                    </div>
               </div>
          </div>
     </section>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

//! Profile image upload
$('.upload').on('click', function() {
     var file_data = $('.prof_im').prop('files')[0];
     var file_name = "prof_image/";
     var text = $('.prof_im').val();
     var form_data = new FormData();
     form_data.append('file', file_data);

     $.ajax({
          url: 'action/e.php',
          dataType: 'text',
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'POST',
          success:function(response){
               $(".prof_im").css('background-image', 'url(' + file_name + text.substring(text.lastIndexOf("\\") + 1, text.length) + ')');
          }
     });
});
</script>
</html>

<?php
} else header("Location: Home.php");

?>