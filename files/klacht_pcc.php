<?php


if (isset($_POST['submit'])) {
	$naam = $_POST['naam'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$supplier = $_POST['supplier'];
	$mssg = $_POST['massg'];
	$headers = "From:" . $naam;
	$text = "You have recived e_mail form" . $naam . ".\n\n" . $mssg;
	mail($supplier, $subject, $text, $headers);
}
?>