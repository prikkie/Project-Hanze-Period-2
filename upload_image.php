<?php
require 'files/functions/db_connect.php';

$img = $_POST['img'];
$naam = $_POST['naam'];
$prijs = $_POST['prijs'];
$cat = $_POST['cat'];
$omschrijving = $_POST['omschrijving'];
$voorraad = $_POST['voorraad'];
$actief = $_POST['actief'];

if (isset($_POST['toevoegen'])) {
	echo $query = "INSERT INTO products (naam, prijs, voorraad, afbeelding, omschrijving) VALUES ('$naam','$prijs','$voorraad','$omschrijving')";
	$conn->query($query);
	header("Location: http://projecthanze.com/admin/producten");
}

