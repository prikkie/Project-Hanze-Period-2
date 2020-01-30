<?php
session_start();
if ($_SESSION['logged_in'] == true) {
	if ($_SESSION['recht'] == 'M' || $_SESSION['recht'] == "A") {
		header("Location: /admin");
	}
	?>
	<link rel="stylesheet" type="text/css" href="/css/search_style.css">
	<script type="text/javascript">

        $(document).ready(function () {
            $("#find").keyup(function () {
                fetch();
            });
        });

        function noenter() {
            return !(window.event && window.event.keyCode == 13);
        }

        function fetch() {
            var val = document.getElementById("find").value;
            $.ajax({
                type: 'post',
                url: '/files/search.php',
                data: {
                    get_val: val
                },
                success: function (response) {
                    document.getElementById("search_items").innerHTML = response;
                    document.getElementById("products").remove();
                }
            });
        }
	</script>


	<table>
		<tr>
			<td valign="top">

				<div id="search_box">
					<form method='get' action='files/search.php'>
						<input onkeypress="return noenter()" type="text" name="get_val" id="find"
						       placeholder="Zoek naar producten">
					</form>
				</div>
			</td>
			<?
			echo "<div id='winkelmandje'>";
			include 'files/winkelmandView.php';

			echo "</div>";
			?>
			<div id="undermand">
				<a href="/aanvraag_product">
					<button>Product aanvragen!</button>
				</a>
			</div>
		</tr>
		<tr>
			<td>
				<div id="search_items">

				</div>


				<div id=products>
					<?

					$query = "SELECT * FROM products";

					if ($result = $conn->query($query)) {

						foreach ($result as $product) {

							echo
								'<div class="product" data-id="' . $product["id"] . '">
            
							<img src="/images/' . $product["afbeelding"] . '" class="product_image"/>
							<div class="product_name">
								<b>
								
									' . $product["naam"] . '
								</b>
							</div>
							<div class="description">
								&euro; <span class="product_price">' . $product["prijs"] . '</span> - ' . $product["omschrijving"] . '
							</div>
							<div class="current_amount" data-id="' . $product["id"] . '">
								Hoeveelheid:
								<span class="amount">
									' . (isset($_SESSION["carts"]["products"][$product["id"]]) ? $_SESSION["carts"]["products"][$product["id"]] : 0) . '
								</span>
							</div>

							<img src="/images/plus.jpg" alt="plus" class="plus cart_disable" data-id="' . $product["id"] . '"/>
							<img src="/images/min.jpg" alt="min" class="min cart_disable" data-id="' . $product["id"] . '"/>


						</div>';
						}
					} else {
						echo 'Geen producten aangeboden!';
					}


					?>
				</div>
			</td>


		</tr>
	</table>
	<?php
} else {
	header("Location: http://projecthanze.com/home");
}