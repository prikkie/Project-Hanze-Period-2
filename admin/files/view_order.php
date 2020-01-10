<form method="post" class="tablecss">
    <table>
        <tr>
            <th width="15%">Image</th>
            <th width="20%">Naam</th>
            <th>Aantal</th>
            <th>Prijs/stuk</th>
            <th>Totaalprijs</th>
        </tr>

		<?php
		$sid = $_GET['sid'];
		$totaaltotaalprijs = 0;
		$totaalaantal = 0;
		$query = 'SELECT * FROM orderregels where order_id =' . $sid;
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_assoc($result)) {
			$aantal = $row['aantal'];
			$prijs = $row['prijs'];
			$product = $row['product'];
			$query1 = 'SELECT * FROM products where id =' . $product;
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
                <td align="center">€ <?php echo $prijs ?> </td>
                <td align="center"><?php echo $aantal ?> </td>
                <td align="center">€ <?php echo number_format($totaalprijs, 2, '.', ''); ?> </td>
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
                <button name="afhandelen" value="Afhandelen" type="submit"></button>
            </td>
        </tr>
</form>
<?php
if (isset($_POST['afhandelen'])) {
	echo $query = "UPDATE orders SET  afgehandeld = 1 WHERE id =" . $sid;
	$conn->query($query);
	header("Location: /admin/orders");
}
?>