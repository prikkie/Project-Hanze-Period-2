<?php
if (isset($_GET['sid'])) {
	$sid = $_GET['sid'];

	$query = "SELECT gebruikersnaam,naam,adres,email,wachtwoord,recht,geslacht FROM  users where id = $sid";

	if ($result = $conn->query($query)) {
		while ($row = $result->fetch_assoc()) {
			$id = $row["id"];
			$gebnaam = $row["gebruikersnaam"];
			$naam = $row["naam"];
			$wachtwoord = $row["wachtwoord"];
			$adres = $row["adres"];
			$email = $row["email"];
			$recht = $row["recht"];
			$geslacht = $row["geslacht"];

			?>
            <section class="section-default">
                <h2>Gebruiker wijzigen</h2>
                <form action="" method="post">
                    <table>
                        <tr>
                            <td>Gebruikersnaam</td>
                            <td><input type="text" value="<?php echo $gebnaam; ?>" required name="gebruikersnaam"</td>
                        </tr>
                        <tr>
                            <td>Naam</td>
                            <td><input type="text" value="<?php echo $naam; ?>" required name="naam"</td>
                        </tr>
                        <tr>
                            <td>Adres</td>
                            <td><input type="text" value="<?php echo $adres; ?>" required name="adres"></td>
                        </tr>
                        <tr>
                            <td>Geslacht</td>
                            <td>
                                <select name="geslacht">
                                    <option type="text" <?php if ($geslacht == "Man") {
										echo "selected";
									} else {
									} ?> name="man">Man
                                    </option>
                                    <option type="text" <?php if ($geslacht == "Vrouw") {
										echo "selected";
									} else {
									} ?> name="vrouw">Vrouw
                                    </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>E-mail</td>
                            <td><input type="text" value="<?php echo $email; ?>" required name="e-mail"></td>
                        </tr>
                        <tr>
                            <td>Wachtwoord</td>
                            <td><input type="password" value="<?php echo $wachtwoord; ?>" required
                                       name="wachtwoord"><br/></td>
                        </tr>
                        <tr>
                            <td>Recht</td>
                            <td>
                                <select name="recht">
                                    <option <?php if ($recht == "Admin") {
										echo "selected";
									} else {
									} ?> name="admin">Admin
                                    </option>
                                    <option <?php if ($recht == "Gebruiker") {
										echo "selected";
									} else {
									} ?> name="gebruiker">Gebruiker
                                    </option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Toevoegen</td>
                            <td>
                                <button type="submit" required name="aanpassen">Aanpassen!</button>
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
    </table>
	<?php
} else {
	header("Location: http://projecthanze.com/admin/home");
} ?>

<?php
$gebnaam = $_POST['gebruikersnaam'];
$naam = $_POST['naam'];
$adres = $_POST['adres'];
$geslacht = $_POST['geslacht'];
$email = $_POST['e-mail'];
$recht = $_POST['recht'];
$wachtwoord = $_POST['wachtwoord'];


if (isset($_POST['aanpassen'])) {
	$query = "UPDATE users SET gebruikersnaam = '$gebnaam', adres = '$adres', email = '$email', wachtwoord = '$wachtwoord', recht = '$recht', geslacht = '$geslacht'WHERE id = $sid";
	$conn->query($query);
	header("Location: /admin/gebruikers");
}
?>