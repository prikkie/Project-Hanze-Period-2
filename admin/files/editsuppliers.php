<?php
if (isset($sid)) {
	global $sid;

	$query = "SELECT naam,adres,telefoon,email,website FROM  supplier where id = $sid";

	if ($result = $conn->query($query)) {
		while ($row = $result->fetch_assoc()) {
			$id = $row["id"];
			$naam = $row["naam"];
			$adres = $row["adres"];
			$telefoon = $row["telefoon"];
			$email = $row["email"];
			$website = $row["website"];

			?>
            <section class="section-default">
                <h2>Supplier gegevens wijzigen</h2>
                <form action="" method="post">
                    <table>
                        <tr>
                            <td>Naam</td>
                            <td><input required type="text" value="<?php echo $naam; ?>" name="naam"</td>
                        </tr>
                        <tr>
                            <td>Adres</td>
                            <td><input required type="text" value="<?php echo $adres; ?>" name="adres">
                            </td>
                        </tr>

                        <tr>
                            <td>Telefoon</td>
                            <td><input type="text" value="<?php echo $telefoon; ?>" required name="telefoon">
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="text" value="<?php echo $email; ?>" required name="email"><br/>
                            </td>
                        </tr>
                        <tr>
                            <td>Website</td>
                            <td><input type="text" value="<?php echo $website; ?>" required name="website"><br/>
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


$naam = $_POST['naam'];
$adres = $_POST['adres'];
$telefoon = $_POST['telefoon'];
$email = $_POST['email'];
$website = $_POST['website'];


if (isset($_POST['aanpassen'])) {
	$query = "UPDATE supplier SET naam = '$naam', adres = '$adres', telefoon = '$telefoon', email = '$email', website = '$website' WHERE id = $sid";
	$conn->query($query);
	header("Location: /admin/suppliers  ");
}
?>