<?php
$to = "arnegrit2@gmail.com";
$subject = "Nieuwe aanvraag voor product: " . $_POST['n_naam'];


$message = "<h1>Product aanvraagformulier: {$_POST['n_naam']}</h1>";
$message .= "</br></br>";
$message .= "Motivatie gegeven door werknemer: ";


$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
mail($to, $subject, $message, $headers);
?>