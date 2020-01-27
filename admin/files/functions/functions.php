<?php

if (!isset($_SESSION)) {
	session_start();
}

function do_alert($msg)
{
	echo '<script type="text/javascript">alert("' . $msg . '"); </script>';
}


function loginAdmin($gebruikersnaam, $password)
{

	global $conn;
	$user_ip = (sha1($_SERVER['REMOTE_ADDR']));
	$session_id = rand(1000, 1000000);
	$query = "SELECT * FROM users WHERE gebruikersnaam = '" . $gebruikersnaam . "'  AND (recht = 'A' OR recht = 'M')";

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
				$_SESSION['gebr'] = $gebruikersnaam;
				$_SESSION['logged_in'] = true;
			}
		}

	} else {

		do_alert("M8 u got ur credentials wrong!");

	}
}

function Suppliers_delete($id)
{
	global $conn;
	$query = "delete from supplier where id = $id ";
	$conn->query($query);
	header("Location: /admin/suppliers");

}

function Gebruikers_delete($id)
{
	global $conn;
	$query = "delete from users where id = $id ";
	$conn->query($query);
	header("Location: /admin/gebruikers");

}

function Product_delete($id)
{
	global $conn;
	$query = "delete from products where id = $id ";
	$conn->query($query);
	header("Location: /admin/producten");

}

function Order_delete($id)
{
	global $conn;
	$query = "delete from orderregels where order_id = $id ";
	$conn->query($query);
	$query = "delete from orders where id = $id ";
	$conn->query($query);
	header("Location: /admin/orders");

}

function afgewezen($id)
{
	global $conn;
	$qu = "UPDATE orderregels SET status='" . 'afgewezen' . "' WHERE id= '" . $id . "' ";
	$re = mysqli_query($conn, $qu);
}

function toegekend($id)
{
	global $conn;
	$qu = "UPDATE orderregels SET status='" . 'toegekend' . "' WHERE id= '" . $id . "' ";
	$re = mysqli_query($conn, $qu);
}


?>