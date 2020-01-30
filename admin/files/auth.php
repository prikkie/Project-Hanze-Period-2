<?php

if ($_SESSION['logged_in'] == true && ($_SESSION['recht'] == "A" || $_SESSION["recht"] == "M")) {
	if (isset($_GET['nid'])) {
		$nid = $_GET['nid'];
		$qu = "UPDATE orderregels SET status='" . 'afgewezen' . "', reden='" . $_POST['reden'] . "'  WHERE id= '" . $nid . "' ";
		$re = mysqli_query($conn, $qu);

		?>
        <script>
            history.back();
        </script>
		<?
	}

	if (isset($_GET['yid'])) {
		$yid = $_GET['yid'];
		$qu = "UPDATE orderregels SET status='" . 'toegewezen' . "'WHERE id= '" . $yid . "' ";
		echo $qu;
		$re = mysqli_query($conn, $qu);
		?>
        <script>
            history.back();
        </script>
		<?

	}
	if (isset($_GET['bid'])) {
		$bid = $_GET['bid'];
		$qu = "UPDATE orderregels SET status='" . 'betaald' . "' WHERE id= '" . $bid . "' ";
		$re = mysqli_query($conn, $qu);
		?>
        <script>
            history.back();
        </script>
		<?
	}
	if (isset($_GET['aid'])) {
		$aid = $_GET['aid'];
		$qu = "UPDATE orderregels SET status='" . 'aanwezig' . "' WHERE id= '" . $aid . "' ";
		$re = mysqli_query($conn, $qu);
		?>
        <script>
            history.back();
        </script>
		<?
	}
	if (isset($_GET['did'])) {
		$did = $_GET['did'];
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$qu = "UPDATE requests SET auth='" . 'doorgestuurd' . "' WHERE id= '" . $did . "' ";
		$qu2 = "SELECT * FROM requests WHERE id = '" . $did . "'";
		$re2 = mysqli_query($conn, $qu2);
		$row = mysqli_fetch_assoc($re2);
		$to = "purchasing@projecthanze.com";
		$subject = "Nieuwe aanvraag id: " . $row['id'];
		$message = "<h1> Filler uwu</h1>";
		$message .= "Naam van het product: " . $row['naam'] . "</br>";
		$message .= "Department: " . $row['department'] . "</br>";
		$message .= "Link:" . $row['link'] . "</br>";
		$message .= "Omschrijving: " . $row['omschrijving'] . "</br>";
		$message .= "Motivatie: " . $row['motivatie'] . "</br>";
		$message .= "Moi bedankt he xxx";

		$mail = mail($to, $subject, $message, $headers);
		$re = mysqli_query($conn, $qu) . $mail;
		?>
        <script>
            history.back();
        </script>
		<?
	}

	if (isset($_GET['yid'])) {
		$yid = $_GET['yid'];
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$qu = "UPDATE orderregels SET status='" . 'besteld' . "' WHERE id= '" . $yid . "' ";
		$qu2 = "SELECT ors.id,ors.product,ors.aantal,ors.prijs,p.afbeelding,p.omschrijving,p.leverancier FROM orderregels ors JOIN products p on p.id = ors.product WHERE ors.id = '" . $yid . "'";
		$re2 = mysqli_query($conn, $qu2);
		$row = mysqli_fetch_assoc($re2);

		$to = "nielsoudenampsen@hotmail.com";
		$subject = "Order besteld met intern order id: " . $row['id'];
		$message = "<h1>Geachte " . $row['leverancier'] . " Project Hanze BV heeft een bestelling geplaatst!</h1>
                    <table>
                        <tr>
                            <td>Product</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                    </table>


";
		$message .= "Order besteld met intern order id: " . $row['id'] . " . </br>";
		$message .= "Naam van het product: " . $row['product'] . "</br>";
		$message .= "Aantal:" . $row['aantal'] . "</br>";
		$message .= "Prijs: " . $row['prijs'] . "</br>";
		$message .= "Totaal prijs: " . (number_format($row['aantal'] * $row['prijs'], 2, ',', '')) . "</br>";
		$message .= "Met vriendelijke groet,</br></br>";
		$message .= "Project Hanze BV";

		$mail = mail($to, $subject, $message, $headers);
		$re = mysqli_query($conn, $qu) . $mail;
		?>
        <script>
            history.back();
        </script>
		<?
	}


} else {
	header("Location: http://projecthanze.com/admin/home");
}

