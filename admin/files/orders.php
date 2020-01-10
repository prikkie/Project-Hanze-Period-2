<?php
if (isset($_SESSION['account_id'])) {
	if (isset($_GET['did'])) {
		echo $_GET['did'];
		Order_delete($_GET['did']);
	}
	if (isset($_GET['sid'])) {
		include 'view_order.php';
	} else {
    $query = 'SELECT * FROM orders';
    $result = mysqli_query($conn,$query);
    ?>
    <table>
        <tr>
            <th width="15%">Klant</th>
            <th width="20%">Datum</th>
            <th>Totaalprijs</th>
            <th>Afgehandeld?</th>
        </tr>
        <?php
    while ($row = mysqli_fetch_assoc($result)) {
        $query = 'SELECT * FROM users WHERE id = '.$row['klant'];
        $result2 = mysqli_query($conn,$query);
        $klant = mysqli_fetch_assoc($result2);


                $id = $row["id"];
                $klant = $klant["naam"];
                $datum = $row["datum"];
                $totaalprijs = $row["totaalprijs"];

                $afgehandeld = $row["afgehandeld"];
                if($afgehandeld == 0){
                    $afgehandeld = "Nee";
                }else{
                    $afgehandeld = "Ja";
                }

?>
                 <tr>
                    <td align="center"> <?php echo $klant ?> </td>
                    <td align="center"> <?php echo $datum ?> </td>
                    <td align="center">€ <?php echo $totaalprijs ?> </td>
                    <td align="center"> <?php echo $afgehandeld ?> </td>
                    <td align="center"><a target="_self"
                                          href="orders/d/<?php echo $id ?>">Verwijderen</a>
                    <td align="center"><a target="_self"
                                          href="orders/s/<?php echo $id ?>">Inzien</a>
                </tr>
<?php }
}

} else {
	header("Location: http://projecthanze.com/home");
}