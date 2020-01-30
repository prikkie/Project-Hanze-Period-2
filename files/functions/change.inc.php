<?php
echo "niet gezet";
if (isset($_POST['wijzigen'])) {
	echo "wel gezet";

	$id = $_SESSION['account_id'];
	$user = $_POST['gebruikersnaam'];
	$naam = $_POST['naam'];
	$adres = $_POST['adres'];
	$email = $_POST['email'];
	$password = $_POST['wachtwoord'];

	$hashedPwd = password_hash($password, PASSWORD_DEFAULT);

//	$query = "UPDATE users SET gebruikersnaam='$user',naam='$naam',adres='$adres',email='$email', wachtwoord='$hashedPwd' WHERE id='$id'";
//	$query_run = mysqli_query($conn, $query);


	//header("Location: http://projecthanze.com/account");
}