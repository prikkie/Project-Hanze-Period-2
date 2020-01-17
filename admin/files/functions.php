<?php
if (!isset($_SESSION)) {
	session_start();
}

function do_alert($msg)
{

	echo '<script type="text/javascript">alert("' . $msg . '"); </script>';

}


//function login_admin($email, $password)
//{
//    global $conn;
//    $user_ip = (sha1($_SERVER['REMOTE_ADDR']));
//    $session_id = rand(1000, 1000000);
//
//    $query = "SELECT * FROM leden WHERE email = '" . $email . "' AND password = '" . $password . "' AND administrator = 'yes'";
//    $result = mysqli_query($conn, $query) or die ("FOUT: " . mysqli_error($conn));
//
//
//    $total = mysqli_num_rows($result);
//
//    if ($total == 1) {
//        foreach ($result as $row) {
//            $admin = $row['administrator'];
//            $account_id = $row['id'];
//            $naam = $row['naam'];
//        }
//        $_SESSION['session_ip'] = $user_ip;
//        $_SESSION['session_id'] = $session_id;
//        $_SESSION['email'] = $email;
//        $_SESSION['admin'] = $admin;
//        $_SESSION['name'] = "$naam";
//        $_SESSION['account_id'] = $account_id;
//
//    } else {
//
//        do_alert("M8 u got ur credentials wrong!");
//
//    }
//}


function check_login()
{
	if (isset($_SESSION['email'], $_SESSION['session_id'], $_SESSION['session_ip'], $_SESSION['admin'])) {
		if ($_SESSION['admin'] == 'yes') {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}


function currentDate()
{

	$datum = date("j M Y");

	$month['Jan'] = "januari";
	$month['Feb'] = "februari";
	$month['Mar'] = "maart";
	$month['Apr'] = "april";
	$month['May'] = "mei";
	$month['Jun'] = "juni";
	$month['Jul'] = "juli";
	$month['Aug'] = "augustus";
	$month['Sep'] = "september";
	$month['Oct'] = "oktober";
	$month['Nov'] = "november";
	$month['Dec'] = "december";

	foreach ($month as $k => $v) {
		$datum = str_replace($k, $v, $datum);
	}

	return $datum;

}

?>