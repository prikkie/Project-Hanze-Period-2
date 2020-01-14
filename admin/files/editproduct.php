<?php
if (isset($sid) && $_SESSION['logged_in'] == true && $_SESSION['recht'] == "A") {
	global $sid;

	$query = "SELECT naam,prijs,voorraad,afbeelding,omschrijving, leverancier FROM  products where id = $sid";

	if ($result = $conn->query($query)) {
		while ($row = $result->fetch_assoc()) {
			$id = $row["id"];
			$naam = $row["naam"];
			$prijs = $row["prijs"];
			$voorraad = $row["voorraad"];
			$afbeelding = $row["afbeelding"];
			$omschrijving = $row["omschrijving"];
			$leverancier = $row["leverancier"];

			?>
            <section class="section-default">
                <h2>Product gegevens wijzigen</h2>
                <form action="" method="post">
                    <table>
                        <tr>
                            <td>Image</td>
                            <td><input type="file" value="<?php echo $afbeelding; ?>" name="img"></td>
                        </tr>
                        <tr>
                            <td>Naam</td>
                            <td><input required type="text" value="<?php echo $naam; ?>" name="naam"</td>
                        </tr>
                        <tr>
                            <td>Prijs</td>
                            <td><input required type="number" step="0.01" value="<?php echo $prijs; ?>" name="prijs">
                            </td>
                        </tr>

                        <tr>
                            <td>Omschrijving</td>
                            <td><input type="text" value="<?php echo $omschrijving; ?>" required name="omschrijving">
                            </td>
                        </tr>

                        <tr>
                            <td>Voorraad</td>
                            <td><input type="number" value="<?php echo $voorraad; ?>" required name="voorraad"><br/>
                            </td>
                        </tr>
                        <tr>
                            <td>Leverancier</td>
                            <td><select name="leverancier">
									<?php
									$sql = mysqli_query($conn, "SELECT naam FROM supplier");
									while ($row = $sql->fetch_assoc()) {

										if ($row['naam'] == $leverancier) {
											echo '<option value="' . $row['naam'] . '" selected="selected">' . $leverancier
												. '</option>';
										} else {
											echo '<option value="' . $row['naam'] . '">' . $row['naam'] . '</option>';
										}


									}
									?>
                                </select>

                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <button type="submit" name="aanpassen">Aanpassen!</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </section>
			<?php
		}
		$result->free();
	}
	?>

	<?php
} else {
	header("Location: http://projecthanze.com/admin/home");
} ?>

<?php
//$img = $_POST['img'];
$naam = $_POST['naam'];
$prijs = $_POST['prijs'];
$omschrijving = $_POST['omschrijving'];
$voorraad = $_POST['voorraad'];
$leverancier = $_POST["leverancier"];


if (isset($_POST['aanpassen'])) {
	$query = "UPDATE products SET naam = '$naam', prijs = '$prijs', voorraad = '$voorraad', omschrijving = '$omschrijving', leverancier = '$leverancier' WHERE id = $sid";
	$conn->query($query);
	header("Location: /admin/producten");
}
?>