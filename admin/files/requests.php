<?php
if ($_SESSION['logged_in'] == true) {
	if (isset($_GET['did'])) {
		Product_delete($_GET['did']); // verwijderen

	}
	if (isset($_GET['sid'])) {
		$sid = $_GET['sid'];  //wijzigen
		include 'editproduct.php';
	} else {
		?>

		<table>
			<tr>
				<th>Request</th>
				<th>Naam</th>
				<th width="10%">Department</th>
				<th width="8%">Link</th>
				<th>Omschrijving</th>
				<th>Motivatie</th>

				<th colspan="2">
					<div class="toevoegen" align="right">
						<a href="/admin/nieuw_request">
							<button>Nieuw request toevoegen</button>
						</a>
					</div>
				</th>
			</tr>

			<?php

			$query = "SELECT * FROM requests";


			if ($result = $conn->query($query)) {
				while ($row = $result->fetch_assoc()) {
					$id = $row["id"];
					$naam = $row["naam"];
					$department = $row["department"];
					$link = $row["link"];
					$omschrijving = $row["omschrijving"];
					$motivatie = $row["motivatie"];


					?>


					<tr>
						<td align="center"><?php echo $id ?></td>
						<td align="center"> <?php echo $naam ?> </td>
						<td align="center"><?php echo $department ?> </td>
						<td align="center"><?php echo $link ?> </td>
						<td align="center"> <?php echo $omschrijving ?> </td>
						<td align="center"><?php echo $motivatie ?></td>
						<td align="center"><a target="_self"
						                      href="producten/d/<?php echo $id ?>">
								<button>Verwijderen</button>
							</a>
						<td align="center"><a target="_self"
						                      href="producten/s/<?php echo $id ?>">
								<button>Edit</button>
							</a>
						<td align="center"></td>
					</tr>

					<?php

					$result->free();
				}
			}
			?>
		</table>
	<?php }
} else {
	header("Location: http://projecthanze.com/admin/home");
}
