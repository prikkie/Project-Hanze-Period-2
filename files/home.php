<?php
if ($_SESSION["logged_in"] == true) {
	echo "you are logged in!";
} else {
	?>
    <form action="login" method="post">
        <table align="center">
            <tr>
                <td>Username:</td>
                <td><input type="text" name="name" required></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="pass" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit"></td>
            </tr>
        </table>
    </form>
	<?php
}