<?php
session_start();

if (isset($_POST['log'], $_POST['pass'], $_POST['name'], $_POST['gen'], $_POST['bday'], $_POST['quest'], $_POST['ans'])) {
	require_once "db.php";
	$db = new Dbase();

	$log = $_POST['log'];
	$pass = $_POST['pass'];
	$name = $_POST['name'];
	$gen = $_POST['gen'];
	$bday = $_POST['bday'];
	$addr = $_POST['addr'];
	$phone = $_POST['phone'];
	$quest = $_POST['quest'];
	$ans = $_POST['ans'];

	$error = 0;

	if (empty($log) || empty($pass) || empty($name) || empty($gen) || empty($bday) || empty($quest) || empty($ans)) {
		header("Location:../Register.php?error=One or More fields are empty");
		$error++;
	}

	if (strlen($pass) < 6) {
		header("Location:../Register.php?error=The length of password must be greater than 5");
		$error++;
	}

	$take = $db->query("SELECT * FROM users WHERE Login = '$log' OR Name = '$name' LIMIT 1");

	if (!empty($take)) {
		foreach ($take as $key => $value) {
			if ($take[$key]['Login'] === $log) {
				header("Location:../Register.php?error=This email is already taken");
				$error++;
			}

			if ($take[$key]['Name'] === $name) {
				header("Location:../Register.php?error=This Username is already taken");
				$error++;
			}
		}
	}

	if ($error == 0) {
		$db->sql("CALL user_add(' ', '$log', '$pass', '$name', '$gen', '$bday', '$addr', '$phone', '$quest', '$ans', '1', 'icons8-male-user-96.png')");
		$db->sql("CALL user_role('','$log','1')");
		header("Location:../index.php?cor=Registration was successful");
	}
}
