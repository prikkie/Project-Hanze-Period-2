<?php
if ($_SESSION['logged_in'] == true && ($_SESSION['recht'] == "A") || ($_SESSION["recht"] == "M") && $_SESSION['department'] == "Finance") {
	if (isset($_GET['sid'])) {
		include 'view_request.php';
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
				<th>auth</th>
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
					$auth = $row["auth"];


					?>


					<tr>
						<td align="center"><?php echo $pid ?></td>
						<td align="center"> <?php echo $naam ?> </td>
						<td align="center"><?php echo $department ?> </td>
						<td align="center"><?php echo $link ?> </td>
						<td align="center"> <?php echo $omschrijving ?> </td>
						<td align="center"><?php echo $motivatie ?></td>
						<td align="center"><?php echo $auth ?></td>
						<?php if ($auth != "goedgekeurd" && $status != "afgewezen") { ?>
							<td><a target="_self"
							       href="/admin/auth/b/<?php echo $id; ?>">
									<button>Betalen</button>
								</a></td> <?php } ?>

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
