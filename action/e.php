<?php
session_start();

require_once "db.php";;
$db = new Dbase();

//Edit User Information
if(isset($_POST['log'], $_POST['pass'], $_POST['name'], $_POST['gen'], $_POST['bday'], $_POST['quest'], $_POST['check'])){
	$id = $_SESSION['id'];
	$log = $_POST['log'];
	$pass = $_POST['pass'];
	$name = $_POST['name'];
	$gen = $_POST['gen'];
	$bday = $_POST['bday'];
	$quest = $_POST['quest'];
	$ans = $_POST['ans'];
	$_SESSION['mail'] = $_POST['log'];

	if (empty($_POST['check'])) {
		$lang = " ";
		echo $ch;
	} else {
		$lang[] = implode(", ", $_POST['check']);
	}

	for($i=0; $i<sizeof($lang); $i++){
		$sql = $db->sql("UPDATE users SET `Login`='$log',`Password`='$pass',`Name`='$name',`Gender`='$gen',`Birthday`='$bday',`Question`='$quest',`Answer`='$ans',`Lang`='$lang[$i]' WHERE id = $id");
		header("Location:../Profile.php");
	}
}

//Edit Profile Image
else{
	$image = $_FILES['file']['name'];
	$id = $_SESSION['id'];
	$_SESSION['image'] = $image;

	move_uploaded_file($_FILES['file']['tmp_name'], '../prof_image/' . $_FILES['file']['name']);
	$sql = $db->sql("UPDATE users SET `Image`='$image' WHERE id = $id");
	exit;
}
