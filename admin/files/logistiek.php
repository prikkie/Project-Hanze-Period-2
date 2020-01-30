<?php
if ($_SESSION['logged_in'] == true && ($_SESSION['recht'] == "A" || ($_SESSION["recht"] == "M" && ($_SESSION['department'] == "Finance" || $_SESSION['department'] == "Logistic")))) {
    ?>
                <script type="text/javascript">

                    $(document).ready(function () {

                        $("#find").keyup(function () {
                            fetch();
                        });
                    });

                    function noenter() {
                        return !(window.event && window.event.keyCode == 13); }


                    function fetch() {
                        var val = document.getElementById("find").value;
                        $.ajax({
                            type: 'post',
                            url: '../admin/files/search_order.php',
                            data: {
                                get_val: val
                            },
                            success: function (response) {
                                document.getElementById("search_items").innerHTML = response;
                                document.getElementById("details").remove();
                                console.log("hey!");
                            }
                        });
                    }
                </script>
             <div id="search_box">
		    <td width="100%">
			    <form method='get' action='search_order.php'>
				    <input onkeypress="return noenter()" type="text" name="get_val" id="find" placeholder="Zoek naar order">
			    </form>
			    <!--  <br><br><br><br><br>-->
			    <div id="search_items">

			    </div>

                <?php
    $query = "SELECT ors.id, o.datum, p.afbeelding, p.naam, ors.aantal, o.totaalprijs, p.leverancier, ors.status FROM orderregels ors JOIN orders o on ors.order_id = o.id JOIN products p on p.id = ors.product WHERE ors.status = 'besteld'";
    $result = mysqli_query($conn,$query);
    $lols = mysqli_num_rows($result);
    if($lols != 0){
    	?>

		     <div id="details">
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

        }else{
        echo "Er zijn geen producten binnen op dit moment!";
        }
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
                    <td align="center"> <?php echo $id ?> </td>
                    <td><img id="img_product" src=../images/<?php echo $afbeelding ?>></td>
                    <td align="center"> <?php echo $product ?> </td>
                    <td align="center"> <?php echo $aantal ?> </td>
                    <td align="center">€ <?php echo $totaalprijs ?> </td>
                    <td align="center"> <?php echo $leverancier ?> </td>
                    <td align="center"> <?php echo $datum ?> </td>
                    <td align="center"> <?php echo $status ?> </td>
                    <?php if($status == "besteld"){?>
                    <td><a target="_self"
                           href="/admin/auth/a/<?php echo $id; ?>">
                            <button>Aanwezig</button>
                        </a></td> <?php }?>
                </tr>
			    </div>
<?php }


} else {
	header("Location: http://projecthanze.com/admin/home");
}