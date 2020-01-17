<?php
include 'includes/db_connect.php';
$query = 'Select * from products';
$result = mysqli_query($conn, $query) or die ("FOUT: " . mysqli_error($conn));

?>
<button>
	<a href="nieuw_product">Product toevoegen</a>
</button>
<table>
	<tr>
		<th>Product-id</th>
		<th>Prijs</th>
	</tr>
	<?php

	foreach ($result as $row) {

//	echo "<img src='../images/min.png' height='200px'>";
//	echo "<img src='../images/plus.png' height='200px'>";
//	echo "<br><br>";
		$id = $row['id'];
		$price = $row['price'];

		?>
		<tr>
			<?php
			echo "<td>" . $row['id'] . "</td>" . "<td>" . $row['price'] . "</td>";
			?>
		</tr>
		<?php
	}
	?>
</table>
