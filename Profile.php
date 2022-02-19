<?php
session_start();
require_once "action/db.php";

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $db = new Dbase();
    $sql = $db->query("SELECT * FROM users WHERE user_id = '$id'");

     foreach($sql as $key => $value){
          $login = $sql[$key]['Login'];
          $name = $sql[$key]['Name'];
          $pass = $sql[$key]['Password'];
          $gen = $sql[$key]['Gender'];
          $bday = $sql[$key]['Birthday'];
          $addr = $sql[$key]['Address'];
          $phone = $sql[$key]['Phone'];
          $que = $sql[$key]['Question'];
          $ans = $sql[$key]['Answer'];
          $rank = $sql[$key]['Rank'];
          $end_d = $sql[$key]['End_of_discount'];
          $image = $sql[$key]['Image'];
     }

     $sql_status = $db->query("SELECT * FROM orders WHERE user_id = '$id'");
     $sql_rank = $db->query("SELECT * FROM rank");
     $count = 0;
     
     foreach ($sql_status as $stat => $value){
          $product_id = $sql_status[$stat]['product_id'];
          $number = $sql_status[$stat]['number'];
          $sql_price = $db->query("SELECT Price FROM products WHERE product_id = '$product_id'");

          foreach($sql_price as $price){
              $count += $price['Price'] * $number;
          }
     }

     foreach ($sql_rank as $all_ranks => $value){

          if($count >= $sql_rank[$all_ranks]['cost']){
               $discount = $sql_rank[$all_ranks]['discount'];
               $n_rank = $sql_rank[$all_ranks]['rank'];

               $upd = $db->sql("UPDATE users SET Rank = '$n_rank' AND End_of_discount = CURRENT_DATE() WHERE user_id = '$id'");
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
                                   "</span>\nRank: <span>" . $n_rank .
                                   "</span>\nDiscount: <span>" . $discount . "%" .
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

//profile image upload
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
          type: 'post',
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