<?php
if ($_SESSION['logged_in'] == true && ($_SESSION['recht'] == "A" || $_SESSION['recht'] == "M")) {
	?>
	<table>
		<tr>
			<th>Naam</th>
			<th width="5%">Order_nummer</th>
			<th>Product</th>
			<th width="10%">Supplier</th>
			<th width="10%">Supplier email</th>
			<th width="10%">Supplier telefoon</th>
			<th>Omschrijving</th>
			<th>Wat verwacht</th>
		</tr>
		<?php

		$query = "SELECT * FROM orderregels R join orders O on R.order_id=O.id join users U on O.klant=U.id WHERE R.klacht= 'ja' ";
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_assoc($result)) {
			$productNum = $row['product'];
			$orderId = $row['order_id'];
			$klant = $row['naam'];
			$omschrijving = $row['k_omschrijving'];
			$oplossing = $row['k_oplossing'];
			$query1 = "SELECT *, P.naam as productnaam  FROM products P join supplier S on P.leverancier=S.naam WHERE P.id= '$productNum' ";
			$result1 = mysqli_query($conn, $query1);
			$product = mysqli_fetch_assoc($result1);
			$productNaam = $product['productnaam'];
			$productPrijs = $product['prijs'];
			$productLev = $product['leverancier'];
			$email = $product['email'];
			$telefoon = $product['telefoon'];
			?>
			<tr>
			<td align="center"><?php echo $klant; ?></td>
			<td align="center"><?php echo $orderId; ?></td>
			<td align="center"><?php echo $productNaam; ?> </td>
			<td align="center"><?php echo $productLev ?> </td>
            <td align="center"><?php echo $email; ?> </td>
            <td align="center"><?php echo $telefoon; ?> </td>
            <td align="center"><?php echo $omschrijving; ?></td>
            <td align="center"><?php echo $oplossing; ?></td>

            </tr><?php } ?>
    </table>

	<?php

} else {
	header("Location: http://projecthanze.com/admin/home");
}
?>