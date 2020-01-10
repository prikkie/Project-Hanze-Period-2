<?php

if (isset($_SESSION['account_id'])) {
	$logged_in = true;

	$query = 'SELECT * FROM users where id = ' . $_SESSION['account_id'];
	$result = mysqli_query($conn, $query);
	$user = mysqli_fetch_assoc($result);

} else {
	header("Location: http://projecthanze.com/home");
}
?>


<div class="inpu" align="center">
    <h1>Account wijzigen</h1>
    <form action="http://projecthanze.com/files/functions/change.inc.php" method="post">
        <table>
            <tr>
                <td>Gebruikersnaam</td>
                <td width="85%"><input type="text" value="<?php echo $user['gebruikersnaam'] ?>" name="gebruikersnaam">
                </td>
            </tr>
            <tr>
                <td>Naam</td>
                <td><input type="text" name="naam" value="<?php echo $user['naam'] ?>">
            </tr>
            <tr>
                <td>Adres</td>
                <td><input type="text" name="adres" value="<?php echo $user['adres'] ?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $user['email'] ?>"></td>
            </tr>
            <tr>
                <td>Wachtwoord</td>
                <td><input type="text" name="wachtwoord" value=""></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" class="signupbtn" name="wijzig">Wijzigen</button>
                </td>
            </tr>
        </table>
    </form>
</div>
