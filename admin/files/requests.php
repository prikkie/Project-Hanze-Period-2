<?php
if ($_SESSION['logged_in'] == true && ($_SESSION['recht'] == "A") || ($_SESSION["recht"] == "M")) {
	if (isset($_GET['sid'])) {
		include 'view_request.php';
	} elseif (isset($_GET['rid'])) {
		include 'refuse_request.php';
	} else {
		?>

		<table>
			<tr>
				<th>Productnaam</th>
				<th>Gebruiker</th>
				<th width="10%">Department</th>
				<th width="8%">Link</th>
				<th>Omschrijving</th>
				<th>Motivatie</th>
				<th>Status</th>

				<th>Reden voor afwijzing</th>
			</tr>

			<?php
			if ($_SESSION['recht'] == "M" && $_SESSION['department'] != "Purchase") {
				$query = "SELECT * FROM requests WHERE department= '" . $_SESSION['department'] . "' ";
			} elseif ($_SESSION['recht'] == "A" || $_SESSION['department'] == "Purchase") {

				$query = "SELECT * FROM requests";

			}

			if ($result = $conn->query($query)) {
				while ($row = $result->fetch_assoc()) {
					$id = $row["id"];
					$naam = $row["naam"];
					$department = $row["department"];
					$link = $row["link"];
					$omschrijving = $row["omschrijving"];
					$motivatie = $row["motivatie"];
					$auth = $row["auth"];
					$afwijzing = $row["afwijzing"];
					$gebruiker = $row["gebruiker"];


					?>


					<tr>
						<td align="center"> <?php echo $naam ?> </td>
						<td align="center"><?php echo $gebruiker ?></td>
						<td align="center"><?php echo $department ?> </td>
						<td align="center"><?php echo $link ?> </td>
						<td align="center"> <?php echo $omschrijving ?> </td>
						<td align="center"><?php echo $motivatie ?></td>
						<td align="center"><?php echo $auth ?></td>

						<td align="center"><?php echo $afwijzing ?></td>

						<?php if ($auth == "Doorgestuurd") { ?>
							<td><a target="_self"
							       href="requests/s/<?php echo $id ?>">
								<button>Inzien</button>
							</a></td><?php } ?>
						<?php if ($auth == "Authorisatie nodig" && $_SESSION['recht'] == "A" || ($_SESSION['recht'] == "M"
								&& $_SESSION['department'] == $department)) { ?>
							<td><a target="_self"
							       href="auth/d/<?php echo $id ?>">
									<button>Doorsturen</button>
								</a></td> <?php } ?>

						<td align="center"></td>
						<?php if ($auth == "Authorisatie nodig" && $_SESSION['recht'] == "A" || ($_SESSION['recht'] == "M"
								&& $_SESSION['department'] == $department)) { ?>
							<td><a target="_self"
							       href="requests/r/<?php echo $id ?>">
									<button>Afwijzen</button>
								</a></td> <?php } ?>


						<td align="center"></td>

						<td align="center"></td>
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
