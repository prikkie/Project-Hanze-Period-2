<?php
$price = 0;
$quantity = 0;

if (isset($_SESSION['account_id'])) {
	$logged_in = true;

	$query = 'SELECT * FROM users where id = ' . $_SESSION['account_id'];
	$result = mysqli_query($conn, $query);
	$user = mysqli_fetch_assoc($result);

}

if (isset($_POST['koop'])) {

	if (isset($_SESSION['account_id'])) {
		$klant = $_SESSION['account_id'];
	} else {
		$klant = 45;
	}
	if (isset($_SESSION['carts']['products'])) {
		$price = $_SESSION['totaal'];
		$query = 'INSERT INTO orders (klant,totaalprijs) VALUES (' . $klant . ',' . $price . ')';
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
		$niewvoorraad = $product['voorraad'] - $value;
		$query = 'UPDATE products SET voorraad = ' . $niewvoorraad . ' where id=' . $product['id'];
		$result = mysqli_query($conn, $query);
		$done = mysqli_fetch_assoc($result);


	}


	unset($_SESSION['carts']['products']);
	header("Location: http://projecthanze.com/bedankt");
//
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
		<?php
		echo "<h4 style='text-align: center'>";
		echo "Je kunt je bestelling afhalen bij de kantine  Laat de bestellings-overzicht zien aan een medewerker die je zodadelijk via de mail krijgt.";
		echo "</h4>";
		?>
    </div>
    <div class="half-right">
        <table>

            <th colspan="2">Gegevens klant</th>

            <tr>
                <td>Naam</td>
                <td width="60%"><input type="text" value="<?= ($user['naam']) ?>" name="naam" required/></td>
            </tr>

            <tr>
                <td>Email</td>
                <td width="120%"><input type="text" value="<?= ($logged_in ? $user['email'] : '') ?>" name="email"
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
