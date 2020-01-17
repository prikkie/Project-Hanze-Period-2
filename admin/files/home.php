<?php
if ($_SESSION['logged_in'] == true) {
	echo "Welkom op ons admin portaal!";

} else {
	?>
	<form action="login" method="post">
		<table>
			<tr>
				<td>Gebruikersnaam</td>
				<td><input type="text" name="gebruiker" required/></td>
			</tr>

			<tr>
				<td>Wachtwoord</td>
				<td><input type="password" name="wachtwoord" required/></td>
			</tr>

			<tr>
				<td><input type="submit" name="login" value="Login"/></td>
			</tr>
		</table>
	</form>
	<?php
}

