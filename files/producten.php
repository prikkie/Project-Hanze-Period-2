<?php
session_start();
?>
<table>
    <tr>
        <td>
            <link rel="stylesheet" type="text/css" href="/css/search_style.css">
            <script type="text/javascript" src="js/jquery.js"></script>
            <script type="text/javascript">
                $(document).ready(function () {
                    $("#find").keyup(function () {
                        fetch();
                    });
                });

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


            <div id="search_box">
        <td>
            <form method='get' action='files/search.php'>
                <input type="text" name="get_val" id="find" placeholder="Search for products">
            </form>
            <!--  <br><br><br><br><br>-->
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
        <td valign="top">
			<?
			echo "<div id='winkelmandje'>";
			include 'files/winkelmandView.php';

			echo "</div>";
			?>
            <a href="/aanvraag_product">
                <button>Product aanvragen!</button>
            </a>
        </td>
    </tr>
</table>