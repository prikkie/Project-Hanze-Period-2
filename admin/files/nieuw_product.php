<?
if ($_SESSION['logged_in'] == true && $_SESSION['recht'] == "A" || ['recht'] == "M") {
	?>
	<section class="section-default">
		<h2>Product toevoegen</h2>
		<form method="post">
			<table>
				<tr>
					<td>Leverancier</td>
					<td><select name="leverancier">
							<?php
							$sql = mysqli_query($conn, "SELECT naam FROM supplier");
							while ($row = $sql->fetch_assoc()) {

								echo '<option value="' . $row['naam'] . '">' . $row['naam'] . '</option>';

							}
							?>
						</select></td>
					<td>
						<button>
							<a href="/admin/nieuw_supplier">+</a>
						</button>
					</td>
				</tr>
				<tr>
					<td>Naam</td>
					<td><input required type="text" name="naam"></td>
				</tr>
				<tr>
					<td>Prijs</td>
					<td><input required type="float" name="prijs"></td>
				</tr>

				<tr>
					<td>Omschrijving</td>
					<td><input type="text" required name="omschrijving"></td>
				</tr>
				<tr>
					<td>Voorraad</td>
					<td><input type="number" required name="voorraad"><br/></td>
				</tr>

				<tr>
					<td></td>
					<td>
						<button type="submit" name="toevoegen">Toevoegen!</button>
					</td>
				</tr>
			</table>
		</form>
	</section>
	<?php
	require 'files/functions/db_connect.php';
	$leverancier = $_POST['leverancier'];
	$naam = $_POST['naam'];
	$prijs = $_POST['prijs'];
	$omschrijving = $_POST['omschrijving'];
	$voorraad = $_POST['voorraad'];

	if (isset($_POST['toevoegen'])) {
		$query = "INSERT INTO products (naam, prijs, voorraad, omschrijving, leverancier) VALUES ('$naam','$prijs','$voorraad','$omschrijving','$leverancier')";
		$conn->query($query);
		header("Location: http://projecthanze.com/admin/producten");
	}
} else {
	header("Location: http://projecthanze.com/admin/home");
}

