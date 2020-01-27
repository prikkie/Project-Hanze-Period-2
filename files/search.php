<?php
include 'functions/db_connect.php';
?>
<link rel="stylesheet" type="text/css" href="css/style.css"> <?php
if (isset($_REQUEST['get_val'])) {

	$term = $_REQUEST['get_val'];
	$query = "select * from products where naam LIKE '%" . $term . "%' ";

	$result = mysqli_query($conn, $query) or die ("FOUT: " . mysqli_error());

	while ($row = mysqli_fetch_array($result)) {


		echo
			'<div class="product" data-id="' . $row["id"] . '">
            
							<img src="/images/' . $row["afbeelding"] . '" class="product_image"/>
							<div class="product_name">
								<b>
								
									' . $row["naam"] . '
								</b>
							</div>
							<div class="description">
								&euro; <span class="product_price">' . $row["prijs"] . '</span> - ' . $row["omschrijving"] . '
							</div>
							<div class="current_amount" data-id="' . $row["id"] . '">
								Hoeveelheid:
								<span class="amount">
									' . (isset($_SESSION["carts"]["products"][$product["id"]]) ? $_SESSION["carts"]["products"][$row["id"]] : 0) . '
								</span>
							</div>

							<img src="/images/plus.jpg" alt="plus" class="plus cart_disable" data-id="' . $row["id"] .
			'"/>
							<img src="/images/min.jpg" alt="min" class="min cart_disable" data-id="' . $row["id"] . '"/>


						</div>';


	}
	exit;
}

if (isset($_REQUEST['findval'])) {
	$findval = $_REQUEST['findval'];
	$query = "select * from products where naam LIKE '%" . $findval . "%'";
	$result = mysqli_query($conn, $query) or die ("FOUT: " . mysqli_error());

	while ($row = mysqli_fetch_array($result)) {
		echo "<a href='search.php?findval=" . $row['name'] . "'>";
		echo $row['naam'] . "<br>";
		echo $row['omschrijving'];
		echo "</a>";
	}
	exit;
}
?>
