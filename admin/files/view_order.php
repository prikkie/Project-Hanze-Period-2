<?php
if ($_SESSION['logged_in'] == true && $_SESSION['recht'] == "A" || $_SESSION['recht'] == "M") {

	?>


	<table width="100%">
		<tr>
			<th>Image</th>
			<th>Naam</th>
			<th>Product</th>
			<th>Prijs/stuk</th>
			<th>Aantal</th>
			<th>Totaalprijs</th>
			<th>Status</th>
			<th>Reden aanvraag</th>
			<th>Reden afkeuring</th>


		</tr>

		<?php
		$sid = $_GET['sid'];
		$query = 'SELECT * FROM orders where id =' . $sid;
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		$redenklant = $row['reden'];

		$totaaltotaalprijs = 0;
		$totaalaantal = 0;
		$hoeveelAfgehandeld = 0;
		$query = 'SELECT * FROM orderregels where order_id =' . $sid;
		$result = mysqli_query($conn, $query);
		$hoeveelRows = mysqli_num_rows($result);

		while ($row = mysqli_fetch_assoc($result)) {

			$id = $row['id'];
			$aantal = $row['aantal'];
			$reden = $row['reden'];
			$prijs = $row['prijs'];
			$product = $row['product'];
			$authorisatie = $row['status'];
			$query1 = 'SELECT * FROM products where id =' . $product;

			$result1 = mysqli_query($conn, $query1);
			$products = mysqli_fetch_assoc($result1);

			$image = $products['afbeelding'];
			$naam = $products['naam'];
			$totaalprijs = $aantal * $prijs;
			$totaalaantal += $aantal;
			$totaaltotaalprijs += $totaalprijs;

			if ($authorisatie == "toegewezen" || $authorisatie == "afgewezen") {
				$hoeveelAfgehandeld++;
				if ($hoeveelAfgehandeld == $hoeveelRows) {
					$query = "UPDATE orders SET  afgehandeld = 1 WHERE id =" . $sid;
					$conn->query($query);

				}

			}

			?>

			<tr>
				<td align="center"><img id="img_product" src=/images/<?php echo $image ?>></td>
				<td align="center"> <?php echo $naam ?> </td>
				<td align="center"> <?php echo $product; ?> </td>
				<td align="center">€ <?php echo $prijs ?> </td>
				<td align="center"><?php echo $aantal ?> </td>
				<td align="center">€ <?php echo number_format($totaalprijs, 2, '.', ''); ?> </td>
				<td align="center"><?php echo $authorisatie; ?></td>
				<td align="center"> <?php echo $redenklant ?> </td>
				<?php if ($authorisatie != "afgewezen" && $authorisatie != "toegewezen") { ?>
					<td align="center">
						<form method="post" action="/admin/auth/n/<?php echo $id; ?>"><input type="text" size="60"
						                                                                     name="reden">
					</td>
				<?php } else { ?>
					<td align="center"><?php echo $reden ?> </td>
				<?php } ?>

				<?php if ($authorisatie == "authorisatie nodig") {
					$id = $row['id']; ?>
					<td>
						<button>Nee</button>

						</form>
					</td>
					<td><a target="_self"
					       href="/admin/auth/y/<?php echo $id; ?>">
							<button>Ja</button>
						</a></td>
					<?php


				} ?>
			</tr>
			<?php
		} ?>
		<tr>
			<td colspan="2">Totaal:</td>
			<td colspan="2" align="center"></td>
			<td colspan="1" align="center"><?php echo $totaalaantal ?></td>
			<td colspan="1" align="center">&euro; <?php echo number_format($totaaltotaalprijs, 2, ".", '') ?></td>
		</tr>
		<tr>
			<td colspan="1" align="center"></td>
			<td colspan="1" align="center"></td>
			<td colspan="1" align="center"></td>
			<td colspan="1" align="center"></td>
			<td colspan="1" align="center"></td>
			<td>
			</td>
		</tr>
	</table>
	<?php


} else {
	header("Location: http://projecthanze.com/admin/home");
}

