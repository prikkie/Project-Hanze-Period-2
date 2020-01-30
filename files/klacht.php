<?php

if (isset($_SESSION['account_id'])) {
	$logged_in = true;

	$query = 'SELECT * FROM users where id = ' . $_SESSION['account_id'];
	$result = mysqli_query($conn, $query);
	$user = mysqli_fetch_assoc($result);
	$naam = $user['naam'];
	$email = $user['email'];

	if (isset($_POST['submit'])) {
		$order_id = $_GET['pid'];
		$omschrijving = $_POST['inhoud'];
		$oplossing = $_POST['oplossing'];
		$query1 = "SELECT * FROM orderregels WHERE id= '$order_id' ";
		$result1 = mysqli_query($conn, $query1);
		$roww = mysqli_fetch_assoc($result1);
		$klacht = $roww['klacht'];
		if ($klacht == "ja") {
			echo "Uw hebt al een klacht ingediend";
		} else {

			$query2 = "UPDATE orderregels SET klacht='ja', k_omschrijving='$omschrijving',k_oplossing='$oplossing' WHERE id= '$order_id' ";
			$result2 = mysqli_query($conn, $query2);
			echo "uw klacht is in behandeling";

			// Na het update van de klacht in de database..email sturen
			$query3 = "SELECT * FROM users WHERE department= 'purchase' AND manager=1 ";
			$result3 = mysqli_query($conn, $query3);
			while ($prch = mysqli_fetch_assoc($result3)) {
				$email = $prch['email'];
				$subject = "Klacht indienen";
				$mssg = "Je hebt een nieuwe klacht ontvangen van" . " " . $naam . ".\n\n" . "Met vriendelijke groet";
				$text = "Beste heer/mevrouw," . ".\n\n" . $mssg;
				$headers = "From:" . " " . $naam;
				mail($email, $subject, $text, $headers);
			}
		}
	}

} else {
	header("Location: http://projecthanze.com/home");
}
?>

<div align="center">
	<h2>Klacht indienen</h2>
	<table>
		<form method="post" action="">
			<tr>
				<td><h4>Omschrijving klacht?</h4></td>
				<td><textarea type="text" name="inhoud" rows="8" cols="60"></textarea></td>
			</tr>
			<tr>

				<td><h4>Bied uw oplossing:</h4></td>
				<td><textarea type="text" name="oplossing" rows="8" cols="60"></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<button type="submit" name="submit">Sturen</button>
				</td>
			</tr>


		</form>
	</table>
</div>


