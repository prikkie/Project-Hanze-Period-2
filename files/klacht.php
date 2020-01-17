<?php

if (isset($_SESSION['account_id'])) {
	$logged_in = true;

	$query = 'SELECT * FROM users where id = ' . $_SESSION['account_id'];
	$result = mysqli_query($conn, $query);
	$user = mysqli_fetch_assoc($result);
	$naam = $user['naam'];
	$email = $user['email'];
} else {
	header("Location: http://projecthanze.com/home");
}

?>

<div>
	<table>
		<form method="post" action="klacht_pcc">
			<tr>
				<td><input type="text" width="10%" name="naam" value="<?php echo $naam; ?>"></td>
			</tr>
			<tr>
				<td><input type="text" name="email" value="<?php echo $email; ?>"></td>
			</tr>
			<tr>
				<td><input type="text" name="subject" placeholder="Subject">
			</tr>
			</td>
			<tr>
				<td><input type="text" name="supplier" placeholder="Inter supplier's email">
			</tr>
			</td>
			<tr>
				<td><textarea name="massg" rows="8" cols="80" placeholder="Your complaint"></textarea>
			</tr>
			</td>
			<tr>
				<td>
					<button type="submit" name="submit">Send</button>
			</tr>
			</td>

		</form>
	</table>
</div>


