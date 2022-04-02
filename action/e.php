<?php
session_start();

require_once "db.php";
$db = new Dbase();

// Edit User Information
if(isset($_POST['log'], $_POST['pass'], $_POST['name'], $_POST['gen'], $_POST['bday'], $_POST['quest'])){
	$id = $_SESSION['id'];
	$log = $_POST['log'];
	$pass = $_POST['pass'];
	$name = $_POST['name'];
	$gen = $_POST['gen'];
	$bday = $_POST['bday'];
	$addr = $_POST['addr'];
	$phone = $_POST['phone'];
	$quest = $_POST['quest'];
	$ans = $_POST['ans'];
	$_SESSION['mail'] = $_POST['log'];

	
	$sql = $db->sql("CALL update_user('$id', '$log', '$pass', '$name', '$gen', '$bday', '$addr', '$phone', '$quest', '$ans')");
	header("Location:../Profile.php");

}

//Edit Profile Image
else{
	$image = $_FILES['file']['name'];
	$id = $_SESSION['id'];
	$_SESSION['image'] = $image;

	move_uploaded_file($_FILES['file']['tmp_name'], '../prof_image/' . $_FILES['file']['name']);
	$sql = $db->sql("UPDATE users SET `Image`='$image' WHERE user_id = $id");
	exit;
}
