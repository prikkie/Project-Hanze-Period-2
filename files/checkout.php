<?php
$price = 0;
$quantity = 0;

if (isset($_SESSION['account_id'])) {

	$query = 'SELECT * FROM users where id = ' . $_SESSION['account_id'];
	$result = mysqli_query($conn, $query);
	$user = mysqli_fetch_assoc($result);


	if (isset($_POST['koop'])) {

		$klant = $_SESSION['account_id'];
		$reden = $_POST['reden'];


		if (isset($_SESSION['carts']['products'])) {
			$price = $_SESSION['totaal'];

			$query = "INSERT INTO orders (klant,totaalprijs,reden) VALUES (' {$klant} ','  {$price}  ', '{$reden}' )";
			$result = mysqli_query($conn, $query);
			$rep = mysqli_fetch_assoc($result);
			$query = 'SELECT * FROM orders ORDER BY id DESC LIMIT 1';
			$result = mysqli_query($conn, $query);
			$order_id = mysqli_fetch_assoc($result);
		}


		foreach ($_SESSION['carts']['products'] as $key => $value) {
			$query = 'SELECT * FROM products where id = ' . $key;
			$result = mysqli_query($conn, $query);
			$product = mysqli_fetch_assoc($result);
			$price += ($product['prijs'] * $value);
			$query = 'INSERT INTO orderregels (order_id,product,aantal,prijs) VALUES (' . $order_id["id"] . ',' . $product["id"] . ',' . $value . ',' . $product["prijs"] . ')';
			$result = mysqli_query($conn, $query);
			$done = mysqli_fetch_assoc($result);


		}

		// To
		$to = $_SESSION['email'];

// Subject
		$subject = 'Checkout';

		// Message


		$message = "<table>                <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th width=\"15%\">Naam</th>
                    <th style=\"min-width: 30%\">Omschrijving</th>
                    <th width=\"15%\">Prijs</th>
                    <th>Hoeveelheid</th>
                </tr>
                    ";
		foreach ($_SESSION['carts']['products'] as $key => $value) {
			$query = 'SELECT * FROM products where id = ' . $key;
			$result = mysqli_query($conn, $query);
			$product = mysqli_fetch_assoc($result);

			$quantity += (isset($_SESSION["carts"]["products"][$product["id"]]) ? $_SESSION["carts"]["products"][$product["id"]] : 1);

			$message .= '
                </thead><tr>
						<td> <img height="150px" width="150px" src="http://www.projecthanze.com/images/' . $product['afbeelding'] . '" /></td>
						<td align="center">' . $product["naam"] . '</td>
						<td align="center">' . $product["omschrijving"] . '</td>
						<td align="center"> &euro;' . $product["prijs"] . '</td>
						<td align="center">
							' . (isset($_SESSION["carts"]["products"][$product["id"]]) ? $_SESSION["carts"]["products"][$product["id"]] : 1) . '
						</td> 

					</tr>
					
';
		}
		$message .= '									<tr>
					<td colspan="3">Totaal:</td>
					<td colspan="1" align="center">&euro;' . $_SESSION['totaal'] . '</td>
					<td colspan="1" align="center">' . $quantity . ' items</td>
				</tr></table>';

		$message .= "<br><br>Uw reden voor de aankoop:  $reden.
<br><br> <b><u>Als er een klacht over dit product bestaat, graag onder Mijn Orders > Order Inzien > Klacht, een klacht indienen!</u></b>

";

// To send HTML mail, the Content-type header must be set
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: purchase@projecthanze.com' . "\r\n";
		$headers .= 'Cc: ' . strtolower($_SESSION['department']) . '@projecthanze.com' . "\r\n";

// Mail it
		mail($to, $subject, $message, $headers);
		unset($_SESSION['carts']['products']);
		header("Location: http://projecthanze.com/bedankt");

	}

	?>
	<div class="lol">
		<div class="half-left">
			<table class="checkout">
				<thead>
				<tr>
					<th>&nbsp;</th>
					<th width="15%">Naam</th>
					<th style="min-width: 30%">Omschrijving</th>
					<th width="15%">Prijs</th>
					<th>Hoeveelheid</th>
				</tr>
				</thead>
				<tbody>
				<?php


				foreach ($_SESSION['carts']['products'] as $key => $value) {
					$query = 'SELECT * FROM products where id = ' . $key;
					$result = mysqli_query($conn, $query);
					$product = mysqli_fetch_assoc($result);


					$price += ($product['prijs'] * $value);
					$quantity += (isset($_SESSION["carts"]["products"][$product["id"]]) ? $_SESSION["carts"]["products"][$product["id"]] : 1);

					echo '<tr>
						<td> <img class="tumbnail" src="/images/' . $product['afbeelding'] . '" /></td>
						<td align="center">' . $product["naam"] . '</td>
						<td align="center">' . $product["omschrijving"] . '</td>
						<td align="center"> &euro;' . $product["prijs"] . '</td>
						<td align="center">
							' . (isset($_SESSION["carts"]["products"][$product["id"]]) ? $_SESSION["carts"]["products"][$product["id"]] : 1) . '
						</td> 

					</tr>';
				}

				echo '
            <form action="" class="checkout-form" method="post">
				<tr>
					<td colspan="3">Totaal:</td>
					<td colspan="1" align="center">&euro;' . $price . '</td>
					<td colspan="1" align="center">' . $quantity . ' items</td>
				</tr>
				';
				$_SESSION['totaal'] = $price;
				?>
				</tbody>
			</table>

		</div>
		<div class="half-right">
			<table>

				<th colspan="2">Gegevens klant</th>

				<tr>
					<td>Naam</td>
					<td width="80%"><input type="text" value="<?= ($user['naam']) ?>" name="naam" disabled/></td>
				</tr>

				<tr>
					<td>Reden Aankoop</td>
					<td width="80%"><input type="text" name="reden"
					                       required/></td>
				</tr>
				<tr>
					<td></td>
					<td><input name="koop" id="koopknop" value="Bevestig bestelling" type="submit"/></td>
				</tr>
				</form>
			</table>

		</div>
	</div>
	<?php
}