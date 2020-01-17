<?php
if ($_SESSION['logged_in'] == true && $_SESSION['recht'] == "A" || $_SESSION['recht'] == "M") {
	if (isset($_POST['afhandelen'])) {
		echo $query = "UPDATE orders SET  afgehandeld = 1 WHERE id =" . $sid;
		$conn->query($query);
		header("Location: /admin/orders");
	}
	/* if (isset($_GET['nid'])){
	 $nid=$_GET['nid'];
	 echo afgewezen($nid);
	  } */
	if (isset($_GET['nid'])) {
		$nid = $_GET['nid'];
		echo $nid;
		toegewezen($nid);
	}
	if (isset($_GET['yid'])) {
		$yid = $_GET['yid'];
		echo toegewezen($yid);
	} ?>


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
				$id = $row['id'];
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
					<?php if ($authorisatie == "authorisatie nodig") {
						$id = $row['id']; ?>
						<td><a target="_self"
						       href="view_order/n/<?php echo $id; ?>">
								<button>Nee</button>
							</a>
						</td>
						<td><a target="_self"
						       href="view_order/y/<?php echo $id; ?>">
								<button>Ja</button>
							</a></td>
						<?php


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
	</table>
	<?php


} else {
	header("Location: http://projecthanze.com/admin/home");
}

