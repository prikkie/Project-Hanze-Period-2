<?
if ($_SESSION['logged_in'] == true && $_SESSION['recht'] == "A") {
	?>
	<form method="post" class="tablecss" action="">
		<table>
			<tr>
				<th width="15%">Image</th>
				<th width="20%">Naam</th>
				<th>Product</th>
				<th>Aantal</th>
				<th>Prijs/stuk</th>
				<th>Totaalprijs</th>
				<th>Authorisatie</th>


			</tr>

			<?php
			$sid = $_GET['sid'];
			$totaaltotaalprijs = 0;
			$totaalaantal = 0;
			$query = 'SELECT * FROM orderregels where order_id =' . $sid; //2
			$result = mysqli_query($conn, $query);
			while ($row = mysqli_fetch_assoc($result)) {

				$aantal = $row['aantal'];
				$prijs = $row['prijs'];
				$product = $row['product'];
				$authorisatie = $row['toegekend']; //1
				$query1 = 'SELECT * FROM products where id =' . $product; //3

				$result1 = mysqli_query($conn, $query1);
				$products = mysqli_fetch_assoc($result1);

				$image = $products['afbeelding'];
				$naam = $products['naam'];
				$totaalprijs = $aantal * $prijs;
				$totaalaantal += $aantal;
				$totaaltotaalprijs += $totaalprijs

				?>
				<tr>
					<td align="center"><img id="img_product" src=/images/<?php echo $image ?>></td>
					<td align="center"> <?php echo $naam ?> </td>
					<td align="center"> <?php echo $product; ?> </td>
					<td align="center">€ <?php echo $prijs ?> </td>
					<td align="center"><?php echo $aantal ?> </td>
					<td align="center">€ <?php echo number_format($totaalprijs, 2, '.', ''); ?> </td>
					<td align="center"><?php echo $authorisatie; ?></td>
					<?php if ($authorisatie == "authorisatie nodig") { ?>
						<td>
							<button type="submit" name="niet">Nee</button>
							<button type="submit" name="yes">Ja</button>
						</td>

						<?php
						if (isset($_POST['niet'])) {
							$qu = "UPDATE orderregels SET toegekend='" . 'afgewezen' . "' WHERE product='" . $product . "' AND order_id= '" . $sid . "'  ";
							$re = mysqli_query($conn, $qu);
						}
					} ?>


				</tr>
				<?php

			} ?>
			<tr>
				<td colspan="2">Totaal:</td>
				<td colspan="1" align="center"></td>
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
					<button name="afhandelen" value="Afhandelen" type="submit">Afhandelen</button>
				</td>
			</tr>
	</form>
	<?php
	if (isset($_POST['afhandelen'])) {
		echo $query = "UPDATE orders SET  afgehandeld = 1 WHERE id =" . $sid;
		$conn->query($query);
		header("Location: /admin/orders");
	}

} else {
	header("Location: http://projecthanze.com/admin/home");
}

