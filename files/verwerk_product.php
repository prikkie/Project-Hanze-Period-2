<?php
session_start();
if (isset($_SESSION['account_id'])) {
	$dep = $_SESSION['department'];
	$to = $dep . "@" . $dep . ".nl";
	$subject = "Nieuwe aanvraag voor product: " . $_POST['n_naam'];


	$message = "<h1>Product aanvraagformulier: {$_POST['n_naam']}</h1>";
	$message .= "</br></br>";
	$message .= "Aangevraagd door werknemer: " . $_SESSION['gebr'];
	$message .= "</br></br>";
	$message .= "Omschrijving gegeven: " . $_POST['n_omschrijving'];
	$message .= "</br.</br>";
	$message .= "Motivatie gegeven door werknemer: " . $_POST['n_reden'];
	$message .= "</br><br/>";
	$message .= "Einde bericht";


	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	mail($to, $subject, $message, $headers);
	?>
	<?php
	require 'files/functions/db_connect.php';

	$naam = trim($_POST['n_naam']);
	$oms = trim($_POST['n_omschrijving']);
	$link = trim($_POST['n_link']);
	$reden = trim($_POST['n_reden']);
	$auth = trim($_POST['n_auth']);
	$depart = $dep;
	$query = "INSERT INTO requests (naam, department, link, omschrijving, motivatie, auth) VALUES ('$naam','$depart','$link','$oms','$reden','$auth')";
	$conn->query($query);
	echo "Aanvraag is toegevoegd";
}
?>
