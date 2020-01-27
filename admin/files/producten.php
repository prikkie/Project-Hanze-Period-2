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


				<th colspan="2">
					<div class="toevoegen" align="right">
						<a href="/admin/nieuw_product">
							<button>Nieuw product toevoegen</button>
						</a>
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
						<td align="center"><a target="_self"
						                      href="producten/d/<?php echo $id ?>">
								<button>Verwijderen</button>
							</a>
						<td align="center"><a target="_self"
						                      href="producten/s/<?php echo $id ?>">
								<button>Edit</button>
							</a>
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
