<?php
if (isset($_GET['sid']) && $_SESSION['logged_in'] == true && $_SESSION['recht'] == "A" || ['recht'] == "M") {
	$sid = $_GET['sid'];

	$query = "SELECT gebruikersnaam,naam,adres,email,wachtwoord,recht,geslacht,department FROM  users where id = $sid";

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
			$afdeling = $row["department"];
			$manager = $row["manager"];

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
							<td><input type="password" value="<?php ?>"
							           name="wachtwoord"><br/></td>
						</tr>
						<tr>
							<td>Afdeling</td>
							<td><select name="department">
									<?php
									$sql = mysqli_query($conn, "SELECT id, naam FROM departments");
									while ($row = $sql->fetch_assoc()) {

										if ($row['naam'] == $afdeling) {
											echo '<option value="' . $row['naam'] . '" selected>' . $afdeling
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
							<td>Recht</td>
							<td>
								<select name="recht">
									<option <?php if ($recht == "A") {
										echo "selected";
									} else {
									} ?> name="A">Admin
									</option>
									<option <?php if ($recht == "k") {
										echo "selected";
									} else {
									} ?> name="K">Gebruiker
									</option>
									<option <?php if ($recht == "M") {
										echo "selected";
									} else {
									} ?> name="M">Manager
									</option>
								</select></td>
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
$afdeling = $_POST['department'];
$hashedPwd = password_hash($wachtwoord, PASSWORD_DEFAULT);
if ($manager == "Ja") {
	$manager = 1;
} elseif ($manager == "Nee") {
	$manager = 0;
}
if ($recht == "Manager") {
	$recht = "M";
} elseif ($recht == "Admin") {
	$recht = "A";
} else {
	$recht = "k";
}

if (isset($_POST['aanpassen'])) {
	$query = "UPDATE users SET gebruikersnaam = '$gebnaam', adres = '$adres', email = '$email', recht = '$recht', geslacht = '$geslacht', department = '$afdeling', wachtwoord = '$hashedPwd' WHERE id = '$sid'";
	$conn->query($query);
	header("Location: /admin/gebruikers");
}
?>