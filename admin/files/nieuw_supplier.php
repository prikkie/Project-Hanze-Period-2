<section class="section-default">
	<h2>Supplier toevoegen</h2>
	<form method="post">
		<table>
			<tr>
				<td>Naam Supplier</td>
				<td><input required type="text" name="naam"</td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input required type="text" name="email"</td>
			</tr>
			<tr>
				<td>Adres</td>
				<td><input type="text" required name="adres"></td>
			</tr>

			<tr>
				<td>Telefoon</td>
				<td><input type="text" required name="telefoon"></td>
			</tr>
			<tr>
				<td>Website</td>
				<td><input type="text" required name="web"><br/></td>
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

$naam = trim($_POST['naam']);
$email = trim($_POST['email']);
$adres = trim($_POST['adres']);
$telefoon = trim($_POST['telefoon']);
$web = trim($_POST['web']);
if (isset($_POST['toevoegen'])) {

	$query1 = "SELECT * FROM supplier WHERE naam= '$naam'";
	$result = mysqli_query($conn, $query1);
	if (mysqli_num_rows($result) > 0) {
		echo "Deze leverancier bestaat al";
	} else {
		$query = "INSERT INTO supplier (naam, adres, telefoon, email, website) VALUES ('$naam','$adres','$telefoon','$email','$web')";
		$conn->query($query);
		header("Location: http://projecthanze.com/admin/nieuw_supplier");
		echo "Leverancier is toegevoegd";
	}

}


?>





