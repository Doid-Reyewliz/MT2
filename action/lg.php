<?php
session_start();

require_once "db.php";

if(isset($_POST['log'], $_POST['pass'])) {

	$log = $_POST['log'];
	$pass = $_POST['pass'];

	if(empty($log)) header("Location: ../index.php?error=Login is required");
	
	if(empty($pass)) header("Location: ../index.php?error=Password is required");
	else {
		$db = new Dbase();

		$users = $db->query("SELECT * FROM users WHERE Login='$log' AND Password='$pass'");

		if (!empty($users)) {

			$role = $db->query("SELECT users.Name, users.Image, users.user_id, role.role_id FROM users INNER JOIN role ON users.Role_id = role.role_id WHERE users.Login='$log'");

			foreach ($role as $values) {
				if($values['role_id'] == '1') {
					$_SESSION['id'] = $values['user_id'];
					$_SESSION['role'] = $values['role_id'];
					$_SESSION['mail'] = $log;
					$_SESSION['name'] = $values['Name'];
					$_SESSION['image'] = $values['Image'];
					setcookie("log", $log, time() + 20, "/");
					setcookie("pass", $pass, time() + 20, "/");
					header("Location: ../Home.php");
				}

				if($values['role_id'] == '2') {
					$_SESSION['id'] = $values['user_id'];
					$_SESSION['role'] = $values['role_id'];
					$_SESSION['mail'] = $log;
					$_SESSION['name'] = $values['Name'];
					$_SESSION['image'] = $values['Image'];
					setcookie("log", $log, time() + 20, "/");
					setcookie("pass", $pass, time() + 20, "/");
					header("Location: ../Mod.php");
				}

				if($values['role_id'] == '3') {
					$_SESSION['id'] = $values['user_id'];
					$_SESSION['role'] = $values['role_id'];
					$_SESSION['mail'] = $log;
					$_SESSION['name'] = $values['Name'];
					$_SESSION['image'] = $values['Image'];
					setcookie("log", $log, time() + 20, "/");
					setcookie("pass", $pass, time() + 20, "/");
					header("Location: ../Choose.php");
				}
			}
		} else header("Location: ../index.php?error=Incorect Login or Password");
	}
}

if(isset($_POST['g_log'], $_POST['g_pass'])){
	$_SESSION['role'] = '4';
	$_SESSION['mail'] = 'guest@mail.com';
	$_SESSION['name'] = 'Guest';
	$_SESSION['image'] = 'icons8-male-user-96.png';
	header("Location: ../Home.php");
}