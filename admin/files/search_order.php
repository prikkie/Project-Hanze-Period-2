<?php
include 'functions/db_connect.php';
?>
<link rel="stylesheet" type="text/css" href="css/style.css">

<?php
if (isset($_REQUEST['get_val'])) {

	$term = $_REQUEST['get_val'];

	$query = "SELECT ors.id, o.datum, p.afbeelding, p.naam, ors.aantal, o.totaalprijs, p.leverancier, ors.status FROM orderregels ors JOIN orders o on ors.order_id = o.id JOIN products p on p.id = ors.product WHERE ors.id LIKE '%" . $term . "%' OR p.naam LIKE '%" . $term . "%' OR p.leverancier LIKE '%" . $term . "%' ORDER BY p.id  ";
	$result = mysqli_query($conn, $query) or die ("FOUT: " . mysqli_error());
	?>
    <table>
        <tr>
            <th>Ordernummer</th>
            <th></th>
            <th>Product</th>
            <th>Aantal</th>
            <th>Totaalprijs</th>
            <th>Leverancier</th>
            <th width="20%">Datum</th>
            <th>Status</th>
            <th></th>
        </tr>
		<?php

		while ($row = mysqli_fetch_assoc($result)) {

			?>

            <tr>
                <td align="center"> <?php echo $row["id"] ?> </td>
                <td><img id="img_product" src=http://www.projecthanze.com/images/<?php echo $row["afbeelding"] ?>></td>
                <td align="center"> <?php echo $row["naam"] ?> </td>
                <td align="center"> <?php echo $row["aantal"] ?> </td>
                <td align="center">€ <?php echo $row["totaalprijs"] ?> </td>
                <td align="center"> <?php echo $row["leverancier"] ?> </td>
                <td align="center"> <?php echo $row["datum"] ?> </td>
                <td align="center"> <?php echo $row["status"] ?> </td>
				<?php if ($row["status"] != "aanwezig" && $row["status"] != "betaald" && $row["status"] != "afgewezen" &&
					$row["status"] != "authorisatie nodig") { ?>
                    <td><a target="_self"
                           href="/admin/auth/a/<?php echo $row["id"]; ?>">
                            <button>Aanwezig</button>
                        </a></td> <?php } ?>
            </tr>

		<?php }
		?>
        </div>
    </table>
	<?
	exit;
}

if (isset($_REQUEST['findval'])) {
	$findval = $_REQUEST['findval'];
	$query = "select * from orderregels where id LIKE '%" . $findval . "%' ORDER BY id";
	$result = mysqli_query($conn, $query) or die ("FOUT: " . mysqli_error());

	while ($row = mysqli_fetch_array($result)) {
		echo "<a href='search_order.php?findval=" . $row['name'] . "'>";
		echo $row['naam'] . "<br>";
		echo $row['omschrijving'];
		echo "</a>";
	}
	exit;
}
?>
