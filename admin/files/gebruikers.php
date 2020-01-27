<?php
if ($_SESSION['logged_in'] == true && $_SESSION['recht'] == "A" || $_SESSION['recht'] == "M") {
	if (isset($_GET['did'])) {
		Gebruikers_delete($_GET['did']);
	}
	if (isset($_GET['sid'])) {
		include 'editgebruiker.php';
	} else {
		?>


        <table>
            <tr>
                <th>Gebruikersnaam</th>
                <th width="5%">Naam</th>
                <th>Adres</th>
                <th>Email</th>
                <th>Geslacht</th>
                <th>Afdeling</th>
                <th>Recht</th>
                <!--                <th></th>-->
                <!--                <th></th>-->
                <th colspan="2"><a href="/admin/nieuw_gebruiker">
                        <button>Gebruiker toevoegen!</button>
                    </a></th>
            </tr>

			<?php
			if ($_SESSION['recht'] == "M") {
				$department = $_SESSION['department'];
				$query = "SELECT * FROM users WHERE department ='$department'";
			}
			if ($_SESSION['recht'] == "A") {
				$query = "SELECT * FROM users";
			}
			if ($result = $conn->query($query)) {
				while ($row = $result->fetch_assoc()) {
					$id = $row["id"];
					$gebnaam = $row["gebruikersnaam"];
					$naam = $row["naam"];
					$adres = $row["adres"];
					$email = $row["email"];
					$geslacht = $row["geslacht"];
					$afdeling = $row["department"];
					$recht = $row["recht"];
					if ($recht == "A") {
						$recht = "Admin";
					} elseif ($recht == "M") {
						$recht = "Manager";
					} else {
						$recht = "Gebruiker";
					}
					?>


                    <tr>
                        <td><?php echo $gebnaam ?></td>
                        <td align="center"> <?php echo $naam ?> </td>
                        <td align="center"> <?php echo $adres ?> </td>
                        <td align="center"> <?php echo $email ?> </td>
                        <td align="center"> <?php echo $geslacht ?> </td>
                        <td align="center"> <?php echo $afdeling ?> </td>
                        <td align="center"> <?php echo $recht ?> </td>
                        <td align="center"><a target="_self"
                                              href="gebruikers/d/<?php echo $id ?>">
                                <button>Verwijderen</button>
                            </a></td>
                        <td align="center"><a target="_self"
                                              href="gebruikers/s/<?php echo $id ?>">
                                <button>Edit</button>
                            </a></td>

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
