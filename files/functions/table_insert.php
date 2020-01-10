<?php
require "db_connect.php";
if ($conn === false) {
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

$naam = mysqli_real_escape_string($conn, $_REQUEST['naam']);
$prijs = mysqli_real_escape_string($conn, $_REQUEST['prijs']);
$voorraad = mysqli_real_escape_string($conn, $_REQUEST['voorraad']);
$omschrijving = mysqli_real_escape_string($conn, $_REQUEST['omschrijving']);
$categorie = mysqli_real_escape_string($conn, $_REQUEST['categorie']);
$actief = mysqli_real_escape_string($conn, $_REQUEST['actief']);

$sql = "INSERT INTO products (naam, prijs, voorraad, omschrijving, categorie, actief)
 VALUES ('$naam', '$prijs', '$voorraad', '$omschrijving', '$categorie', '$actief')";
if (mysqli_query($conn, $sql)) {
	echo "HOPPA STAAT ER IN HEUR";
} else {
	echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

mysqli_close($conn);
echo "<a href='/home2'>Terug naar home</a>";
?>