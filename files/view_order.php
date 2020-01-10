<table class="tablecss" border=1 width=50% height=50% style="margin-top:5px">
    <tr>
        <th></th>
        <th>Naam</th>
        <th>Aantal</th>
        <th>Prijs/stuk</th>
        <th>Totaalprijs</th>
    </tr>

	<?php
	$sid = $_GET['sid'];
	$totaaltotaalprijs = 0;
	$totaalaantal = 0;
	$query = 'SELECT * FROM orderregels where order_id =' . $sid;
	$result = mysqli_query($conn, $query);
	while ($row = mysqli_fetch_assoc($result)) {
		$aantal = $row['aantal'];
		$prijs = $row['prijs'];
		$product = $row['product'];
		$query1 = 'SELECT * FROM products where id =' . $product;
		$result1 = mysqli_query($conn, $query1);
		$products = mysqli_fetch_assoc($result1);
		$image = $products['afbeelding'];
		$naam = $products['naam'];
		$totaalprijs = $aantal * $prijs;
		$totaalaantal += $aantal;
		$totaaltotaalprijs += $totaalprijs

		?>
        <tr>
            <td align="center"><img style="max-height: 10%; " id="img_product" src=/images/<?php echo $image ?>></td>
            <td align="center"> <?php echo $naam ?> </td>
            <td align="center"> <?php echo $aantal ?> </td>
            <td align="center">€<?php echo $prijs ?> </td>
            <td align="center">€ <?php echo number_format($totaalprijs, 2, '.', ''); ?> </td>
        </tr>
		<?php

	} ?>

    <tr width="20%" height="50%">
        <th colspan="2" align="left">Totaal:</th>
        <td colspan="1" align="center"></td>
        <td colspan="1" align="center"><?php echo $totaalaantal ?></td>
        <td colspan="1" align="center">&euro; <?php echo number_format($totaaltotaalprijs, 2, ".", '') ?></td>
    </tr>


