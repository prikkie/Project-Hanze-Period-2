<?php
if ($_SESSION['logged_in'] == true && $_SESSION['recht'] == "A" || $_SESSION['recht'] == "M") {

	?>


    <table>
        <tr>
            <th>Request</th>
            <th>Naam</th>
            <th width="10%">Department</th>
            <th width="8%">Link</th>
            <th>Omschrijving</th>
            <th>Motivatie</th>
            <th>Status</th>
            <th>Gebruiker</th>
        </tr>

		<?php
		$rid = $_GET['rid'];
		$query = 'SELECT * FROM requests where id =' . $rid;
		$result = mysqli_query($conn, $query);
		$hoeveelRows = mysqli_num_rows($result);

		while ($row = mysqli_fetch_assoc($result)) {

		$naam = $row["naam"];
		$department = $row["department"];
		$link = $row["link"];
		$omschrijving = $row["omschrijving"];
		$motivatie = $row["motivatie"];
		$auth = $row["auth"];
		$gebruiker = $row["gebruiker"];
		$mail = $row["mail"];
		?>

        <tr>
            <td align="center"><?php echo $rid ?></td>
            <td align="center"> <?php echo $naam ?> </td>
            <td align="center"><?php echo $department ?> </td>
            <td align="center"><?php echo $link ?> </td>
            <td align="center"> <?php echo $omschrijving ?> </td>
            <td align="center"><?php echo $motivatie ?></td>
            <td align="center"><?php echo $auth ?></td>
            <td align="center"><?php echo $gebruiker ?></td>
            <td align="center"></td>

			<?php
			} ?>

        </tr>
    </table>
    <form action="../../refuse_mail" method="POST">
        <h3>Reden voor afwijzing:</h3>
        <input type="text" name="afwijzing">
        <input type="hidden" value="<?php echo $naam ?>" name="naam">
        <input type="hidden" value="<?php echo $department ?>" name="department">
        <input type="hidden" value="<?php echo $link ?>" name="link">
        <input type="hidden" value="<?php echo $omschrijving ?>" name="omschrijving">
        <input type="hidden" value="<?php echo $motivatie ?>" name="motivatie">
        <input type="hidden" value="<?php echo $gebruiker ?>" name="gebruiker">
        <input type="hidden" value="<?php echo $mail ?>" name="mail">
        <input type="submit" value="Afwijzen">
    </form>
	<?php


} else {
	header("Location: http://projecthanze.com/admin/home");
}

