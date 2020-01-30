<?php
if ($_SESSION['logged_in'] == true && $_SESSION['recht'] == "A" || $_SESSION['recht'] == "M") {

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
		$sid = $_GET['sid'];
		$query = 'SELECT * FROM requests where id =' . $sid;
		$result = mysqli_query($conn, $query);
		$hoeveelRows = mysqli_num_rows($result);

		while ($row = mysqli_fetch_assoc($result)) {

		$naam = $row["naam"];
		$department = $row["department"];
		$link = $row["link"];
		$omschrijving = $row["omschrijving"];
		$motivatie = $row["motivatie"];
		$gebruiker = $row["gebruiker"];
		$auth = $row["auth"];
		$afwijzing = $row["afwijzing"];


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

			<?php
			} ?>

		</tr>
	</table>
	<?php


} else {
	header("Location: http://projecthanze.com/admin/home");
}

