<?php
include 'includes/db_connect.php';
$query = 'Select * from products';
$result = mysqli_query($conn, $query) or die ("FOUT: " . mysqli_error($conn));
foreach ($result as $row) {
	echo $row['id'] . " " . $row['price'] . "<br>";
	echo "<img src='../images/plus.png'>";
	echo "<img src='../images/min.png'>";
	echo "<br><br>";

}