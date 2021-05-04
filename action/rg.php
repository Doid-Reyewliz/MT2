<?php
session_start();

if (isset($_POST['log']) && isset($_POST['pass']) && isset($_POST['name']) && isset($_POST['gen']) && isset($_POST['bday']) && isset($_POST['quest']) && isset($_POST['ans'])) {
	require_once "db.php";;
	$db = new Dbase();

	$log = $_POST['log'];
	$pass = $_POST['pass'];
	$name = $_POST['name'];
	$gen = $_POST['gen'];
	$bday = $_POST['bday'];
	$quest = $_POST['quest'];
	$ans = $_POST['ans'];

	$error = 0;

	if (empty($_POST['check'])) {
		header("Location:../Register.php?error=One or More fields are empty");
		$error++;
	} else {
		$lang[] = implode(", ", $_POST['check']);
	}

	if (empty($log) or empty($pass) or empty($name) or empty($gen) or empty($bday) or empty($quest) or empty($ans)) {
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
		for ($i = 0; $i < sizeof($lang); $i++) {
			$sql = $db->sql("INSERT INTO users (`id`, `Login`, `Password`, `Name`, `Gender`, `Birthday`, `Question`, `Answer`, `Lang`, `Image`) VALUES ('','$log','$pass','$name','$gen','$bday','$quest','$ans','$lang[$i]','icons8-male-user-96.png')");
		}
		$role = $db->sql("INSERT INTO user_roles (`id`, `user`, `role`) VALUES ('','$log','1')");
		header("Location:../index.php");
	}
}
