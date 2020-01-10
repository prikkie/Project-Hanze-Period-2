<?php

if ($_SESSION['logged_in'] == true) {
	echo "Welkom op ons admin portaal!";

} else {
	?>
    <form action="login" method="post">
        <table>
            <tr>
                <td>Gebruikersnaam</td>
                <td><input type="text" name="gebr" required/></td>
            </tr>

            <tr>
                <td>Wachtwoord</td>
                <td><input type="password" name="ww" required/></td>
            </tr>

            <tr>
                <td><input type="submit" name="login" value="Login"/></td>
            </tr>
        </table>
    </form>
	<?php
}

