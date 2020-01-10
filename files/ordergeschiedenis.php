<?php
if ($_SESSION['logged_in'] == true) {
	?>

	<table width="70%">
		<tr>
			<th>Orderregel</th>
			<th width="15%">Datum</th>
			<th width="10%">Totaalprijs</th>
		</tr>

		<?php

		$query = "SELECT * FROM orders";


		if ($result = $conn->query($query)) {
			while ($row = $result->fetch_assoc()) {
				$id = $row["id"];
				$orderregel = $row["orderregel"];
				$datum = $row["datum"];
				$totaalprijs = $row["totaalprijs"];
				$locatie = $row["Locatie"];
				?>


                <tr>
                    <td align="center"><?php echo $orderregel ?></td>
                    <td align="center"> <?php echo $datum ?> </td>
                    <td align="center">&euro; <?php echo $totaalprijs ?> </td>
                </tr>

				<?php
			}
			$result->free();
		}
		?>
    </table>
	<?php
} else {
	header("Location: http://projecthanze.com/admin/home");
}
