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
            <li class="active"><a href="Mod.php">Products</a></li>
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

<body>
    <button onclick="topFunction()" id="top_btn"><img src="https://img.icons8.com/fluent/50/ffffff/circled-chevron-up.png"/></button>
    <div class="content">
        <h1>Add New</h1>
        <?php if (isset($_GET['edit'])) {echo "<span class='edit'; style='width: 300px; margin-left: 40%; padding-top: 0; font-size: 18px;'>" . $_GET['edit'] . "</span>";}?>
        <div class="new">
            <div class="card">
                <form class="add_new" action="action/add.php" method="post" enctype="multipart/form-data">
                    <?php if (isset($_GET['error'])) {
                        echo "<span style='color:red;' class='error'>" . $_GET['error'] . "</span>";
                    } ?>
                    <input id="name" name="name" type="text" placeholder="Name" autocomplete="off">
                    <input id="catg" name="catg" type="text" placeholder="Category" autocomplete="off">
                    <br><label>Product Image: (864x600)</label><input id="file" name="image" type="file">
                    <input id="price" name="price" type="type" placeholder="Price">
                    <input id="number" name="number" type="number" min="1" max="10" placeholder="Quantity">
                    <input id="code" name="code" type="text" placeholder="Code" autocomplete="off"><br>
                    <button id="add" type="sumbit">Add</button>
                </form>
            </div>
        </div>
        <br>
        <h1>Manage Products</h1>
        <div id="search">
            <input name="search" class="search" type="text" autocomplete="off" placeholder=" Search">
        </div>

        <div class="edit"></div>
    </div>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
                $(".edit").html(response);
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
//add
// $(document).ready(function(){
//     $('#add').click(function(){
//         var name=$('#name').val();
//         var catg=$('#catg').val();
//         var price=$('#price').val();
//         var code=$('#code').val();

//         $.ajax({
//             url:'action/add.php',
//             method:'POST',
//             cache: false,
//             data:{
//                 name:name,
//                 catg:catg,
//                 price:price,
//                 number:number,
//                 code:code,
//             },
//             success:function(response){
//                 alert("Successfully Added");
//             }
//         });
//     });
// });
//file
// $('#add').on('click', function() {
//      var file_data = $('#file').prop('files')[0];
//      var form_data = new FormData();
//      form_data.append('file', file_data);
//      $.ajax({
//           url: 'action/add.php',
//           dataType: 'text',
//           cache: false,
//           contentType: false,
//           processData: false,
//           data: form_data,
//           type: 'post',
//           success:function(response){
//                $('#file').html(response);
//           }
//      });
// });
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