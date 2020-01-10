<h2>Leveranciertoevoegen</h2>
<form method="post" action="">
    <table>

        <tr>
            <td>Naam</td>
            <td><input required type="text" name="naam" value="<?php echo $naam; ?>"></td>
            <td><span>*<?php echo $naamerr; ?></span></td>
        </tr>

        <tr>
            <td>Email</td>
            <td><input type="text" requiredname="email" value="<?php echo $email; ?>"></td>
            <td><span>*<?php echo $emailerr; ?></span></td>

        </tr>
        <tr>
            <td>Adres</td>
            <td><input type="text" required name="adres" value="<?php echo $adres; ?>"></td>
            <td><span>*<?php echo $adreserr; ?></span></td>
        </tr>
        <tr>
            <td>Telefoon</td>
            <td><input type="text" required name="telefoon" value="<?php echo $telefon; ?>"></td>
            <td><span>*<?php echo $telerr; ?></span></td>
        </tr>
        <tr>
            <td>Website</td>
            <td><input type="text" required name="web" value="<?php echo $web; ?>"></td>
            <td><span>*<?php echo $weberr; ?></span></td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" name="toevoegen">Toevoegen!</button>
            </td>
        </tr>
    </table>
</form>
<?php
require 'files/functions/db_connect.php';

$naam = trim($_POST['naam']);
$email = trim($_POST['email']);
$adres = trim($_POST['adres']);
$telefon = trim($_POST['telefoon']);
$web = trim($_POST['web']);
$naamerr = $adreserr = $telerr = $emailerr = "";
if (isset($_POST['toevoegen'])) {

	$query1 = "SELECT * FROM supplier WHERE naam= '$naam'";
	$result = mysqli_query($conn, $query1);
	if (mysqli_num_rows($result) > 0) {
		echo "Deze leverancier bestaat al";
	} else {
		$query = "INSERT INTO supplier (naam, adres, telefoon, email, website) VALUES ('$naam','$adres','$telefon','$email','$web')";
		$conn->query($query);
		header("Location: http://projecthanze.com/admin/nieuw_supplier");
		echo "Leverancier is toegevoegd";
	}

}


?>





