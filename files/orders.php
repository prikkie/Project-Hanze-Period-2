<?php
if (isset($_SESSION['account_id'])) {
	if (isset($_GET['sid'])) {
		include 'view_order.php';
	} else {
    $query = 'SELECT * FROM orders where klant ='. $_SESSION['account_id'];
    $result = mysqli_query($conn,$query);
    ?>
    <table>
        <tr>
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
                    <td align="center"> <?php echo $datum ?> </td>
                    <td align="center">€ <?php echo $totaalprijs ?> </td>
                    <td align="center"> <?php echo $afgehandeld ?> </td>
                    <td align="center"><a target="_self"
                                          href="orders/s/<?php echo $id ?>"><button>Inzien</button></a></td>
                </tr>
<?php }
}

} else {
	header("Location: http://projecthanze.com/home");
}