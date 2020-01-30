<?php
if (!isset($_SESSION)) {
	session_start();
}
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function login($gebuikersnaam, $password)
{
	global $conn;
	$user_ip = (sha1($_SERVER['REMOTE_ADDR']));
	$session_id = rand(1000, 1000000);
	$query = "SELECT * FROM users WHERE gebruikersnaam= '$gebuikersnaam' OR email = '$gebuikersnaam' ";

	mysqli_prepare($conn, $query);
	$result = mysqli_query($conn, $query) or die ("FOUT: " . mysqli_error($conn));

	$total = mysqli_num_rows($result);

	if ($total == 1) {
		foreach ($result as $row) {
			$pwdcheck = password_verify($password, $row['wachtwoord']);
			if ($pwdcheck == false) {
				header("location: home?error=wrongpwd");
				exit();
			} else {
				$_SESSION['recht'] = $row['recht'];
				$_SESSION['account_id'] = $row['id'];
				$_SESSION['naam'] = $row['naam'];
				$_SESSION['department'] = $row['department'];
				$_SESSION['session_ip'] = $user_ip;
				$_SESSION['session_id'] = $session_id;
				$_SESSION['gebr'] = $gebuikersnaam;
				$_SESSION['email'] = $row['email'];
				$_SESSION['logged_in'] = true;
			}
		}
	} else {
		header("location: home?error=nouser");
	}

}