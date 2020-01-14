<img src="../images/shoppingcart.png" alt="shoppingcart" class="shoppingcart_img"/>

<div class="shoppingcart">
    <div class="overview">
		<?php
		$cart_products = $_SESSION['carts']['products'];
		if (count($cart_products)) {
			foreach ($cart_products as $ids => $data) {
				$query = "SELECT * FROM products where id = $ids";

				if ($result = $conn->query($query)) {
					foreach ($result as $product) {
						echo '<div class="item cart_item" data-id="' . $product["id"] . '">
								<img src="/images/' . $product["afbeelding"] . '" class="product_image"/>
								<div class="product_info">

									<div class="current_amount" data-id="' . $product["id"] . '">
										<div class="amount_container">

											<span class="amount">
												' . $data . '
											</span>
											<span class="times">
											x
											</span>
										</div>
										<span class="price">
											&euro;
											<span class="product_price">' . $product["prijs"] . ' </span>
										</span>

									</div>
									<span class="name">
										' . $product["naam"] . '

									</span>
									<div class="quantity_change">
											<img src="/images/min.jpg" alt="min" class="min cart_disable" data-id="' . $product["id"] . '"/>
											<img src="/images/plus.jpg" alt="plus" class="plus cart_disable" data-id="' . $product["id"] . '"/>
									</div>
								</div>
							</div>';
					}
				}
			}
			echo '<div class="checkout"><button class="checkout_button">checkout</button></div>';
		} else {
			echo '<div class="item no_products">No products added at the moment</div>';
		}

		?>

    </div>
</div>
