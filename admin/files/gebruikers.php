<?php
if ($_SESSION['logged_in'] == true) {
	if (isset($_GET['did'])) {
		Gebruikers_delete($_GET['did']);
	}
	if (isset($_GET['sid'])) {
		include 'editgebruiker.php';
	} else {
		?>
        <a href="/admin/nieuw_gebruiker">Nieuwe gebruiker toevoegen!</a>

        <table>
            <tr>
                <th width="10%">Gebruikersnaam</th>
                <th width="8%">Naam</th>
                <th>Adres</th>
                <th>Email</th>
                <th>Geslacht</th>
                <th align="right">Admin</th>
            </tr>

			<?php

			$query = "SELECT * FROM users";


			if ($result = $conn->query($query)) {
				while ($row = $result->fetch_assoc()) {
					$id = $row["id"];
					$gebnaam = $row["gebruikersnaam"];
					$naam = $row["naam"];
					$adres = $row["adres"];
					$email = $row["email"];
					$geslacht = $row["geslacht"];
					?>


                    <tr>
                        <td><?php echo $gebnaam ?></td>
                        <td align="center"> <?php echo $naam ?> </td>
                        <td align="center"> <?php echo $adres ?> </td>
                        <td align="center"> <?php echo $email ?> </td>
                        <td align="center"> <?php echo $geslacht ?> </td>
                        <td align="center"><a target="_self"
                                              href="gebruikers/d/<?php echo $id ?>">Verwijderen</a></td>
                        <td align="center"><a target="_self"
                                              href="gebruikers/s/<?php echo $id ?>">Edit</a></td>
                    </tr>

					<?php
				}
				$result->free();
			}
			?>
        </table>
	<?php }
} else {
	header("Location: http://projecthanze.com/admin/home");
}
