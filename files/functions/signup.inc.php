<?php
if (isset($_POST['signup-submit'])) {
	require 'db_connect.php';

	$username = test_input($_POST['uid']);
	$name = test_input($_POST['name']);
	$adres = test_input($_POST['adr']);
	$email = test_input($_POST['mail']);
	$password = test_input($_POST['pwd']);
	$passwordRepeat = test_input($_POST['pwd-repeat']);
	$geslacht = test_input($_POST['geslacht']);
	$afdeling = test_input($_POST['department']);

	if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
		header("location: /signup?error=emptyfields&uid=" . $username . "&mail=" . $email);
		exit();
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		header("location: /signup?error=invalidmailuid");
		exit();
	} elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		header("location: /signup?error=invaliduid&mail=" . $email);
		exit();
	} elseif ($password !== $passwordRepeat) {
		header("location: /signup?error=passwordcheck&uid=" . $username . "&mail" . $email);
		exit();
	} else {
		$sql = "SELECT gebruikersnaam FROM users WHERE gebruikersnaam=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: /signup?error=sqlerror");
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if ($resultCheck > 0) {
				header("location: /signup?error=usertaken&mail=" . $email);
				exit();
			} else {
				$sql = "INSERT INTO users (gebruikersnaam, naam, adres, email, wachtwoord, geslacht) VALUES (?, ?, ?, ?, ?, ?)";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("location: /signup?error=sqlerror");
					exit();
				} else {
					$hashedPwd = password_hash($password, PASSWORD_DEFAULT);

					mysqli_stmt_bind_param($stmt, "ssssss", $username, $name, $adres, $email, $hashedPwd, $geslacht);
					mysqli_stmt_execute($stmt);
					header("location: /signup?signup=succes");
					exit();
				}
			}
		}
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
} else {
	header("location: /signup?");
	exit();
}
