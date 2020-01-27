<?
if ($_SESSION['logged_in'] == true && $_SESSION['recht'] == "A" || ['recht'] == "M") {
	?>
	<section class="section-default">
		<h2>Gebruiker toevoegen</h2>
		<form action="" method="post">
			<table>
				<tr>
					<td>Gebruikersnaam</td>
					<td><input type="text" required name="gebruikersnaam"</td>
				</tr>
				<tr>
                    <td>Naam</td>
                    <td><input type="text" required name="naam"</td>
                </tr>
                <tr>
                    <td>Adres</td>
                    <td><input type="text" required name="adres"></td>
                </tr>
                <tr>
                    <td>Geslacht</td>
                    <td>
                        <select name="geslacht">
                            <option type="text" name="man">Man</option>
                            <option type="text" name="vrouw">Vrouw</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>E-mail</td>
                    <td><input type="text" required name="email"></td>
                </tr>
                <tr>
                    <td>Wachtwoord</td>
                    <td><input type="password" required name="wachtwoord"><br/></td>
                </tr>
                <tr>
                    <td>Afdeling</td>
                    <td><select name="department">
							<?php
							$sql = mysqli_query($conn, "SELECT id, naam FROM departments");
							while ($row = $sql->fetch_assoc()) {
								echo '<option value="' . $row['naam'] . '">' . $row['naam'] . '</option>';
							}
							?>
                        </select>

                    </td>
                </tr>
                <tr>
                    <td>Manager</td>
	                <td><select name="manager">
			                <option>Nee</option>
			                <option>Ja</option>
		                </select>
	                </td>
                </tr>
				<tr>
					<td>Recht</td>
					<td>
						<select name="recht">
							<option name="A">Admin</option>
							<option name="k">Gebruiker</option>
							<option name="M">Manager</option>
						</select></td>
				</tr>

				<tr>
					<td></td>
					<td>
						<button type="submit" required name="toevoegen">Toevoegen!</button>
					</td>
				</tr>
			</table>
        </form>
	</section>
	<?php
	$gebruikersnaam = $_POST['gebruikersnaam'];
	$naam = $_POST['naam'];
	$adres = $_POST['adres'];
	$geslacht = $_POST['geslacht'];
	$email = $_POST['email'];
	$recht = $_POST['recht'];
	$afdeling = $_POST['department'];
	$wachtwoord = $_POST['wachtwoord'];
	$hashedPwd = password_hash($wachtwoord, PASSWORD_DEFAULT);
	$manager = $_POST['manager'];
	if ($manager == "Ja") {
		$manager = 1;
	} else {
		$manager = 0;
	}

	if (isset($_POST['toevoegen'])) {
		$query = "INSERT INTO users (gebruikersnaam, naam, adres, email, wachtwoord, recht, geslacht,department, manager) VALUES ('$gebruikersnaam','$naam','$adres','$email','$hashedPwd','$recht', '$geslacht','$afdeling','$manager')";
		$conn->query($query);

		if ($manager == 1) {
			$query = "SELECT id FROM users WHERE gebruikersnaam='$gebruikersnaam'";
			if ($result = $conn->query($query)) {
				while ($row = $result->fetch_assoc()) {
					$id = $row["id"];
					$query = "UPDATE departments SET manager='$id' WHERE naam='$afdeling'";
					$conn->query($query);
					header("Location: /admin/gebruikers");

				}
			}

			$result->free();
		}
		header("Location: /admin/gebruikers");
	}
} else {
	header("Location: http://projecthanze.com/admin/home");
}