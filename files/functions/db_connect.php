<?php
$dbservername = "localhost";
$dbusername = "u636479626_project";
$dbpassword = "*&~x]K]$6[";
$database = "u636479626_projecthanze";

// Create connection
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $database);

// Check connection
if (!$conn) {
	die('Could not connect: ' . mysqli_error($conn));
}

