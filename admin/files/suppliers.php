<?php

if ($_SESSION['logged_in'] == true) {
	if (isset($_GET['did'])) {
		Suppliers_delete($_GET['did']); // verwijderen

	}
	if (isset($_GET['sid'])) {
		$sid = $_GET['sid'];  //wijzigen
		include 'editsuppliers.php';
	} else {
		?>

        <table>
            <tr>
                <th>Naam</th>
                <th width="5%">Email</th>
                <th>Adres</th>
                <th>Website</th>
                <th>Telefoon</th>

                <th></th>
                <th></th>
                <th>
                    <div class="toevoegen" align="right">
                        <button>
                            <a href="/admin/nieuw_supplier">Nieuwe Supplier Toevoegen</a>
                        </button>
                    </div>
                </th>
            </tr>

			<?php

			$query = "SELECT * FROM supplier";


			if ($result = $conn->query($query)) {
				while ($row = $result->fetch_assoc()) {
					$id = $row["id"];
					$naam = $row["naam"];
					$adres = $row["adres"];
					$telefoon = $row["telefoon"];
					$email = $row["email"];
					$website = $row["website"];


					?>


                    <tr>

                        <td align="center"> <?php echo $naam ?> </td>
                        <td align="center"> <?php echo $email ?> </td>
                        <td align="center"> <?php echo $adres ?> </td>
                        <td align="center"><?php echo $website ?> </td>
                        <td align="center"> <?php echo $telefoon ?> </td>
                        <td align="center"><a target="_self"
                                              href="suppliers/d/<?php echo $id ?>">Verwijderen</a>
                        <td align="center"><a target="_self"
                                              href="suppliers/s/<?php echo $id ?>">Edit</a>
                        <td align="center"></td>
                    </tr>

					<?php
				}
				$result->free();
			}
			?>
        </table>
	<?php }
} else {
	header("Location: http://projecthanze.com/admin/home");
}



//$naamerr = $emailerr = $adreserr = $telerr = $weberr = '';
//$naam = $email = $adres = $telefon = $web = '';
//
//if (empty($_POST['naam'])) {
//	$naamerr = 'naam is verplicht';
//} else {
//	$naam = test_input($_POST['naam']);
//	if (!preg_match("/^[a-zA-Z ]*$/", $naam)) {
//		$naamerr = "Alleen letters en spaties zijn toegestaan";
//	}
//}
//if (empty($_POST['adres'])) {
//	$adreserr = 'Adres is verplicht';
//} else {
//	$adres = test_input($_POST['adres']);
//	if (!preg_match("/^[a-zA-Z ]*$/", $naam)) {
//		$naamerr = "Alleen letters en spaties zijn toegestaan";
//	}
//}
//if (empty($_POST['telefoon'])) {
//	$telerr = "Telefoon is verplicht";
//} else {
//	$telefon = test_input($_POST['telefoon']);
//	if (!ereg("^[0-9]{2,4}-[0-9]{6,8}$", $telefon)) {
//		$telerr = "Telefoon nummer is niet geldig";
//	}
//}
//if (empty($_POST['email'])) {
//	$emailerr = "Email is verplicht";
//} else {
//	$email = test_input($_POST['email']);
//	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//		$emailerr = "e-mailadres in niet valide";
//	}
//}
//if (empty($_POST['web'])) {
//	$weberr = "website is verplicht";
//} else {
//	$web = test_input($_POST['web']);
//	if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z09+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $web)) {
//		$weberr = "URL is niet correct";
//	}
//}
//
//
//$naam = $_POST['naam'];
//$email = $_POST['email'];
//$adres = $_POST['adres'];
//$telefon = $_POST['telefoon'];
//$web = $_POST['website'];
//
//function test_input($data)
//{
//	$data = trim($data);
//	$data = stripslashes($data);
//	$data = htmlspecialchars($data);
//	return $data;
//}
//
//$query1 = "SELECT * FROM supplier";
//$result = mysqli_query($conn, $query1);
//if (!$result) {
//	die("Database query mislukt.");
//}
//while ($row = mysqli_fetch_assoc($result)) {
//
//
//	$query = "SELECT * FROM supplier WHERE naam='" . $_POST['naam'] . "'";
//	$result = mysqli_query($db, $query);
//	if (mysqli_num_rows($result) > "0") {
//		echo "Dit veld bestaat al";
//	} else {
//
//
//		if (empty($_POST['naam'])) {
//			$naamerr = 'naam is verplicht';
//		} else {
//			$naam = $_POST['naam'];
//			if (!preg_match("/^[a-zA-Z ]*$/", $naam)) {
//				$naamerr = "Alleen letters en spaties zijn toegestaan";
//			}
//		}
//		if (empty($_POST['adres'])) {
//			$adreserr = 'Adres is verplicht';
//		} else {
//			$adres = $_POST['adres'];
//
//		}
//		if (empty($_POST['telefoon'])) {
//			$telerr = "Telefoon is verplicht";
//		} else {
//			$telefon = $_POST['telefoon'];
//			if (!ereg("^[0-9]{2,4}-[0-9]{6,8}$", $telefon)) {
//				$telerr = "Telefoon nummer is niet geldig";
//			}
//		}
//		if (empty($_POST['email'])) {
//			$emailerr = "Email is verplicht";
//		} else {
//			$email = $_POST['email'];
//			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//				$emailerr = "e-mailadres in niet valide";
//			}
//		}
//		if (empty($_POST['web'])) {
//			$weberr = "website is verplicht";
//		} else {
//			$web = $_POST['web'];
//		}
//
//
//		$query = "INSERT INTO supplier (naam, adres, telefoon, email, website) VALUES ('$naam','$adres','$telefon','$email','$web')";
//		$conn->query($query);
//		header("Location: http://projecthanze.com/admin/nieuw_supplier");