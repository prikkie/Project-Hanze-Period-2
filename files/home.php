<?php
if ($_SESSION['logged_in'] == true) {
	if ($_SESSION['recht'] == 'M' || $_SESSION['recht'] == "A") {
		header("Location: /admin");
	}
	echo "<div align='center'>";
	echo "<h2> Welkom {$_SESSION['naam']}</h2>";
	echo "<b><u>Heb je een klacht of vraag over je al aangekochte product? Ga naar Mijn Orders > Order Inzien > Klacht onder 'Welkom {$_SESSION['naam']}' in de menu balk </u></b>";
	echo "</div>";

} else {
	?>
    <form action="login" method="post">
        <table align="center">
            <tr>
                <td>Gebruikersnaam</td>
                <td><input type="text" name="gebruiker" required/></td>
            </tr>

            <tr>
                <td>Wachtwoord</td>
                <td><input type="password" name="wachtwoord" required/></td>
            </tr>

            <tr>

                <td colspan="2">
                    <button type="submit" name="login-submit">Login</button>
                </td>

            </tr>
        </table>
    </form>
	<?php
}
?>
