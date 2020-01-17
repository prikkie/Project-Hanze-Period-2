<?php

if ($_SESSION['logged_in'] == true && $_SESSION['recht'] == "A" || $_SESSION["recht"] == "M") {
	if (isset($_GET['nid'])) {
		$nid = $_GET['nid'];
		$qu = "UPDATE orderregels SET toegekend='" . 'afgewezen' . "' WHERE id= '" . $sid . "' ";
		$re = mysqli_query($conn, $qu);
	}
	if (isset($_GET['yid'])) {
		$yid = $_GET['yid'];
		$qu = "UPDATE orderregels SET toegekend='" . 'toegewezen' . "' WHERE id= '" . $sid . "' ";
		$re = mysqli_query($conn, $qu);
	}

} else {
	header("Location: http://projecthanze.com/admin/home");
}

