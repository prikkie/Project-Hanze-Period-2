<?php
function login($gebruikersnaam, $wachtwoord)
{
	global $conn;
	$user_ip = (sha1($_SERVER['REMOTE_ADDR']));
	$session_id = rand(1000, 1000000);
	$query = "SELECT * FROM users WHERE gebruikersnaam = '" . $gebruikersnaam . "' AND wachtwoord = '" . $wachtwoord . "' ";

	mysqli_prepare($conn, $query);
	$result = mysqli_query($conn, $query) or die ("FOUT: " . mysqli_error($conn));


	$total = mysqli_num_rows($result);

	if ($total == 1) {
		foreach ($result as $row) {
			$_SESSION['account_id'] = $row['id'];
			$_SESSION['naam'] = $row['naam'];
		}
		$_SESSION['session_ip'] = $user_ip;
		$_SESSION['session_id'] = $session_id;
		$_SESSION['gebr'] = $gebruikersnaam;
		$_SESSION['logged_in'] = true;

	} else {

		do_alert("M8 u got ur credentials wrong!");

	}
}