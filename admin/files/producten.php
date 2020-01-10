<?php
if ($_SESSION['logged_in'] == true) {
	if (isset($_GET['did'])) {
		Product_delete($_GET['did']); // verwijderen

	}
	if (isset($_GET['sid'])) {
		$sid = $_GET['sid'];  //wijzigen
		include 'editproduct.php';
	} else {
		?>

        <table>
            <tr>
                <th>Leverancier</th>
                <th>Image</th>
                <th width="10%">Naam</th>
                <th width="8%">Prijs</th>
                <th>Omschrijving</th>
                <th>Voorraad</th>
                <th></th>
                <th></th>
                <th>
                    <div class="toevoegen" align="right">
                        <button>
                            <a href="/admin/nieuw_product">Nieuw product toevoegen</a>
                        </button>
                    </div>
                </th>
            </tr>

			<?php

			$query = "SELECT * FROM products";


			if ($result = $conn->query($query)) {
				while ($row = $result->fetch_assoc()) {
					$id = $row["id"];
					$naam = $row["naam"];
					$prijs = $row["prijs"];
					$voorraad = $row["voorraad"];
					$afbeelding = $row["afbeelding"];
					$omschrijving = $row["omschrijving"];
					$leverancier = $row["leverancier"];


					?>


                    <tr>
                        <td><?php echo $leverancier ?></td>
                        <td><img id="img_product" src=../images/<?php echo $afbeelding ?>></td>
                        <td align="center"> <?php echo $naam ?> </td>
                        <td align="center">&euro; <?php echo $prijs ?> </td>
                        <td align="center"><?php echo $omschrijving ?> </td>
                        <td align="center"> <?php echo $voorraad ?> </td>
                        <td align="center"><a target="_self"
                                              href="producten/d/<?php echo $id ?>">Verwijderen</a>
                        <td align="center"><a target="_self"
                                              href="producten/s/<?php echo $id ?>">Edit</a>
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
