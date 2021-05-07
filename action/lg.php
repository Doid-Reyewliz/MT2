<?php
session_start();

require_once "db.php";;

if(isset($_POST['log'], $_POST['pass'])) {

	$log = $_POST['log'];
	$pass = $_POST['pass'];

	if(empty($log)) header("Location: ../index.php?error=Login is required");
	
	if(empty($pass)) header("Location: ../index.php?error=Password is required");
	else {
		$db = new Dbase();

		$users = $db->query("SELECT * FROM users WHERE Login='$log' AND Password='$pass'");

		if (!empty($users)) {

			$role = $db->query("SELECT * FROM user_roles WHERE user='$log'");

			foreach ($users as $i => $values) {
				foreach ($role as $j => $values) {
					if($role[$j]['role'] == '1') {
						$_SESSION['id'] = $users[$i]['id'];
						$_SESSION['role'] = $role[$j]['role'];
						$_SESSION['mail'] = $log;
						$_SESSION['name'] = $users[$i]['Name'];
						$_SESSION['image'] = $users[$i]['Image'];
						setcookie("log", $log, time() + 20, "/");
						setcookie("pass", $pass, time() + 20, "/");
						header("Location: ../Home.php");
					}

					if($role[$j]['role'] == '2') {
						$_SESSION['id'] = $users[$i]['id'];
						$_SESSION['role'] = $role[$j]['role'];
						$_SESSION['mail'] = $log;
						$_SESSION['name'] = $users[$i]['Name'];
						$_SESSION['image'] = $users[$i]['Image'];
						setcookie("log", $log, time() + 20, "/");
						setcookie("pass", $pass, time() + 20, "/");
						header("Location: ../Mod.php");
					}

					if($role[$j]['role'] == '3') {
						$_SESSION['id'] = $users[$i]['id'];
						$_SESSION['role'] = $role[$j]['role'];
						$_SESSION['mail'] = $log;
						$_SESSION['name'] = $users[$i]['Name'];
						$_SESSION['image'] = $users[$i]['Image'];
						setcookie("log", $log, time() + 20, "/");
						setcookie("pass", $pass, time() + 20, "/");
						header("Location: ../Choose.php");
					}
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