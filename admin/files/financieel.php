<?php
if ($_SESSION['logged_in'] == true && ($_SESSION['recht'] == "A") || ($_SESSION["recht"] == "M") && $_SESSION['department'] == "Finance") {

    $query = "SELECT ors.id, o.datum, p.afbeelding, p.naam, ors.aantal, o.totaalprijs, p.leverancier, ors.status FROM orderregels ors JOIN orders o on ors.order_id = o.id JOIN products p on p.id = ors.product ORDER BY status ASC";

    $result = mysqli_query($conn,$query);
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
                $id = $row["id"];
                $datum = $row["datum"];
                $afbeelding = $row["afbeelding"];
                $product = $row["naam"];
                $aantal = $row["aantal"];
                $status = $row["status"];
                $totaalprijs = $row["totaalprijs"];
                $leverancier = $row["leverancier"];

?>
                 <tr>
                    <td align="center"> order<?php echo $id ?> </td>
                    <td><img id="img_product" src=../images/<?php echo $afbeelding ?>></td>
                    <td align="center"> <?php echo $product ?> </td>
                    <td align="center"> <?php echo $aantal ?> </td>
                    <td align="center">€ <?php echo $totaalprijs ?> </td>
                    <td align="center"> <?php echo $leverancier ?> </td>
                    <td align="center"> <?php echo $datum ?> </td>
                    <td align="center"> <?php echo $status ?> </td>
                    <?php if($status != "betaald" && $status != "afgewezen" && $status != "toegewezen" && $status != "authorisatie nodig"){?>
                    <td><a target="_self"
                           href="/admin/auth/b/<?php echo $id; ?>">
                            <button>Betalen</button>
                        </a></td> <?php }?>
                </tr>
<?php }

} else {
	header("Location: http://projecthanze.com/admin/home");
}